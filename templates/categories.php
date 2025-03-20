<?php namespace ProcessWire;

// Template file for pages using the “categories” template

// Get categries ( https://processwire.com/talk/topic/23466-page-references-sort-by-references/ )
$items = page()->children("limit=12")->sort('-numReferences');
?>

<div id='content-body' pw-append>
    <?php
        // items
        echo _refItems($items,[
            'heading' => ' ',
            'listClass' => 'categories -list-none',
            'linkClass' => 'btn -primary -md',
        ]);
        // pagination
        echo pagination($items);
    ?>
</div>

<style id='bottom-style' pw-append>
    .categories {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sp-xs);
    }
</style>
