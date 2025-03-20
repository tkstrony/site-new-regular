<?php namespace ProcessWire;

/**
* Name _blockImages
* @var string $itemClassName
* @var pageImages $images
*/

$images = $item->block_images;

if (!$images->count) return '';

$galleryID = sanitizer()->htmlClass('gallery-' . $item->name);

/** @var Macy $macy */
$macy = _macy();

// set grid container options
$macyRegion = $macy->setTrueOrder(true)
    ->setContainer("#{$galleryID}")
    ->setWaitForImages(true)
    ->setMargin(20)
    ->setColumns(3)
    ->setBreakAt([
        1200 => 3,
        800 => 3,
        600 => 2,
        400 => 1
])->render();

// set items
$items = $images->each(function($img) use($item, &$i) {
    $i ++;
    // fields
    $description = $img->description;
    $tags = str_replace(" ", ", ", $img->tags);

    // animations
    $animation = ['zoomIn','fade-in','fade-slide-left', 'slide-right','fade-slide-up','fade-slide-right','fade-slide-down'];
    $animation = $animation[rand('0','6')];
    $maxHeight = rand('1','4');

    // set thumb image
    $imgThumb = Html::img($img,['thumb' => true, 'style' => "max-height: {$maxHeight}00px;"]);

    // content
    $content =
    <<<HTML
        {$imgThumb}
        <small class='img-tags'>{$tags}</small>
        <span class='img-desc'>{$description}</span>
    HTML;

    // load custom hook
    return 
    _htmx([
        'modal' => true,
        'requestVariable' => "?id={$item->id}&img={$img->name}", // like ?hello=allo only get request
        'text' => $content,
        // 'elType' => 'div',
        'class' => 'card img-container', 
    ])->loadHook('_block-images'); // load hook
});

// CSS
$style = <<<CSS
.img-container  {
    position: relative;
    overflow: hidden; /* Hides external elements outside the container */

    .img-tags {
        position: absolute;
        place-content: center;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: black;
        color: var(--color-white);
        text-align: center;
        margin: 0;
        padding: var(--sp-4xs);
        box-sizing: border-box;
        opacity: 0;
        transform: translateY(100%); /* Initially hidden out of sight */
        transition: transform 0.5s ease-in-out;
    }

    &:hover  {
        cursor: crosshair;
        .img-tags {
            transform: translateY(0); /* After hovering */
            pointer-events: none; /* Still lets you click through the description */
            opacity: 1; /* Shows the description */
        }
    }

}
CSS;

// set region
$style = _globalRegion($itemClassName, Html::styleTag($style));

// all content
$html = <<<HTML
    <section>
        <h3 x-intersect="animate(\$el, 'fade-slide-left')">$item->title</h3>
        <div class='wrap-items'>
            {$item->body}
            <div id='{$galleryID}' class="gallery {$galleryID}">
                {$items}
            </div>
        </div>
        {$style}
        {$macyRegion}
    </section>
HTML;

// return content after set region()
return $html;
