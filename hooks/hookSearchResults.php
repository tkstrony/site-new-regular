<?php namespace ProcessWire;

/**
 * Get search Results
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

function hookSearchResults(HookEvent $event) {

    // Sanitize input
    $q = sanitizer()->selectorValue( input()->get('q') );

    // Check input
    if(!$q) return '';

    // Set limit
    $limit = 24;

    // Find items from all pages ( not parent = Admin, Contact, Site Options )
    $items = pages()->find("template=basic-page|blog-post,title~|%=$q,limit=$limit,has_parent!=2,status!=hidden");

    // Strings
    $strSearch = sprintf(_t('searchResults'), $q);

    // If no items found reurn string
    if(!$items->count) return Html::p(_t('noResults'),['class' => 'search-results']);

    $out = '';

    foreach ($items as $item) {
        if($item->viewable()) {
            $out .= Html::a($item->httpUrl, $item->title,['class' => 'search-link link']);
        }
    }

    // Return all items
    return Html::h3($strSearch) . $out;
}
