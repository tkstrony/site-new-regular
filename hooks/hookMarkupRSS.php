<?php namespace ProcessWire;

/**
 * Render Markup RSS
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

function hookMarkupRSS(HookEvent $event) {

    // Set the appropriate content type for RSS
    header("Content-Type: application/rss+xml; charset=utf-8");

    /** @var MarkupRSS $rss */
    $rss = modules()->get("MarkupRSS");

    // configure the feed. see the actual module file for more optional config options.

    $rss->title = _t('latestUpdates');
    $rss->description = _t('mostUpdates');
    $rss->url = pages()->get("template=blog")->httpUrl;

    // find the pages you want to appear in the feed.

    // this can be any group of pages returned by $pages->find() or $page->children(), etc.

    $items = pages()->find("template='blog-post',limit=10,status!=hidden,sort=-modified");

    // if( !$items->count ) return '';
    // send the output of the RSS feed, and you are done

    return $rss->render($items);
}
