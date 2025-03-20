<?php namespace ProcessWire;

/**
 * Template file for pages using the “blog-post” template
 *
 * @var BlogPostPage $page
 */

// Set Open Graph protocol to article
setting('ogType','article');
// link to the next blog post, if there is one
$nextPost = $page->next();
// link to the prev blog post, if there is one
$prevPost = $page->prev();
?>

<div id='hero' pw-remowe></div>

<div id='content-body'>

    <?= $page->contentSingle(); ?>

    <?= _pageBlocks($page); // custom blocks ?>
    
    <?= pageLinks($page) ?>

    <p class='post-nav' <?= _hxBoost(); ?>>
        <?php
            if($prevPost->id):
        ?>
            <a class='btn -icon' href='<?= $prevPost->url; ?>' title='<?= $prevPost->title; ?>'>
                <?= _icon('caret-circle-left') . Html::small($prevPost->title) ?>
            </a>
        <?php
            endif;
        ?>

        <?php
            if($nextPost->id):
        ?>
            <a class='btn -icon' href='<?= $nextPost->url; ?>' title='<?= $nextPost->title ?>'>
                <?= Html::small($nextPost->title) . _icon('caret-circle-right') ?>
            </a>
        <?php
            endif;
        ?>
	</p>

    <?= postComments($page) ?>
</div>

<style id='bottom-style' pw-append>
    .post-nav {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sp-xs);
        justify-content: center;
    }
</style>
