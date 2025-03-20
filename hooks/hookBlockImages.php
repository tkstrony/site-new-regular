<?php namespace ProcessWire;

/**
 * load block images.
 * 
 * @param HookEvent $event ProcessWire hook event object
 */
function hookBlockImages(HookEvent $event) {

    // get page id
    $id = input()->get('id');

    // get image
    $img = input()->get('img');

    // check if id or img parameters are missing
    if (!$id || !$img) return '';

    // get page
    $page = pages()->get("id=$id");

    // validate page existence and presence of images
    if (!$page->id && !$page->block_images && !$page->block_images->count) return '';

    // set images
    $images = $page->block_images;

    // get page image
    $img = $images->get("name=$img");

    // set image
    $image = Html::img($img, ['class' => 'responsive gallery-img']);

    // set body
    $body = _embed($img->body,['filters' => true]);

    // set title
    $title = $img->description ? "<h3 class='title' x-intersect=\"animate(\$el, 'fade-slide-left')\">$img->description</h3>" : '';

    // set navigation
    $btn = function($navs = 'next') use($images, $img, $page) {

        if($navs == 'prev') {
            $getItem = $images->getPrev($img) ?: null;
        }

        if($navs == 'next') {
            $getItem = $images->getNext($img) ?: null;
        }


        if(!$getItem) return '';

      return
        _htmx([
            'modal' => true,
            'requestVariable' => "?id={$page}&img={$getItem->name}&remove-last-modal=1", // like ?hello=allo only get request
            'text' => $getItem->description ?: pathinfo($getItem->name, PATHINFO_FILENAME),
            'elType' => 'button',
            'class' => 'card', 
        ])->loadHook('_block-images');
    };

    // return modal content
    return _modal(
    <<<HTML
        <div>
            {$title}
            {$image}
            {$body}
            {$btn('prev')}
            {$btn('next')}
        </div>
    HTML,
    <<<CSS
        .gallery-img {
            display: block;
            margin: auto;
            margin-bottom: var(--sp-lg);
            max-width: var(--mw-md);
        }
    CSS);
}
