<?php namespace ProcessWire; 

/**
 * return Html body classes
 */
function bodyClasses() {
    return WireArray([
		'template-' . page()->template->name,
		'page-' . page()->id
	])->implode(' ');
}

/**
 * Return the site favicon as an HTML link element.
 *
 * This function generates an HTML link element for the site's favicon based on the provided Pageimage.
 * If a valid Pageimage is provided, it constructs the link element with the appropriate image type and URL.
 * If no favicon is provided (null or empty), an empty string is returned.
 *
 * @param Pageimage $img The Pageimage representing the site's favicon.
 * @return string The HTML link element for the favicon, or an empty string if no favicon is provided.
 */
function favicon($img) {
    if (!$img) return '';
    return "<!-- Site favicon -->\n<link rel='icon' type='image/$img->ext' href='$img->url'/>";
}

/**
 * return breadcrumbs
 */
function breadCrumbs() {
    if(!page()->parents->count()) return '';
    $htmlTag = page()->seo?->titleTag ? 'p' : 'h1';
    echo Html::div(page()->parents->implode(" &gt; ", "<a href='{url}'>{title}</a>") . "&gt;" .
    Html::$htmlTag(page()->title,['class' => 'actual-page']),['id' => 'breadcrumbs', 'class' => 'breadcrumbs']);
}

/**
 * Given a group of pages, render a <ul> navigation tree
 *
 * This is here to demonstrate an example of a more intermediate level
 * shared function and usage is completely optional. This is very similar to
 * the renderNav() function above except that it can output more than one
 * level of navigation (recursively) and can include other fields in the output.
 *
 * @param array|Page|PageArray $items
 * @param int $maxDepth How many levels of navigation below current should it go?
 * @param string $fieldNames Any extra field names to display (separate multiple fields with a space)
 * @param string $class CSS class name for containing <ul>
 * @return string
 *
 */
function renderNavTree($items, $maxDepth = 0, $fieldNames = '', $class = 'nav') {

	// if we were given a single Page rather than a group of them, we'll pretend they
	// gave us a group of them (a group/array of 1)
	if($items instanceof Page) $items = array($items);

	// $out is where we store the markup we are creating in this function
	$out = '';

	// cycle through all the items
	foreach($items as $item) {

		// markup for the list item...
		// if current item is the same as the page being viewed, add a "current" class to it
		$out .= $item->id == wire()->page->id ? "<li class='current'>" : "<li>";

		// markup for the link
		$out .= "<a href='$item->url'>$item->title</a>";

		// if there are extra field names specified, render markup for each one in a <div>
		// having a class name the same as the field name
		if($fieldNames) foreach(explode(' ', $fieldNames) as $fieldName) {
			$value = $item->get($fieldName);
			if($value) $out .= " <div class='$fieldName'>$value</div>";
		}

		// if the item has children and we're allowed to output tree navigation (maxDepth)
		// then call this same function again for the item's children 
		if($item->hasChildren() && $maxDepth) {
			if($class == 'nav') $class = 'nav nav-tree';
			$out .= renderNavTree($item->children, $maxDepth-1, $fieldNames, $class);
		}

		// close the list item
		$out .= "</li>";
	}

	// if output was generated above, wrap it in a <ul>
	if($out) $out = "<ul class='$class'>$out</ul>\n";

	// return the markup we generated above
	return $out;
}

/**
 * Admin actions menu
 */
function adminActions() {

    // if user is logged in && has login-register role
    if(user()->isLoggedin() && user()->hasRole('login-register')) {
        $userZone = pages()->get("template=user-zone");
        if($userZone->id) {
            return Html::a($userZone->httpUrl,_icon('user') . $userZone->title,[
                'class' => _baseName(__FUNCTION__) . ' btn -primary tooltip-button df',
                'data-tooltip' => _t('backTo') . ' ' . $userZone->title,
                'hx-boost' => 'false'
            ]); 
        } 
    }

    // set basic for admin actions
    if(!page()->editable() || !user()->isSuperuser()) return '';

    // edit btn
    $out = Html::a(page()->editUrl(), _t('edit'), ['class' => 'btn btnEdit','hx-boost' => 'false']);

    // manage fonts
    if(config()->debug && user()->isSuperuser() ) {
        $out .= Html::a('/list-fonts', _t('manageFonts'),['class' => 'btn -accent btnManageFonts', 'hx-boost' => 'false']);
    }

    return Html::div($out,['class' => _baseName(__FUNCTION__)]);
}

/**
 * Return Debug regions
 *
 * @param string $id
 * @param string $class
 */
function debugRegions($id='debug',$class='debug') {
    if(config()->debug && user()->isSuperuser()) {
        return Html::section("<!--PW-REGION-DEBUG-->",['id' => $id,'class' => $class]);
    }
}

/**
 * Watch files for changes
 */
function watchFiles() {
    if(config()->debug == true && config()->liveReload == true) {
        $watchFiles = function () {
            $homeURL = _home()->httpUrl();
            return <<<HTML
                <script>
                var urlToCheck = "{$homeURL}watch-files";
                function checkURL() {
                    fetch(urlToCheck)
                        .then(response => {
                            // console.log('File not change');
                            // if (response.ok)
                            if (response.status == 205) {
                                // console.log('The site files have been changed. The page has been refreshed...');
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error checking URL:', error);
                        });
                }
                // Check after 1 second
                setInterval(checkURL, 1000);
                </script>
            HTML;
        };
    
        // set css js region
       return _globalRegion('Watch_Site_Files_For_Changes', $watchFiles());
    }
}

/**
 * return page links
 */
function pageLinks(Page $item) {
    $links = $item->links();
    if(!$links->count()) return '';
    $out = Html::h3(_t('alsoLike'));
    $out .= Html::ul($links->each("<li><a href={url}>{title}</a></li>"),['hx-boost' => setting('hxBoost') ? true : false]);
    return $out;
}

/**
 * Generate multi-language links for language switching.
 *
 * @return string - HTML markup containing language links.
 */
function languageLinks($page) {

    if (!_hasLanguageSupport($page)) return '';

    // Initialize the list of language links.
    $items = '';

    // Iterate through available languages.
    foreach (languages() as $language) {
        // Check if the page is viewable in this language.
        if (!$page->viewable($language)) continue;

        // Determine the CSS class for the current language.
        $class = '';
        if ($language->id == user()->language->id) {
            $class = 'current-lang';
        }

        // Generate the URL and title for the language link.
        $url = $page->localUrl($language->id);
        $langName = _home()->getLanguageValue($language, 'name');

        // Handle cases where the title is 'home'.
        if ($langName == 'home') $langName = _t('htmlLang');

        // Create the language link markup.
        $items .= "<a class='ml-link $class' href='$url' alt='$langName' hreflang='$langName'>$langName</a>";
    }

    return $items;
}

/**
 * Generate 'hreflang' attributes for a multi-language site.
 *
 * @return string - HTML markup containing 'hreflang' attributes.
 */
function hreflang($page) {

    if (!_hasLanguageSupport($page)) return '';

    // Initialize the output variable to store the markup.
    $out = "<!-- Hreflang attributes -->\n";

    // Iterate through available languages.
    foreach (languages() as $language) {
        // Skip languages where the page is not viewable.
        if (!$page->viewable($language)) continue;

        // Get the HTTP URL for this page in the given language.
        $url = $page->localHttpUrl($language);

        // Determine the hreflang code for the language (assumes language names match).
        $langName = _home()->getLanguageValue($language, 'name');

        if ($langName == 'home') $langName = _t('htmlLang');

        // Output the <link> tag with 'hreflang' attribute.
        $out .= "\t<link rel='alternate' hreflang='$langName' href='$url'/>\n";
    }

    return $out;
}

/**
 * render nav list
 */
function navList($items, $opt = []) {

    // basic options
    $default = [
        'childLimit' => 12,
        'disableChildID' => [],
        'disableChildTemplate' => [],
        'openOnMouseOver' => false,
        'hideOnMouseLeave' => false,
    ];
    $opt = array_merge($default, $opt);

    // reset out vriable
    $out = '';

    // set icon
    $btnIcon  = _icon('dots-three',['size' => 'sm']);

    // open om mouseover
    $openOnMouseOver = $opt['openOnMouseOver'] ? '@mouseover="if (!isMobile) open = true"' : '';

    // hiode om mouseleave
    $hideOnMouseLeave = $opt['hideOnMouseLeave'] ? '@mouseleave="if (!isMobile) { timeout = setTimeout(() => { open = false }, 200); }"' : '';

    // links
    foreach ($items as $link) {

        // reset variables
        $childrens = '';
        $moreLinkItems = '';

        // if has childrens
        if($link->hasChildren() && $link->id != 1 && !in_array($link->id, $opt['disableChildID']) && !in_array($link->template, $opt['disableChildTemplate'])) {

            // $span = "<span class='child-links'>";

            if($link->children()->count > $opt['childLimit']) {
                $moreText = _t('more') . ' ';
                $moreLinkItems = Html::a($link->url, _icon('arrow-circle-right', ['size' => 'sm']), ['class' => 'show-more df', 'alt' => $moreText . $link->title]);
            }

            // list childrens
            $listChild = navList($link->children("sort='-template',limit=$opt[childLimit]"), $opt);

            // content childrens
            $childrens = <<<HTML
                <button class='child-btn -icon ' @click="open = ! open" aria-label='open-nav'>
                    $btnIcon
                </button>
                <ul class='sub-child dn' @click.outside="open = false" :class="open ? 'db' : ''" x-show="open" x-transition>{$listChild} {$moreLinkItems}</ul>
            HTML;
        }

        // single item view
        $out .=
        <<<HTML
            <li x-data="{ open: false, isMobile: window.innerWidth <= 768 }"
                class='first-child'
                {$openOnMouseOver}
                {$hideOnMouseLeave}
            >
                <a class='link-item current-page-{$link->id}' href='{$link->url}'>{$link->title}</a>
                {$childrens}
            </li>
        HTML;
    }

    // return all
    return $out;
}

/**
 * return blog post coments
 */
function postComments($page) {
    $loadComments = session()->get('loadComments') == $page->id ? true : false;

    if(_site()->disableComments) return '';

    $lottie = _lottie()->load('comments-1.json', [
        'loop' => true,
        'controls' => false,
        'maxWidth' => 50,
        'autoplay' => true
    ])->render() . _t('showCommets');;

    if(_isPost() || input()->get('comment_success') || input()->get('comments-page')) {
        $out = _partial('_blogComments',['pageID'=> $page->id]);
    } else {
        $out = _htmx([
            'text' => $lottie,
            'hx-trigger' => $loadComments ? 'load' : 'click',
            'hx-swap' => 'outerHTML',
            'requestVariable' => "?pageID=$page->id"
        ])->getPartial('_blogComments');
    }
    return Html::div($out,['id' => 'commentsContent']);
}

/**
 * Renders like buttons using HTMX and Alpine.js with the Persist Plugin.
 *
 * This function generates a like button for a given page and field, utilizing HTMX for dynamic updates
 * and Alpine.js for front-end interactivity, along with the persist plugin to store like state.
 * The like button includes animated Lottie icons for a hand and heart, and only allows one like per page load.
 *
 * @param Page $page The ProcessWire page object for which likes are being rendered.
 * @param string $field The field name containing the like count. Defaults to 'likes'.
 * @return string HTML content for the like button with dynamic behavior.
 */
function like($page, $field = 'likes') {

    if(!$page->hasField($field)) return '';

    // Set the hook URL for processing likes
    $hxURL = '_likes/' . $page->id;

    // Get likes
    $countLikes = "<small id='likes-numbers'>{$page->likes}</small>";

    // load likes via htmx ( where used flat files booster or caching )
    if(_isEnabledFilesBooster()) {
        $countLikes = _htmx([
            'requestVariable' => '?get_count_likes=1',
            'elType' => 'small',
            'id' => 'likes-numbers',
            'class' => '',
            'hx-trigger' => 'intersect once',
            'hx-swap' => '',
        ])->loadHook($hxURL);
    }

    // Load and render Lottie animations for the like button (hand and heart)
    $likeHand = _lottie()->load('like-hand.lottie', [
        'loop' => true,
        'controls' => false,
        'maxWidth' => 70,
        'autoplay' => true,
        'speed' => 0.8
    ])->render();

    $likeHeart = _lottie()->load('like-heart.lottie', [
        'loop' => true,
        'controls' => false,
        'maxWidth' => 70,
        'autoplay' => true,
        'speed' => 0.8
    ])->render();

    $hxURL = _setURL($hxURL);
    // Return the HTML content for the like button, integrating HTMX and Alpine.js for interaction
    return <<<HTML
        <div x-data="{ likes_{$page->id}: \$persist(0) }">
            <button
                hx-get="{$hxURL}"
                hx-target="#likes-numbers"
                hx-swap="textContent"
                hx-trigger="click once"
                x-on:click="likes_{$page->id}++"
                x-bind:disabled="likes_{$page->id} > 0"
            >
                <span>
                    <i x-show="likes_{$page->id} == 0">$likeHand</i>
                    <i x-show="likes_{$page->id} > 0">$likeHeart</i>
                    {$countLikes}
                </span>
            </button>
        </div>
    HTML;
}

/**
 * Generate pagination for a list of results.
 *
 * This function generates pagination links for a list of results, such as pages or comments.
 *
 * @link https://processwire.com/api/ref/markup-pager-nav/
 * @param PageArray|CommentArray $results - The PageArray or CommentArray containing the results to paginate.
 * @param array $opt - Options to modify the default behavior of pagination:
 *   - 'baseUrl' (string): Base URL for pagination links.
 *   - 'elementId' (string): The HTML element's ID.
 *   - 'elementClass' (string): The HTML element's CSS class.
 *   - 'listClass' (string): CSS class for the pagination list.
 *   - 'linkClass' (string): CSS class for pagination links.
 *   - 'nextLabel' (string): Label for the "Next" button.
 *   - 'prevLabel' (string): Label for the "Previous" button.
 *   - 'currentLinkMarkup' (string): Markup for the link of the current page. Use {url} for href and {out} for label content.
 *   - 'inputPage' (int): The current page number.
 *   - 'hxBoost' (string): Return HTMX boost attribute.
 * @return string - The HTML markup for pagination.
 */
function pagination($results, $opt = array()) {

    // Basic options
    $default = [
        'baseUrl' => '',
        'elementId' => 'pagination' . page()->id,
        'elementClass' => 'pagination -list-none',
        'listClass' => 'listClass',
        'linkClass' => 'linkClass btn',
        'nextLabel' => _t('next'),
        'prevLabel' => _t('prev'),
        'currentLinkMarkup' => Html::span("{out}", ['class' => 'currentLinkMarkup btn -primary']),
        'inputPage' => input()->pageNum,
        'hxBoost' => _hxBoost() ? 'true' : 'false',
    ];
    // Merge all with default Options
    $opt = array_merge($default, $opt);

    // Render pagination
    $pagination = $results->renderPager(array(
        'nextItemLabel' 	=> $opt['nextLabel'],
        'previousItemLabel' => $opt['prevLabel'],
        'listMarkup' 		=> Html::ul("{out}",['id' => $opt['elementId'], 'class' => $opt['elementClass'], 'hx-boost' => $opt['hxBoost']]),
        'itemMarkup' 		=> Html::li("{out}",['class' => $opt['listClass']]),
        // 'linkMarkup' 		=> Html::a("{url}","<span>{out}</span>",['class' => $opt['linkClass'],'hx-get' => "{url}", 'hx-target' => 'body', 'hx-swap' => 'outerHTML show:window:top']),
        'linkMarkup' 		=> Html::a("{url}","<span>{out}</span>",['class' => $opt['linkClass']]),
        'currentLinkMarkup' => $opt['currentLinkMarkup'],
        'baseUrl' => $opt['baseUrl']
    ));

    // set region CSS
    if($pagination) {
        $pagination .= _globalRegion('pagination()', Html::styleTag(
        <<<CSS
            .pagination {
                margin-top: var(--sp-xl);
                list-style: none;
                display: flex;
                flex-wrap: wrap;
                gap: var(--sp-6xs);
                .currentLinkMarkup {}
            }
        CSS));
    }

    return $pagination;
}
