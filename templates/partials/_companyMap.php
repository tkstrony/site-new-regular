<?php namespace ProcessWire;

/**
* Name _companyMap
* @var string $id
* @var string $type
* @var string $name
* @var string $class
* @var string $itemClassName
* @var string $content
* @var string $filePath
*/

// get map
$map = _site()->map;

// return empty if no found map
if(!$map) return '';

// set label
$label = _t('companyMap');

// get sanitized map content
$map = sanitizer()->unentities($map);

// validate iframe existence
if (!str_contains($map, 'iframe')) {
    return "<p class='alert -accent'>The iframe tag needed to load Google Maps was not found.
    Here is the iframe example:<br> <pre>&lt;iframe&gt;&lt;/iframe&gt;</pre></p>";
}

// set referrer policy and sandbox
$map = str_replace(
    [
        '<iframe',
    ],
    [
        "<iframe referrerpolicy='no-referrer-when-downgrade' sandbox='allow-same-origin allow-scripts' ",
], $map);

// Enable lazy loading by default unless the input get request ('disable_lozad') is set
if(!input()->disable_lozad) {
    $map = str_replace(
        [
            '<iframe',
            'src'
        ],
        [
            "<iframe class='lozad fade-in' x-intersect=\"animate(\$el, 'fade-slide-up')\" ",
            'data-src'
        ],
        $map
    );
}

// return content
echo <<<HTML
    <div class='companyMap mw-md'>
        <h3 class='glowing-corners' x-intersect="animate(\$el, 'fade-slide-down')">{$label}</h3>
        <div class='iframe-wrapper'>
            {$map}
        </div>
    </div>
HTML;

// set region CSS
$style = <<<CSS
    .companyMap {
        display: flex;
        flex-direction: column;
    }
CSS;
echo _globalRegion('companyMap', Html::styleTag($style));
