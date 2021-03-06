<?php

namespace Swiftlet\Controllers;

class Cron extends \Swiftlet\Controller
{
	/**
	 * @throws \Swiftlet\Exception
	 */
	public function index()
	{
		$itemIds = array();

		$dbh = $this->app->getSingleton('pdo')->getHandle();

		// Feeds
		$sth = $dbh->prepare('
			SELECT
				feeds.id,
				feeds.url
			FROM       users
			STRAIGHT_JOIN users_feeds ON       users.id      = users_feeds.user_id
			STRAIGHT_JOIN feeds       ON users_feeds.feed_id =       feeds.id
			WHERE
			    users.enabled                 = 1                                                                                       AND -- Fetch feed for enabled users
			    users.last_active_at          > DATE_SUB(UTC_TIMESTAMP(), INTERVAL 30 DAY)                                              AND -- Fetch feed for active users
			  ( feeds.last_fetch_attempted_at < DATE_SUB(UTC_TIMESTAMP(), INTERVAL  3 HOUR) OR  feeds.last_fetch_attempted_at IS NULL ) AND -- Fetch feeds eight times a day
			  ( feeds.last_fetched_at         > DATE_SUB(UTC_TIMESTAMP(), INTERVAL 90 DAY)  OR  feeds.last_fetched_at         IS NULL OR TIMESTAMPDIFF(DAY, feeds.last_fetched_at, feeds.last_fetch_attempted_at) < 90 ) -- Give up on feeds after three months of failed attempts
			GROUP BY feeds.id
			ORDER BY feeds.last_fetch_attempted_at ASC
			LIMIT 100
			');

		$sth->execute();

		$results = $sth->fetchAll(\PDO::FETCH_OBJ);

		echo 'Fetching ' . count($results) . " feeds&hellip;<br>\n";

		foreach ( $results as $result ) {
			$feed = $this->app->getModel('feed');

			try {
				$feed->fetch($result->url, false);
			} catch ( \Swiftlet\Exception $e ) {
				echo $result->url . ': (' . $e->getCode() . ') ' . $e->getMessage() . "<br>\n";

				continue;
			}

			$feed->id = $result->id;

			$feed->saveItems();

			foreach ( $feed->getItems() as $item ) {
				if ( $item->getId() ) {
					$itemIds[] = $item->getId();
				}
			}
		}

		// Prune sessions
		if ( $handle = opendir('sessions') ) {
			while ( ( $file = readdir($handle) ) !== FALSE ) {
				if ( is_file('sessions/' . $file) ) {
					$parts = explode('_', $file);

					$expiry = array_shift($parts);

					if ( $expiry < time() ) {
						try {
							unlink('sessions/' . $file);
						} catch ( \Swiftlet\Exception $e ) {
						}
					}
				}
			}

			closedir($handle);
		}

		exit("Done.\n");
	}
}
