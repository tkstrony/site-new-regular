<?php namespace ProcessWire;

/**
 * Set the publication status when the field date on the post page changes
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

function hookPublicationStatus(HookEvent $event) {
    $page = $event->arguments(0);

    if($page->template != 'blog-post') return '';

    $publishedText = _t('pagePublished');
    $alreadyPublishedText = _t('pageAlreadyPublished');

    if($page->cbox != 1) return '';

    $publicationTime = wireDate('ts', $page->date);
    $publicationDate = wireDate('d-m-Y H:i', $page->date);

    if(!$page->hasStatus('unpublished') && $publicationTime > time()) {
        $page->setStatus('unpublished');
        $page->save();
        wire()->message(sprintf($publishedText,$publicationDate));
    }

    if($publicationTime < time()) {
        $page->cbox = 0;
        $page->save();
        wire()->message(sprintf($alreadyPublishedText,$publicationDate));
    }
}
