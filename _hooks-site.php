<?php namespace ProcessWire;

/** 
 * Hooks for site
 * 
 * @var ProcessWire $wire 
 */

// Get language prefix for multilingual support
$prefix = _langPrefix(page());

if(user()->isLoggedin() && user()->isSuperuser()) {
	// list fonts - Google web fonts helper ( https://gwfh.mranftl.com/fonts )
	if(config()->debug == true) {
		wire()->addHook("/{$prefix}list-fonts", null, 'hookListFonts');
		wire()->addHook("/{$prefix}list-fonts/{urlSegment}", null, 'hookListFonts');
		wire()->addHook("/{$prefix}list-fonts/preview-font/{fontID}", null, 'hookPreviewFont');
		wire()->addHook("/{$prefix}list-fonts/download-font/{fontID}", null, 'hookDownloadFont');
		wire()->addHook("/{$prefix}list-fonts/delete/{fileName}", null, 'hookDeleteFont');
	}
}

// only if config debug
if( config()->debug ) {
    // preview mail
    wire()->addHook("/{$prefix}_email-preview-{fileName}", null, 'hookEmailPreview');
}

/**
 * Load dynamic content, usually via HTMX GET request
 * 
 */
if(_isHxRequest() || _isFxRequest() || _isPost() || _isAjax()) {

    // load custom block images.
	wire()->addHook("/{$prefix}_block-images", null, 'hookBlockImages');

    // load image  from images field via image name
    wire()->addHook("/{$prefix}_loadImg/{pageID}/{imgName}", null, 'hookLoadImage');

    // process contact form
    wire()->addHook("/{$prefix}_processForm", null, 'hookProcessForm');

    // load custom content ( partials, components )
    wire()->addHook("/{$prefix}_load-content(/.*)", null, 'hookLoadContent');

	// Hook for processing like button clicks.
	wire()->addHook("/{$prefix}_likes/{pageID}", null, 'hookLikes');

    // render CSRF dynamically ( important if using flat file booster )
    wire()->addHook("/{$prefix}_render-csrf", null, 'hookRenderCSRF');

    // Search results
    wire()->addHook("/{$prefix}_search-query", null, 'hookSearchResults');
}

// Hook for dynamically generating the robots.txt file.
wire()->addHook("/{$prefix}robots.txt", null, 'hookRobots');

// Custom hook to serve the site's favicon dynamically.
wire()->addHook("/{$prefix}favicon.{ext}", null, 'hookFavicon');

// Hook after page render
wire()->addHookAfter('Page::render', null, 'hookPageRender');

// Hook rss.xml
wire()->addHook("/{$prefix}rss.xml", null, 'hookMarkupRSS');

// Hook sitemap.xml
wire()->addHook("/{$prefix}sitemap.xml", null, 'hookSitemapXML');

/**
 * Watch the site files for changes 
 */
if(config()->debug == true && config()->liveReload == true) {
    wire()->addHook("/{$prefix}watch-files", null, "hookWatchFiles");
}
