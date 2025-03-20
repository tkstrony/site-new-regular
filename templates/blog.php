<?php namespace ProcessWire;

// Template file for pages using the “blog” template

// Get all page items
$items = page()->children("template=blog-post,limit=8,sort=-published");
?>

<div id='hero' pw-remove></div>

<div id="content-body">
    <div class='blog-items' <?= _hxBoost(); ?>>
        <?php
            foreach ($items as $item) {
                /** @var BlogPostPage $item */
                echo $item->contentMulti();
            }
        ?>
    </div>
    <?php
        // pagination
        echo pagination($items);
    ?>
</div>
