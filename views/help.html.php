<?php require 'header.html.php' ?>

<div class="page-header">
	<h1><?php echo $this->get('pageTitle') ?></h1>
</div>

<div class="jump">
	<p>
		Jump to:
	</p>

	<ul>
		<li><a href="#shortcuts">Keyboard shortcuts</a></li>
		<li><a href="#contact">Contact</a></li>
	</ul>
</div>

<p>
	Readable.cc is a <a href="https://en.wikipedia.org/wiki/News_aggregator">news reader</a>.
</p>

<p>
	News is aggregated from <a href="https://en.wikipedia.org/wiki/Web_feed">web feeds</a>, a data format used by publishers to allows users to subscribe to updates.
	Most blogs and news websites offer such a feed.
</p>

<p>
	By signing up for a free account you can manage your own feeds. Supported formats include <a href="https://en.wikipedia.org/wiki/RSS">RSS</a> and <a href="https://en.wikipedia.org/wiki/Atom_%28standard%29">Atom</a>.
</p>

<p>
	New and interesting content is automatically promoted to the top of your reading list based on articles you vote for. Content the majority is likely to find
	interesting appears on the &lsquo;<a href="<?php echo $this->app->getRootPath() ?>">Popular Reading</a>&rsquo; page.
</p>

<p>
	Headlines are greyed out and stricken through when we believe you will find the article boring. If we guessed wrong, mark the item as &lsquo;interesting&rsquo;
	to help the system understand your interests better.
</p>

<p>
	Organise your subscriptions in folders. Folders are public and can be shared anonymously with anyone.
</p>

<p>
	Hit the &lsquo;save&rsquo; button on articles you wish to read later. They will appear on the &lsquo;<a href="<?php echo $this->app->getRootPath() ?>saved">Saved</a>&rsquo; page.
</p>

<p>
	Readable.cc is free and <a href="https://github.com/ElbertF/Readable.cc">open source</a>.
</p>

<div class="divider"></div>

<h2 id="shortcuts">Keyboard shortcuts</h2>

<p>
	Keyboard shortcuts to help you move around on the reading lists (&lsquo;<a href="/">Popular Reading</a>&rsquo;, &lsquo;<a href="/reading">My Reading</a>&rsquo; and &lsquo;<a href="/saved">Saved</a>&rsquo;).
</p>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Key</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><code>j</code>, <code>s</code>, <code>Spacebar</code></td>
			<td>Next article</td>
		</tr>
		<tr>
			<td><code>k</code>, <code>w</code></td>
			<td>Previous article</td>
		</tr>
		<tr>
			<td><code>o</code>, <code>Enter</code></td>
			<td>Expand article (open)</td>
		</tr>
		<tr>
			<td><code>s</code></td>
			<td>Toggle save article</td>
		</tr>
		<tr>
			<td><code>m</code>, <code>Shift-a</code></td>
			<td>Mark all articles read in &lsquo;<a href="/reading">My Reading</a>&rsquo;</td>
		</tr>
	</tbody>
</table>

<div class="divider"></div>

<h2 id="contact">Contact</h2>

<p>
	If you have any suggestions, questions or just want to say hi, please send an email to:
</p>

<p>
	&nbsp; <em><a class="contact-email" href="mailto:<?php echo $this->app->getConfig('emailHoneyPot') ?>"><?php echo $this->app->getConfig('emailHoneyPot') ?></a></em>
</p>

<p>
	Follow Readable.cc on Twitter:
</p>

<p>
	&nbsp; <em><a href="https://twitter.com/<?php echo $this->app->getConfig('twitterHandle') ?>">@<?php echo $this->app->getConfig('twitterHandle') ?></a></em>
</p>

<div class="divider"></div>

<h2>Attributions</h2>

<p>
	<small>Entypo pictograms by Daniel Bruce — <a href="http://www.entypo.com">www.entypo.com</a></small>
</p>

<p>
	<small>Readable.cc was created by <a href="http://alias.io">Elbert Alias</a></small>
</p>

<?php require 'footer.html.php' ?>