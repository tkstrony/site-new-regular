<?php namespace ProcessWire;

// Template file for “home” template used by the homepage
// ------------------------------------------------------
// See the Markup Regions documentation:
// https://processwire.com/docs/front-end/output/markup-regions/


// echo files()->render('examples/_examples'); return '';

// Get the blog page
$blog = _site()->blogPage;

/** @var BlogPostPage $blogPost */

// Get the latest published post
$blogPost = $blog->child("sort=-published");
// Get the post with the most likes
// $blogPost = $blog->child("sort=-likes, likes>0"); 
?>

<div id="content-body" pw-append <?= _hxBoost(); ?>>
    
	<!-- Home page content  -->
     <?= _pageBlocks(page()) ?>
     
     <h3 id='on-blog' class='glowing-corners' x-intersect="animate($el, 'slide-up')">
        <a href='<?= $blog->url ?>'>
            <?= _t('onBlog') ?>
        </a>
    </h3>

    <?= $blogPost->id ? $blogPost->contentMulti() : '';  ?>
</div>	

<style id='bottom-style' pw-append>
    .hero {
        columns: 1;
        column-width: auto;
        column-gap: var(--sp-5xl);
        /* column-rule: var(--sp-6xs) dashed var(--color-contrast-80); */
        @media (min-width: 64rem) {
            columns: 2;
            .meta-description {
                break-inside: avoid;
            }
        }
    }

    /* .btn-chat.home-chat {} */
</style>
