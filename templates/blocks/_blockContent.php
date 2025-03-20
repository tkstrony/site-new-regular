<?php namespace ProcessWire;

/**
* Name _blockContent
* @var string $id
* @var string $class
* @var string $itemClassName
*/

if(!$item) return '';

$body = _embed($item->body);
$img = '';

    if($item->image) {
        $img = $item->image;
        $img = Html::img($img,[
            'alt' => $img->description,
            'class' => 'responsive scrool-animation',
            'lozad' => true,
            'fitCover' => true,
            'style' => 'max-width: 120px'
        ]);
    }

    $title = function() use($item, $img) {

        // hide title
        if($item->cbox) return '';

        // set title as link
        $titleAsLink = $item->cbox_1;

        $content = function($img, $title = '') {
            return
                <<<HTML
                    <h3 class='_title' x-intersect="animate(\$el, 'fade-slide-up')">
                        {$img}
                        <span>{$title}</span>
                    </h3>
                HTML;
        };

        $attr = [];
        if($titleAsLink == 1 && $item->url_1) {
    
            if($item->cbox_2) {
                $attr = [
                    'target' => '_blank',
                    'rel' => 'noopener noreferrer',
    
                ];
            }
    
            return Html::a(sanitizer()->url($item->url_1), $content($img, $item->title), $attr);
        }

        return $content($item->title, $img);
    };

// content
$html = <<<HTML
    <section class='{$class} _item-{$item->name}'>
        {$title()}
        {$body}
    </section>
HTML;

// CSS
$style = <<<CSS
    .{$itemClassName} {
        ._title {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: var(--sp-xl);
        }
    }
CSS;
// set region
$globalRegion = _globalRegion($itemClassName, Html::styleTag($style));

// return content
return $globalRegion . $html;
