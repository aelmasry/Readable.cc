<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">

		<title><?= ( $this->name == 'index' ? '' : ( $this->get('pageTitle') . ' - ' ) ) . $this->htmlEncode($this->app->getConfig('siteName')) . ( $this->name == 'index' ? ' - RSS Reader' : '' ) ?></title>

		<meta http-equiv="X-UA-Compatible" content="IE=Edge">

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<meta name="description" content="<?= $this->get('pageDescription') ? $this->get('pageDescription') . ' ' : '' ?>Readable.cc is an RSS reader that makes feeds readable. Vote on articles to improve your personal reading list.">
		<meta name="keywords"    content="readable, feed, rss, atom, reader, google, news, articles, content, reading">

		<link href="<?= $this->app->getRootPath() ?>fonts/entypo/entypo.css" rel="stylesheet">
		<link href="<?= $this->app->getRootPath() ?>css/layout.css?n" rel="stylesheet">

		<script>
			var readable = {};

			(function(app) {
				app.email      = '<?= str_replace('@', ' ', $this->app->getConfig('emailFrom')) ?>';
				app.controller = '<?= $this->app->getControllerName() ?>';
				app.args       = [<?= $this->app->getArgs() ? '\'' . implode('\', \'', $this->app->getArgs()) . '\'' : '' ?>];
				app.sessionId  = '<?= $this->app->getSingleton('session')->getId() ?>';
				app.rootPath   = '<?= $this->app->getRootPath() ?>';
				app.signedIn   = <?= $this->app->getSingleton('session')->get('id') ? 'true' : 'false' ?>;
				app.itemCount  = 0;
				app.page       = <?= !empty($_GET['page']) && (int) $_GET['page'] - 1 ? (int) $_GET['page'] - 1 : 0 ?>;
				app.prefs      = {
					externalLinks: <?= (int) $this->app->getSingleton('session')->get('external_links') ?>
				};
			}(readable));
		</script>

		<!--[if lt IE 9]>
		<script src="<?= $this->app->getRootPath() ?>lib/html5shiv.js"></script>
		<![endif]-->
	</head>
	<body>
		<header>
			<div class="container">
				<h1><a href="<?= $this->app->getRootPath() ?>" title="Readable.cc RSS Reader">Readable.cc <strong>RSS Reader</strong></a></h1>

				<p>
					Readable.cc is the best web-based Google Reader alternative. RSS feeds are made readable and interesting content is identified algorithmically.
				</p>

				<h2 class="active">
					<a href="javascript: void(0);">
						<?= $this->get('pageTitle') ?>
						<?php if ( $this->app->getControllerName() === 'Reading' || $this->app->getControllerName() === 'Folder' ): ?>
						<span class="item-count">(<span>0</span>)</span>
						<?php endif ?>
						<i class="entypo chevron-down"></i>
					</a>
				</h2>

				<ul class="collapsed">
					<?php if ( $this->app->getSingleton('session')->get('id') ): ?>
					<li class="reading <?= $this->name == 'reading' ? 'active' : '' ?>">
						<a href="<?= $this->app->getRootPath() ?>reading">My Reading<span class="item-count"> (<span>0</span>)</span>
					</a></li>

					<?php if ( $folders = $this->app->getSingleton('helper')->getUserFolders() ): ?>
					<li class="folders <?= $this->app->getControllerName() === 'Folder' ? 'active' : '' ?>">
						<a href="javascript: void(0);">Folder<span class="item-count"> (<span>0</span>)</span></a>

						<ul class="collapsed">
							<?php foreach ( $folders as $folder ): ?>
							<li class="folder"><a href="<?= $this->app->getSingleton('helper')->getFolderLink($folder->id, $folder->title) ?>">
								<?= $this->htmlEncode($folder->title) ?>
							</a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<?php endif ?>

					<li class="saved <?= $this->app->getControllerName() == 'Saved'  ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>saved"  >Saved</a></li>
					<li class="search<?= $this->app->getControllerName() == 'Search' ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>search" >Search</a></li>
					<li class="help  <?= $this->app->getControllerName() == 'Help'   ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>help"   >Help</a></li>

					<li class="email">
						<a href="javascript: void(0);"><span><?= $this->app->getSingleton('session')->get('email') ?></span>&nbsp;<i class="entypo chevron-down"></i></a>

						<ul class="collapsed">
							<?php if ( $this->app->getControllerName() === 'Reading' || $this->app->getControllerName() === 'Folder' ): ?>
							<li class="mark-all-read"><a href="javascript: void(0);">Mark all read</a></li>
							<?php endif ?>
							<li class="settings     <?= $this->app->getControllerName() == 'Settings'      ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>settings"     >Settings</a></li>
							<li class="subscriptions<?= $this->app->getControllerName() == 'Subscriptions' ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>subscriptions">Subscriptions</a></li>
							<li class="signout      <?= $this->app->getControllerName() == 'Signout'       ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>signout"      >Sign out</a></li>
						</ul>
					</li>
					<?php else: ?>
					<li class="search<?= $this->app->getControllerName() == 'Search' ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>search">Search</a></li>
					<li class="help  <?= $this->app->getControllerName() == 'Help'   ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>help"  >Help</a></li>
					<li class="signup<?= $this->app->getControllerName() == 'Signup' ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>signup" title="Sign up for free!"><span>Create account</span></a></li>
					<li class="signin<?= $this->app->getControllerName() == 'Signin' ? ' active' : '' ?>"><a href="<?= $this->app->getRootPath() ?>signin">Sign in</a></li>
					<?php endif ?>
				</ul>
			</div>
		</header>

		<div id="contents" class="container">