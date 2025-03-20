<?php namespace ProcessWire;

/**
 * load image from images field
 * 
 * @param HookEvent $event ProcessWire hook event object
 */
function hookLoadImage(HookEvent $event) {
    $pageID = $event->pageID;
    $imgName = $event->imgName;

    if(!$pageID) return '';

    $page = pages()->get("id=$pageID");

    if(!$page->id) return '';

    $images = $page->images;

    if(!$images instanceof Pageimages || !$images->count) return '';

    $img = $page->images->get("name=$imgName");
    
    if(!$img instanceof Pageimage) return '';

        // set navigation
        $btn = function($navs = 'next') use($images, $img, $page) {

            $icon = '';

            if($navs == 'prev') {
                $getItem = $images->getPrev($img) ?: null;
                $icon = 'arrow-circle-left';
            }
    
            if($navs == 'next') {
                $getItem = $images->getNext($img) ?: null;
                $icon = 'arrow-circle-right';
            }

            if($icon) {
                $icon = _icon($icon);
            }
    
    
            if(!$getItem) return '';
    
            return
            _htmx([
                'modal' => true,
                'requestVariable' => "?remove-last-modal=1",
                'text' => $icon . $getItem->description ?: pathinfo($getItem->name, PATHINFO_FILENAME),
                'elType' => 'button',
                'class' => 'card', 
            ])->loadHook("_loadImg/{$page->id}/$getItem->name");
        };


    return _modal(Html::img($img->url) . Html::p($img->description) . $btn('prev') . $btn('next'));
}
