<?php namespace ProcessWire;

/**
 * Name _card
 * @var string $itemClassName
 * @var string $class
 * @var string $title
 * @var string $content
 * @var string $size
 */

// set basic content
$title = isset($title) ? $title : __('Card title');

// set hover class
$hoverable = isset($hoverable) && $hoverable == true ? $class = $class . ' -hoverable' : '';

// get image
$img = isset($img) ? Html::img($img,[
    'alt' => !$img instanceof PageImage ? $title : $img->description,
    'class' => 'responsive scrool-animation',
    'lozad' => true,
    'fitCover' => true,
]) : '';

$content = $content ? $content : Html::p(__('Card content. You can add description, details, text, etc. here.'));

// content
return <<<HTML
    <div class='{$class}'>
        {$img}
        <h3 class="-title">{$title}</h3>
        <div class="-content">{$content}</div>
    </div>
HTML;

