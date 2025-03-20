<?php namespace ProcessWire;

// Template file for pages using the “category” template

// Get items
$items = pages()->find("template=blog-post,categories=$page,limit=8,sort=-numReferences");
?>

<div id="content-body"  pw-append>
    <div class='category-items'>
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
