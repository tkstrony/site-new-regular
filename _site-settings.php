<?php namespace ProcessWire;

// inportant site settings
setting([
	// language folder name
	'defaultLanguage' => 'default',
	// SEO
	'noindexFollow' => false,
	'ogType' => 'website', // Open graph type https://ogp.me/,
	// Htmx
	'hxBoost' => _site()->hxBoost && !user()->isLoggedin() ? true : false
]);
