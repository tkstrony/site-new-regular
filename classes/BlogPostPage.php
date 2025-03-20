<?php namespace ProcessWire;

/**
 * Custom page class for pages using template “blog-post”
 *
 */
class BlogPostPage extends Page {

    public function thumb() {
        return
            Html::img($this->images->first,[
                'alt' => $this->title,
                'class' => 'responsive scrool-animation',
                'lozad' => true,
                'fitCover' => true,
            ]);
    }

    /**
     * Generate meta information for a post.
     *
     * This function generates meta information for a post based on the provided item and options.
     *
     * @param Page $item - The Page representing the post.
     * @param array $opt - Options to modify the default behavior of meta information rendering:
     *   - 'closedComments' (bool): Whether comments are closed.
     *
     * @return string - The HTML markup for the meta information section.
     */
    public function metaInfo($item, $opt = array()) {

        // Set default attributes
        $default = [
            'closedComments' => false
        ];
        // Merge options with default attributes
        $opt = array_merge($default, $opt);

        // Get published date
        $datePublished = wireDate('Y-m-d | g:i', $item->published);
        $iso8601Published = gmdate("c", $item->published);

        // Get modification date
        $dateModified = ($item->modified > $item->published) ? wireDate('Y-m-d | g:i', $item->modified) : '';
        $iso8601Modified = ($dateModified) ? gmdate("c", $item->modified) : '';
        // get translations
        $strLastModified = _t('lastMod');
        $strPublished = _t('published');
        // set modification date time tag for meta
        $dateModified = $dateModified ? "<br><time datetime='$iso8601Modified' itemprop='dateModified'>{$strLastModified}: $dateModified</time>" : '';
        // User slug
        $createdUserText = sprintf(_t('by'), $item->createdUser->txt ?: $item->createdUser->name);
        // Comments
        $commentsMeta = (new Comments)->meta($item, $item->comments, [
            'closedComments' => $opt['closedComments'],
            'commentsCount' => $item->comments->count()
        ]);

        // return content
        return <<<HTML
            <p class='post _meta {$item->name}__meta text-sm'>
                <time datetime="{$iso8601Published}" itemprop="datePublished">
                    {$strPublished}: {$datePublished}
                </time>
                <span>{$createdUserText}</span>
                {$dateModified}
                <br>{$commentsMeta}
            </p>
        HTML;
    }

    /**
     * Generates the HTML markup for the blog post categories.
     *
     * This function constructs an unordered list (`<ul>`) of categories associated with the blog post.
     * Each category is displayed as a list item (`<li>`) with a link to the respective category page.
     * Additionally, a link to the parent category is included at the top of the list.
     * The function also injects custom CSS for styling the categories' layout and appearance.
     *
     * @return string The HTML markup for the list of categories.
     */
    public function categories() {
        // set parent
        $categoriesParent = $this->categories->first->parent;

        // get all categories
        $categories = $this->categories->each(function($child) {
            return Html::li(' - ' . Html::a($child->url,$child->title));
        });

        // set categories link
        $categoriesLink = Html::a($categoriesParent->url, "#", ['title' => $categoriesParent->title]);

        // set css region
        $css = <<<CSS
            .blog-categories {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                margin: 0 !important;
            }
        CSS;
        $css = _globalRegion('contentCategories_css', Html::styleTag($css));

        // return html markup
        return $css . Html::ul(Html::li($categoriesLink). $categories, ['class' => '-list-none blog-categories']);
    }

    /**
     * Generates the HTML content for a blog post when displayed inside a loop.
     *
     * This function constructs and returns the HTML markup for displaying a blog post,
     * including metadata, truncated content, thumbnail image, and associated categories.
     * Additionally, it injects custom CSS styles for the blog post layout and hover effects.
     *
     * @return string The HTML markup for the blog post content.
     */
    public function contentMulti() {

        if(!$this->isPublic()) return '';

        // likes
        $likes = $this->likes;
        $heartIcon = _icon('heart');
        $likesCount = '';
        if($likes > 0) {
            $likesCount = Html::span('&nbsp;' . $heartIcon . '&nbsp;' . Html::small($likes) . '&nbsp;', ['class' => 'likes-counter']);
        }

        // meta
        $meta = Html::small(sprintf(_t('by'), $this->createdUser->txt ?: $this->createdUser->name) .
        ' / ' . wireDate('Y-m-d | g:i', $this->modified), ['class' => 'df']);

        // body
        $body = Html::small(sanitizer()->truncate($this->body, 150),['class' => 'body']);

        // thumbnail
        $thumb = $this->thumb() ? <<<HTML
            <p class='thumb' x-intersect="animate(\$el, 'fade-slide-down')">
                {$this->thumb()}
            </p>
        HTML : '';

        // html content
        $html = 
        <<<HTML
            <article id='post_{$this->id}' class='contentMulti item-{$this->id}'>
                <a href='{$this->url}' class='_top-area card link-more'>
                    <h3>{$this->title}</h3>
                    {$thumb}
                    {$meta}
                    {$body}
                    <!-- {$likesCount} -->
                </a>
            </article>
        HTML;

        // Set css region
        $css = <<<CSS
            .contentMulti {
                display: grid;
                align-items: center;
                margin: auto;
                max-width: var(--mw-md);
                .link-more {
                    &:hover {
                        .thumb img {
                            filter: brightness(0.5);
                        }
                    }
                }
                .thumb {
                    margin: var(--sp-3xl) 0;
                    display: flex;
                    place-content: center;
                    justify-content: center;
                    align-items: center;
                    img {
                        transition: all .3s ease;
                        filter: brightness(1);
                        max-width: 640px;
                        max-height: 260px;
                    }
                }
                .likes-counter {
                    display: flex;
                }
            }
        CSS;
        $css = _globalRegion('contentMulti_css', Html::styleTag($css));

        // return html content
        return $css . $html;
    }

    /**
     * Generates the HTML content for a blog post.
     *
     * @return string - The HTML markup for the blog post content.
     */
    public function contentSingle() {

        if(!$this->isPublic()) return '';

        $metaTitle =  $this->if('seo.titleTag', Html::h1("{seo.titleTag}",['class' => 'card -primary mw-md']));
        $metaDescription = $this->if('seo.metaDescription', Html::h2("{seo.metaDescription}"));
        $share = _sharerJs($this);
        $body = _embed($this->body,['filters' => true]);
        $nextParts = $this->hasChildren() ? _listLinks($this->children(), ['heading' => Html::h3('&#10095; ' . _t('nextParts'))]) : '';
        $like = like($this, 'likes');

        // set html
        $html =
        <<<HTML
            <article id='post_{$this->id}' class='contentSingle item-{$this->id}'>
                <div class='_content-area'>
                    {$metaTitle}
                    <p class='thumb' x-intersect="animate(\$el, 'fade-slide-down')">
                        {$this->thumb()}
                    </p>
                    {$metaDescription}
                    <div class='body'>
                        {$body}
                    </div>
                    {$share}
                    {$this->metaInfo($this)}
                    {$this->categories()}
                    {$like}
                    {$nextParts}
                </div>
            </article>
        HTML;

        // Set css region
        $css = <<<CSS
            .contentSingle {
                margin-top: var(--sp-4xl);
                .thumb {
                    display: flex;
                    place-content: center;
                    img {
                        max-width: 720px;
                        max-height: 340px;
                    }
                }
                .body {
                    &::first-letter {
                        font-size: 1.2lh;
                    }
                }
            }
        CSS;
        $css = _globalRegion('contentSingle_css', Html::styleTag($css));
 
        // return html content
        return $css . $html;
    }
}
