<?php namespace ProcessWire; 


/**
 * Check if debug mode is enabled in ProcessWire configuration.
 *
 * @return bool Returns true if debug mode is enabled, otherwise false.
 */
function _debug(): bool {
    return (bool) config()->debug;
}

// Set clean basename usually usage in the region names
function _baseName($name) {
	$name = explode('\\', $name);
	return lcfirst(end($name));
}

/**
 * Global helper function to provide access to the Site class instance.
 * Usage example:
 * ```
 * $site = _site();
 * echo $site->name; // Outputs the site name
 * ```
 *
 * @return \ProcessWire\Site The instance of the Site class.
 */
function _site() {
    // Static variable to hold the instance of Site class
    static $site = null;
    // Instantiate the Site class only once
    if ($site === null) {
        $site = new Site();
    }
    return $site;
}

// Get homepage
function _home(): HomePage {
    return _site()->home;
}

// Check if is home page
function _isHome(): bool {
    return page()->id == 1 ? true : false;
}

// Checks if the current page is the http404 page
function _is404(): bool {
    return page()->is('http404') ? true : false;
}

// Checks if the current request is Get method
function _isGet(): bool {
    return input()->is('GET') && !empty($_GET) ? true : false;
}

// Checks if the current request is Post method
function _isPost(): bool {
    return input()->is('POST') ? true : false;
}

// Check if the request is an FIXI request
function _isFxRequest(): bool {
    return isset($_SERVER['HTTP_FX_REQUEST']);
}

// Checks if the current request is Ajax
function _isAjax(): bool {
    return config()->ajax ? true : false;
}

// Check if the request is an HX request
function _isHxRequest(): bool {
    return isset($_SERVER['HTTP_HX_REQUEST']);
}

// Check if HX Boosted is active
function _isHxBoosted(): bool {
    return isset($_SERVER['HTTP_HX_BOOSTED']);
}

// Check if HX Push URL is active
function _isHxPushUrl(): bool {
    return isset($_SERVER['HTTP_HX_PUSH_URL']);
}

function _isInternalRequest(): bool {
    return isset($_SERVER['HTTP_X_INTERNAL_REQUEST']);
}

// Check if is admin
function _isAdmin() {
    if(page()?->template?->name == 'admin') return true;
    return false;
}

/**
 * @return \ProcessWire\Htmx An instance of the Htmx class for use in rendering.
 */
function _htmx($attr = [], $requestMethod = 'get') {
    return new Htmx($attr, $requestMethod);
}

/**
 * global regions for css js
 */
function _globalRegion($regionName = '', $content = '') {
    $regionName = sanitizer()->camelCase($regionName);
    $content = !setting($regionName) ? setting($regionName, $content) : ''; 
    return $content;
}

/**
 * return HTMX hx-boost attribute
 *
 * @param null|bool $hxBoost
 * @return string - boost attribute
 */
function _hxBoost($hxBoost = null) {

    $hxSetting = setting('hxBoost') ? 'true' : 'false';

    if(is_bool($hxBoost)) {
        $hxSetting = var_export($hxBoost, true);
    }

    return "hx-boost=$hxSetting";
}

/**
 * @return \ProcessWire\Fixi An instance of the Fixi class for use in rendering.
 */
function _fixi($attr = [], $requestMethod = 'get') {
    return new Fixi($attr, $requestMethod);
}

/*
 * @return \ProcessWire\Alpine An instance of the Alpine class for use in rendering.
 */
function _alpine() {
    /** @var Alpine $alpineInstance */
    static $alpineInstance;

    if (!$alpineInstance) {
        $alpineInstance = new Alpine();
    }

    return $alpineInstance;
}

/**
 * @return \ProcessWire\Macy The instance of Macy
 */
function _macy() {
    // Static variable to hold the instance of Macy class
    static $macy = null;

    // Instantiate the Macy class only once
    if ($macy === null) {
        $macy = new Macy();
    }

    return $macy;
}

/*
 * @return \ProcessWire\Photoswipe An instance of the Photoswipe class for use in rendering.
 */
function _photoswipe() {

    /** @var Photoswipe $photoswipeInstance */
    static $photoswipeInstance;

    if (!$photoswipeInstance) {
        $photoswipeInstance = new Photoswipe();
    }

    return $photoswipeInstance;
}

/*
 * @return \ProcessWire\Splide An instance of the Splide class.
 */
function _splide() {

    /** @var Splide $splideInstance */
    static $splideInstance;

    if (!$splideInstance) {
        $splideInstance = new Splide();
    }

    return $splideInstance;
}

/**
 * Creates a Fixi button for fetching a component or partial dynamically.
 *
 * @param string $type Type of content to fetch (component or partial).
 * @param string $name Name of the component or partial to load.
 * @param array $options Additional configuration options.
 * @return string The generated Fixi button.
 *
 * Example usage:
 * echo _fixiGET('_component', 'header', ['modal' => true]);
 */
function _fixiGET($type = 'component', $name = '', $options = []) {
    $requestVariable = isset($options['requestVariable']) ? $options['requestVariable'] : '';

    if (isset($options['modal']) && $options['modal'] == true) {
        $modal = "modal=1";
        $requestVariable = $requestVariable ? $requestVariable . "&$modal" : "?$modal";
    }

    $defaults = [
        'fx-action' => _setURL("_load-content/{$name}"),  
        'fx-swap' => 'beforeend',
        'fx-target' => 'body'
    ];
    $options = array_merge($defaults, $options);

    $options['requestVariable'] = $requestVariable ? "$requestVariable&type=$type" : "?type=$type";

    return _fixi($options);
}

/**
 * Generates a Fixi button for dynamically loading a component.
 *
 * @param string $componentName Name of the component to load.
 * @param array $options Additional configuration options.
 * @return string The generated Fixi button.
 *
 * Example usage:
 * echo _fixiGetComponent('sidebar', ['modal' => true]);
 */
function _fixiGetComponent($componentName, $options = []) {
    $type = 'component';
    return _fixiGET($type, $componentName, $options);
}

/**
 * Generates a Fixi button for dynamically loading a partial.
 *
 * @param string $componentName Name of the partial to load.
 * @param array $options Additional configuration options.
 * @return string The generated Fixi button.
 *
 * Example usage:
 * echo _fixiGetPartial('_footer', ['modal' => true]);
 */
function _fixiGetPartial($componentName, $options = []) {
    $type = 'partial';
    return _fixiGET($type, $componentName, $options);
}

/**
 * Get a singleton instance of the Component class.
 *
 * @return \ProcessWire\Component The singleton instance of the Component class.
 */
function _componentInstance() {
    static $componentInstance;
    if (!$componentInstance) {
        $componentInstance = new Component();
    }
    return $componentInstance;
}

/**
 * Render a component.
 *
 * @param string $name The name of the component to render.
 * @param array $componentOptions Optional parameters for the component.
 * @param array $opt Optional additional options for rendering.
 * @return string The rendered component as a string.
 */
function _component($name, $componentOptions = [], $opt = []) {
    $componentInstance = _componentInstance();
    return $componentInstance->render($name, $componentOptions, $opt);
}

/**
 * Render a partial component.
 *
 * @param string $name The name of the partial to render.
 * @param array $partialVariables variables parameters for the partial.
 * @param array $opt Optional additional options for rendering.
 * @return string The rendered partial as a string.
 */
function _partial($name, $partialVariables = [], $opt = []) {
    $componentInstance = _componentInstance();
    return $componentInstance->partial($name, $partialVariables, $opt);
}

/**
 * Render a block component.
 *
 * @param string $name The name of the block to render.
 * @param array $blockOptions Optional parameters for the block.
 * @param array $opt Optional additional options for rendering.
 * @return string The rendered block as a string.
 */
function _block($name, $blockOptions = [], $opt = []) {
    $componentInstance = _componentInstance();
    return $componentInstance->block($name, $blockOptions, $opt);
}

/**
 * return page custom blocks
 * @param Page $page
 * @param string $blocksField
 */
function _pageBlocks($page, $blocksField = 'content_blocks') {
    if(!$page->$blocksField) return '';
    $out = '';
    foreach ($page->$blocksField as $item) {

        // default args
        $args = ['item' => $item];

        if($item->template->name == '_blockPhiki') {
            $args += [
                'title' => !$item->cbox_1 ? $item->title : '',
                'body' => $item->body ?: '',
                'grammar' => $item->lang->title,
                'content' => html_entity_decode($item->txtarea_1),
                'theme' => $item->theme->title,
            ];
        }

        $out .= _block($item->template->name, $args);
    }
    return $out;
}

/**
 * Load site-specific assets.
 *
 * This function is responsible for loading the CSS and JavaScript assets for the site.
 * It accepts arrays of CSS and JavaScript file paths, along with an optional configuration array.
 * The function uses a default set of options that can be overridden by the provided configuration.
 * It processes the assets and returns the necessary HTML to include them in the page.
 *
 * @param array $css Array of CSS file paths to load.
 * @param array $js Array of JavaScript file paths to load.
 * @param array $opt Optional configuration array. Supported options include:
 * - 'jsDefer' (bool): Whether to add the 'defer' attribute to script tags (default: false).
 * - 'preload' (bool): Whether to preload the assets (default: true).
 * - 'prefix' (string): The prefix for the generated asset file names (default: 'site').
 *
 * @return string HTML markup for loading the assets.
 */
function _siteAssets($css = [], $js = [], $opt = []) {

    // default options
    $defOpt = [
        'jsDefer' => false,
        'preload' => true,
        'prefix' => 'site',
        'dfOnce' => config()->debug ? false : true,
        'cacheTime' => 2419200, // 1 month.
    ];
    $opt = array_merge($defOpt, $opt);

    // set cache key
    $caheName = $opt['prefix'] . '_' . _baseName(__FUNCTION__);

    // return cached content
    if (!config()->debug) {
        $output = cache()->get($caheName);
        if ($output) {
            return $output;
        }
    }

    // Static variable to hold the instance of Assets class
    static $assets = null;

    // Instantiate the Assets class only once
    if($assets === null) {
        $assets = new Assets;
    }

    // set items
    $items = [
        $css ? $assets->getFilesContent($css, "$opt[prefix].css", [
            'itemsPath' => paths()->templates . 'assets'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR,
            'dfOnce' => $opt['dfOnce']
        ]) : '',
        $js ? $assets->getFilesContent($js, "$opt[prefix].js", [
            'itemsPath' => paths()->templates . 'assets'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR,
            'dfOnce' => $opt['dfOnce']
        ]) : ''
    ];
    $items = array_filter($items);

    // set content
    $content = $assets->load($items, $opt);

    // if debug remove old cache
    if(config()->debug && cache()->get($caheName)) {
        cache()->delete($caheName);
    }

    // set cached content
    if(!config()->debug) {
        cache()->save($caheName, $content, $opt['cacheTime']);
    }

    // Load items
    return $content;
}

/**
 * Load external assets.
 *
 * This function is a wrapper around the `siteAssets` function, designed to load external CSS and JavaScript assets.
 * It allows for additional customization by setting default options specifically for external assets.
 * The options include deferred JavaScript loading and a different asset prefix.
 *
 * @param array $css Array of CSS file paths to load.
 * @param array $js Array of JavaScript file paths to load.
 * @param array $opt Optional configuration array. Supported options include:
 * - 'jsDefer' (bool): Whether to add the 'defer' attribute to script tags (default: true).
 * - 'preload' (bool): Whether to preload the assets (default: true).
 * - 'prefix' (string): The prefix for the generated asset file names (default: 'external').
 *
 * @return string HTML markup for loading the assets.
 */
function _externalAssets($css = [], $js = [], $opt = []) {
    $defOpt =  [
        'jsDefer' => true,
        'preload' => true,
        'prefix' => 'external',
        'dfOnce' => true
    ];
    $opt = array_merge($defOpt, $opt);
    return _siteAssets($css, $js, $opt);
}

/**
 * Helper function to return a singleton instance of Comments
 *
 * @return \ProcessWire\Comments The instance of Comments
 */
function _comments() {
    // Static variable to hold the instance of Comments class
    static $comments = null;

    // Instantiate the Comments class only once
    if ($comments === null) {
        $comments = new Comments();
    }

    return $comments;
}

/**
 * Generate an HTML list (ul or ol) with links using PageArray.
 *
 * @param PageArray $items - PageArray object containing the items to be listed.
 * @param array $opt - Configuration options:
 *   - 'heading' (string): Optional heading to be placed before the list.
 *   - 'listType' (string): Type of list ('ul' for unordered list or 'ol' for ordered list).
 *   - 'listClass' (string): CSS class for the list.
 *   - 'itemClass' (string): CSS class for list items.
 *   - 'linkClass' (string): CSS class for links within list items.
 *   - 'ref' (bool): Show item references ( element span ) to another pages.
 *   - 'refClass' (string): CSS class for the references span element.
 * @return string - The generated HTML list.
 */
function _listLinks(PageArray $items, $opt = array()) {

    if(!$items instanceof PageArray) return '';
    if ($items->count() === 0) return ''; // No items to list.

    // reset variables
    $itemSpan = '';
    $listHTML = '';

    $default = [
        'heading' => '',        // Optional heading.
        'listType' => 'ul',     // Default to an unordered list.
        'listClass' => 'list-class',
        'itemClass' => 'item-class',
        'linkClass' => 'link',
        'ref' => false,
        'refClass' => 'reference-class',
    ];
    $opt = array_merge($default, $opt);

    foreach ($items as $item) {

        // item references
        $countRef = $item->references();

        if($opt['ref'] && !$countRef) {
            continue;
        }

        if( $opt['ref'] ) {
            $itemSpan = Html::span(" (". count($countRef) . ")", ['class' => $opt['refClass']]);
        }

        $linkItem = Html::a($item->url, $item->title . $itemSpan, ['class' => $opt['linkClass']]);

        $listHTML .= Html::li($linkItem, ['class' => $opt['itemClass']]);
    }
    return $opt['heading'] . Html::el($opt['listType'], $listHTML,[
        'class' => $opt['listClass'],
        'hx-boost' => _hxBoost() ? 'true' : 'false'
    ]);
}

/**
 * Generate an HTML Page reference list (ul or ol) with links using PageArray.
 * @param PageArray $items
 * @param array $opt - Configuration options:
 * @see listLinks()
 */
function _refItems($items, $opt = array()) {

    if(!$items instanceof PageArray) return '';
    if(!$items->count) return '';

    $default = [
            'heading' => '',
            'listClass' => 'refItems',
            'linkClass' => 'btn',
            'ref' => true
    ];
    $opt = array_merge($default, $opt);

    if(!$opt['heading'] && $items->parent()[0]['url'] && $items->parent()[0]['title']) {
        $opt['heading'] = Html::h3('&#10095;&nbsp;' . Html::a($items->parent()[0]['url'], $items->parent()[0]['title']),
        ['hx-boost' => _hxBoost() ? 'true' : 'false']);
    }

    return _listLinks($items,$opt);
}

/**
 * Get the IP address of the current user
 */
function _getIP() {
    return session()->getIP();
}

/**
 * Get the country name from IP address using DB-IP.
 *
 * @param string $ip
 * @return string
 */
function _getCountryFromIP($ip) {
    // Check for localhost
    if ($ip === '127.0.0.1' || $ip === '::1') {
        return 'Localhost'; // or any other placeholder for testing
    }

    /**
     * Path to the DB-IP Country database ( https://db-ip.com/db/download/ip-to-country-lite )
     * The free IP to Country Lite database by DB-IP is licensed under a Creative Commons Attribution 4.0 International License.
     * You are free to use this IP to Country Lite database in your application, provided you give attribution to DB-IP.com for the data.
     * In the case of a web application, you must include a link back to DB-IP.com on pages that display or use results from the database.
     * You may do it by pasting the HTML code snippet below into your code : <a href='https://db-ip.com'>IP Geolocation by DB-IP</a>
     *
     */

    // set dbipCountry database path
    config()->setPath('dbipCountry', __DIR__ . '/inc/dbip-country-lite-2025-03.mmdb');
    $databaseFile = substr_replace(config()->path('dbipCountry'),'', -1);

    try {
        // Create a GeoIP2 Reader instance
        $reader = new \GeoIp2\Database\Reader($databaseFile);

        // Get country information based on IP address
        $record = $reader->country($ip);
        return $record->country->isoCode; // Return the country code
    } catch (\Exception $e) {
        return 'unknown'; // Handle exceptions (e.g., IP not found)
    }
}

/**
 * Get contents from an SVG icon.
 *
 * @param string $icon The name of the icon to retrieve.
 * @param array $opt Optional parameters for rendering the icon.
 * @return string The rendered SVG icon as a string.
 *
 * @link https://phosphoricons.com/ - Visit the Phosphor Icons website.
 */
function _icon($icon, $opt = array()) {
    static $iconInstance;
    if (!$iconInstance) {
        $iconInstance = new Icon();
    }
    return $iconInstance->render($icon, $opt);
}

/**
 * Helper function to return a singleton instance of LottiePlayer
 *
 * @return \ProcessWire\LottiePlayer The instance of LottiePlayer
 */
function _lottie() {
    // Static variable to hold the instance of LottiePlayer class
    static $lottie = null;

    // Instantiate the LottiePlayer class only once
    if ($lottie === null) {
        $lottie = new LottiePlayer();
    }

    return $lottie;
}

/**
 * Get an instance of the Embera Oembed consumer.
 *
 * @return \ProcessWire\HelperOembed An instance of the HelperOembed class.
 */
function _embera() {
    static $embera;
    if (!$embera) {
        $embera = modules()->get('HelperOembed');
    }
    return $embera;
}

/**
 * Embed a media item using the Embera Oembed consumer.
 *
 * This function takes a media item (URL) and retrieves the corresponding embed code
 * using the HelperOembed instance.
 *
 * @param string $item The URL of the media item to embed.
 * @param array $opt Options to modify default behavior.
 * @param array $emberaOptions Options to modify default Embera behavior.
 *
 * @return string The HTML embed code for the media item.
 */
function _embed($item, $opt = [], $emberaOptios = []) {

    /** @var HelperOembed $embera */
    $embera = _embera();

    $default = [
        'filters' => true, // load content via HTMX response
    ];
    $opt = array_merge($default, $opt);

    $content = $embera->embed($item, $opt, $emberaOptios);

    if(!$content) return '';

    // cleanup content
    $content = preg_replace('/<p>\s*(<article[^>]*>.*?<\/article>)\s*<\/p>/is', '$1', $content);

    // return content
    return $content;
}

/**
 * set translations 
 * @var string $item Get default translation item name
 * @var string $defaultLanguage
 */
function _t($item = '', $defaultLanguage = '') {
    $defaultLanguage = $defaultLanguage ?: setting('defaultLanguage');
    $translation = new Translation($defaultLanguage);
    return $translation->get($item);
}

/**
 * Checks if language support is enabled on the site
 * @var Page $page
 */
function _hasLanguageSupport($page) {
    if(!$page instanceof Page) return false;
    return $page->getLanguages() && modules()->isInstalled("LanguageSupportPageNames");
}

/**
 * Determines the multilingual prefix for the current page URL.
 * This function checks if the current request URI has a language prefix,
 * and if so, returns it.
 *
 * @param Page $page The page object for which the language prefix is being determined.
 * @return string|null The language prefix (e.g. 'en/') if it exists, otherwise null.
 */
function _langPrefix($page) {

    // Check if the page has language support, return null if not
    if (!_hasLanguageSupport($page)) return null;

    // Parse the current request URI to extract the first segment
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $firstInput = $uriSegments[1];
    $firstInput = sanitizer()->pageName($firstInput);

    // Initialize an array to hold available languages
    $langs = [];

    // Iterate through all available languages and collect their names
    foreach (languages() as $language) {
        // Get the language's name for the current language
        $langName = pages('/')->getLanguageValue($language, 'name');

        // Handle cases where the language name is 'home' (e.g. default or fallback language)
        if ($langName == 'home') $langName = _t('htmlLang'); // Translate the default language label

        // Add the language name to the array
        $langs[] = $langName;
    }

    // If the first segment of the URI matches one of the available languages, return the language prefix
    if (in_array($firstInput, $langs)) {
        return $firstInput . '/'; // Return the prefix with a trailing slash
    }

    // Return null if no matching language prefix is found
    return null;
}

/**
 * Sanitize the URL to ensure it is safe.
 */
function _cleanURL($url = '') {
    if(!$url) return '';
    $url = sanitizer()->url($url);
    return $url;
}

/**
 * Constructs and returns a full URL based on the provided parameters and the current site configuration.
 *
 * This function generates a complete URL by considering the base site URL, language settings, and any specific
 * page or language parameters provided.
 *
 * @param string $url  The URL segment to append to the base site URL. Defaults to an empty string.
 * @param string $lang The language code to use for the URL. Defaults to an empty string.
 * @param Page|null $page The page object, used to determine the correct language context if provided. Defaults to null.
 *
 * @return string The fully constructed and cleaned URL.
 */
function _setURL($url = '', $lang = '', $page = null) {

    $lang = '';

    if(_hasLanguageSupport($page) && _t('htmlLang')) {
        $langName = page()->getLanguageValue(user()->language->name, 'name');
        if($page) {
            $langName = $page->getLanguageValue(user()->language->name, 'name');
        }

        $lang = _t('htmlLang') ?: $lang;
        $lang .= '/';

        // if not set any language prefix
        if($langName == 'home') {
            $lang = '';
        }
    }

    // Construct a full URL using the HTTP host and provided URL.
    $url = input()->httpHostUrl() . "/{$lang}{$url}";

    // cleanup url
    $url = _cleanURL($url);

    return $url;
}

/**
 * Generates an modal with dynamic content and styling.
 *
 * This method creates a modal with a unique z-index, styling, and content. The modal is initialized with Alpine.js
 * data and event handlers for opening and closing. It includes an overlay and a close button with customizable
 * content. The modal also supports closing via the Escape key and clicking outside the modal.
 *
 * @param string $content The HTML content to be displayed inside the modal.
 *
 * @return string Returns the HTML structure for the modal, including Alpine.js directives and styling.
 */
function _modal($content, $customStyle = '') {
    $zx = time();
    $icon = _icon('x');

    // Checking if last modal deletion is active
    $removeLastModal = input()->get('remove-last-modal') == 1 ? 'true' : 'false';

    $style = Html::styleTag(<<<CSS
        body {
            overflow: hidden;
        }
        .root-{$zx} {
            background: color-mix(in srgb, var(--bg-color), transparent 5%);
            overflow: auto;
            z-index: {$zx};
        }

        .el-{$zx} {
            margin: var(--sp-xl) auto;
            padding: var(--sp-lg);
            max-width: var(--mw-lg);
            .modal-close-btn {
                display: block;
                margin: auto;
                margin-top: var(--sp-2xl);
            }
            > :first-child {
                margin: auto;
                &:not(label) {
                    display: block;
                }
            }
            {$customStyle}
        }
    CSS);

    return <<<HTML
        <div
            id='root-{$zx}'
            class='root-{$zx} overlay'
            x-data="{ open: true, removeLast: {$removeLastModal} }"
            x-init="
                if (removeLast) { 
                    let modals = document.querySelectorAll('.overlay');
                    
                    if (modals.length > 1) { 
                        let sortedModals = Array.from(modals).sort((a, b) => 
                            parseInt(window.getComputedStyle(a).zIndex) - parseInt(window.getComputedStyle(b).zIndex)
                        );
                        
                        let oldestModal = sortedModals[0]; // We download the modal with the lowest z-index

                        if (oldestModal) {
                            oldestModal.classList.add('fade-out');
                            setTimeout(() => {
                                oldestModal.remove();
                                let modalId = oldestModal.id.replace('root-', 'modal-opened-');
                                document.body.classList.remove(modalId); // Deletes only the oldest modal
                            }, 400);
                        }
                    }
                }
                
                \$el.classList.add('fade-in');
                document.body.classList.add('modal-opened-{$zx}');
            "
            @keydown.window.escape="
                let modals = document.querySelectorAll('.overlay');

                let highestModal = Array.from(modals).reduce((max, el) => 
                    parseInt(window.getComputedStyle(el).zIndex) > parseInt(window.getComputedStyle(max).zIndex) ? el : max
                );

                if (highestModal === \$el && open) {
                    \$el.classList.add('fade-out');
                    setTimeout(() => {
                        \$el.remove();
                        document.body.classList.remove('modal-opened-{$zx}');
                    }, 400);
                }
            "
        >
            <div id='el-{$zx}' class='el-{$zx}' x-show="open"
                @click.outside="
                    let modals = document.querySelectorAll('.overlay');

                    let highestModal = Array.from(modals).reduce((max, el) => 
                        parseInt(window.getComputedStyle(el).zIndex) > parseInt(window.getComputedStyle(max).zIndex) ? el : max
                    );

                    if (highestModal === \$root && open) {
                        \$root.classList.add('fade-out');
                        setTimeout(() => {
                            \$root.remove();
                            document.body.classList.remove('modal-opened-{$zx}');
                        }, 400);
                    }
                "
            >
                <!-- Content -->
                {$content}

                 <!-- Close button -->
                 <button
                    class='modal-close-btn btn -icon'
                    @click="
                        document.getElementById('root-{$zx}').classList.add('fade-out');
                        document.body.classList.remove('modal-opened-{$zx}');
                        setTimeout(() => document.getElementById('root-{$zx}').remove(), 400);
                    "
                >
                    {$icon}
                </button>
            </div>
            {$style}
        </div>
    HTML;
}

/**
 * Returns Phiki-formatted content (syntax highlighter).
 *
 * @link https://github.com/phikiphp/phiki
 * @see \Phiki\Phiki Main class for syntax highlighting.
 * @see \Phiki\Grammar\Grammar Available grammar definitions.
 * @see \Phiki\Theme\Theme Available themes for styling.
 *
 * @param string $content The code to be highlighted.
 * @param array  $opt     An array of options to customize the output.
 *                        - 'title' (string) The title for the block (default: '').
 *                        - 'grammar' (string) The syntax grammar (default: 'Php').
 *                        - 'theme' (string) The theme for highlighting (default: 'GithubDark').
 * @return string The highlighted code wrapped in a styled block.
 */
function _phiki($content, $opt = []) {

    $defaults = [
        'title' => '', 
        'content' => '',
        'grammar' => 'Php',
        'theme' =>  'TokyoNight',
        'codeTo' => 'codeToHtml',
    ];
    $opt = array_merge($defaults, $opt);

    return _block('_blockPhiki', [
        'content' => $content, 
        'title' => $opt['title'], 
        'grammar' => $opt['grammar'],
        'theme' => $opt['theme'],
        'codeTo' => $opt['codeTo'],
    ]);
}

/**
 * Helper function to return a singleton instance of FlashMessage
 *
 * @return \ProcessWire\FlashMessage The instance of FlashMessage
 */
function _flashMessage() {
    // Static variable to hold the instance of FlashMessage class
    static $flashMessage = null;

    // Instantiate the FlashMessage class only once
    if ($flashMessage === null) {
        $flashMessage = new FlashMessage();
    }

    return $flashMessage;
}

/**
 * Helper function to return a singleton instance of MobileDetect
 *
 * Uses a static variable to ensure that the MobileDetect instance
 * is created only once during the execution of the script.
 *
 * @return \Detection\MobileDetect The instance of MobileDetect
 */
function _detect() {
    // Static variable to hold the instance of MobileDetect class
    static $detect = null;

    // Instantiate the MobileDetect class only once
    if ($detect === null) {
        $detect = new \Detection\MobileDetect();
    }

    return $detect;
}

/**
 * Checks if the current device is a mobile device.
 *
 * @return bool True if the device is mobile, false otherwise.
 */
function _isMobile() {
    return _detect()->isMobile();
}

/**
 * Checks if the current device is a tablet.
 *
 * @return bool True if the device is a tablet, false otherwise.
 */
function _isTablet() {
    return _detect()->isTablet();
}

/**
 * Checks if the current device is a desktop (not mobile or tablet).
 *
 * @return bool True if the device is a desktop, false otherwise.
 */
function _isDesktop() {
    return !_isMobile() && !_isTablet();
}

/**
 * render CSRF input
 * @link https://processwire.com/api/ref/session/c-s-r-f/
 */
function _renderCSRF() {
    return session()->CSRF->renderInput();
}

/**
 * Validates the CSRF token for the current session.
 * If the token is invalid, it sends a 403 Forbidden response
 * 
 * @link https://processwire.com/api/ref/session/c-s-r-f/
 *
 * @return bool Returns true if the CSRF token is valid, false otherwise.
 */
function _isValidCSRF() {
    if (!session()->CSRF->hasValidToken()) {
        if (!headers_sent()) {
            header("HTTP/1.1 403 Forbidden");
        }
        return false; // No echo, just return false
    }
    return true;
}

/**
 * Check if module HelperFlatFilesBooster is enabled
 * @return bool
 */
function _isEnabledFilesBooster(): bool {
    $flBoosterName = 'HelperFlatFilesBooster';

    if (!modules()->isInstalled($flBoosterName)) {
        return false;
    }

    /** @var HelperFlatFilesBooster|null $flBooster */
    $flBooster = modules()->get($flBoosterName);

    return $flBooster && $flBooster->checkBoost == true;
}

/**
 * Save log data using ProcessWire's logging system.
 *
 * This function supports both string and array log data. Arrays are converted to JSON format before saving.
 * It uses the ProcessWire wire()->log API to save logs with different types.
 *
 * Usage:
 * _saveLog('Simple log message');
 * _saveLog(['user' => 'admin', 'action' => 'login'], ['fileName' => 'user-log']);
 * _saveLog('Error message', ['type' => 'error']);
 *
 * @param string|array $logData Log message or array of data to be logged.
 * @param array $opt Optional parameters for log (message, warning, error):
 *                   - fileName (string): Log file name (default: 'custom-log')
 *                   - type (string): Log type (save, message, warning, error) - default: 'save'
 *                   - flags (int): Additional flags for the log type (default: 0)
 * @return string|void Log message or void depending on the type used.
 */
function _saveLog($logData = '', $opt = []) {

    if (!$logData) return '';

    // Default options
    $defaults = [
        'fileName' => 'custom-log', // Default log file name
        'type' => 'save',        // Default type (save, message, warning, error)
        'flags' => 0,             // Optional flags for log type
    ];

    // Merge user options with defaults
    $opt = array_merge($defaults, $opt);
    // Remove empty options
    $opt = array_filter($opt, fn($value) => $value !== null);

    // Internal log saving function
    $saveLog = function($logData = '', $opt = []) {
        match ($opt['type']) {
            'save' => wire()->log->save($opt['fileName'], $logData, $opt),
            default => wire()->log->{$opt['type']}($logData, $opt['flags']),
        };
    };

    // If log data is not an array, save directly
    if (!is_array($logData)) {
        return $saveLog($logData, $opt);
    }

    // Cleanup and encode array log data to JSON
    $logData = array_filter($logData);
    $logData = json_encode($logData);

    // Save JSON log if conversion was successful
    if ($logData) {
        return $saveLog($logData, $opt);
    }
}

/**
 * Helper to save log data with type 'save'.
 *
 * @param string $name Log file name.
 * @param string $content Log content.
 * @param array $opt Options to modify default behavior:
	 *   - `showUser` (bool): Include the username in the log entry? (default=true)
	 *   - `showURL` (bool): Include the current URL in the log entry? (default=true) 
	 *   - `user` (User|string|null): User instance, user name, or null to use current User. (default=null)
	 *   - `url` (bool): URL to record with the log entry (default=auto determine)
	 *   - `delimiter` (string): Log entry delimiter (default="\t" aka tab)
 * @return string|void Log message or void.
 */
function _log($name = 'log-name', $content = '', $opt = []) {
    $opt['fileName'] = $name;
    $opt['type'] = 'save';
    return _saveLog($content, $opt);
}

/**
 * Helper to save log data with type 'message'.
 *
 * @param string $content Log content.
 * @param bool|int $flags Specify boolean true to also have the message displayed interactively (admin only).
 * @return string|void Log message or void.
 */
function _logMessage($content = '', $flags = 0) {
    $opt = [
        'type' => 'message',
        'flags' => $flags
    ];
    return _saveLog($content, $opt);
}

/**
 * Helper to save log data with type 'warning'.
 *
 * @param string $content Log content.
 * @param bool|int $flags Specify boolean true to also have the message displayed interactively (admin only).
 * @return string|void Log message or void.
 */
function _logWarning($content = '', $flags = 0) {
    $opt = [
        'type' => 'warning',
        'flags' => $flags
    ];
    return _saveLog($content, $opt);
}

/**
 * Helper to save log data with type 'error'.
 *
 * @param string $content Log content.
 * @param bool|int $flags Specify boolean true to also have the message displayed interactively (admin only).
 * @return string|void Log message or void.
 */
function _logError($content = '', $flags = 0) {
    $opt = [
        'type' => 'error',
        'flags' => $flags
    ];
    return _saveLog($content, $opt);
}

/**
 * Retrieve log entries from a ProcessWire log file.
 *
 * This function fetches entries from the specified log file, optionally filtering 
 * by a specific column and applying additional options.
 *
 * @param string $logFileName The name of the log file.
 * @param string $loadColumn (Optional) The specific column to extract from each entry.
 * @param array $options Optional options to modify default behavior: 
 * 	- `limit` (integer): Specify number of lines (default=100)
 * 	- `text` (string): Text to find. 
 * 	- `dateFrom` (int|string): Oldest date to match entries. 
 * 	- `dateTo` (int|string): Newest date to match entries. 
 * 	- `reverse` (bool): Reverse order (default=true)
 * 	- `pageNum` (int): Pagination number 1 or above (default=0 which means auto-detect)
 * @return array|null Returns an array of log entries, a specific column's values, or null if no entries are found.
 */
function _getLogEntries($logFileName = '', $loadColumn = '', $options = []) {

    // Return null if no log file name is provided
    if (!$logFileName) return null;

    // Check if the log file exists in ProcessWire logs
    if (!wire()->log->exists($logFileName)) return null;

    // Retrieve log entries with optional filtering
    $entries = wire()->log->getEntries($logFileName, $options);

    // Remove empty values from the entries
    $entries = array_filter($entries);

    // If no specific column is requested, return all filtered entries
    if (!$loadColumn) {
        return count($entries) ? $entries : null;
    }

    // Extract values for the specified column
    $entries = array_column($entries, $loadColumn);

    // Return the extracted column values or null if empty
    return count($entries) ? $entries : null;
}

/**
 * Generate AVIF file from image
 */
function _generateAvif($img, $ext = ['jpg']) {

    // Check if the server supports AVIF
    if (!(imagetypes() & IMG_AVIF)) {
        return false; // AVIF is not supported
    }

    // set AVIF filename
    $setFileName = pathinfo($img->name, PATHINFO_FILENAME) . '.avif';

    // Check if image extension matches allowed formats
    if (in_array($img->ext, $ext)) {

        // get page images stored path
        $imgFolderPaths = $img->pagefiles->path;

        // get file path
        $imgFilePath = $imgFolderPaths . $img->name;

        // Check if .avif file already exists
        if (file_exists($imgFolderPaths . $setFileName)) return false;

        // Create an image from the original file
        $image = imagecreatefromjpeg($imgFilePath);

        // Attempt to save as AVIF
        if (imageavif($image, $imgFolderPaths . $setFileName)) {
            imagedestroy($image);
            return true; // AVIF file created successfully
        }

        // Release resources if saving failed
        imagedestroy($image);
    }

    return false; // AVIF file not created
}

/**
 * Formats the alt text for an image by removing any content after the first dot,
 * replacing hyphens with spaces, and capitalizing the first letter of each word.
 * Additionally, if the text is a file path, it will return the filename without the extension.
 *
 * @param string $text The original alt text, which may be a file path or URL.
 * @return string The formatted alt text, which is the filename without extension if it's a path.
 */
function _formatAltText($text) {
    // Remove everything after the dot
    $text = strtok($text, '.');

    // Replace '-' with a space and capitalize the first letter of each word
    $text = ucwords(str_replace('-', ' ', $text));

    // Return the filename without the extension if it's a file path
    return pathinfo($text, PATHINFO_FILENAME);
}

/**
 * Get AVIF image markup
 *
 * @param PageImage $img Image object
 * @param array $opt Options for generating the image
 * @return string HTML markup for the AVIF image or original image
 */
function _getAvif($img, $opt = [], $defaultImgOpt = []) {
    if (!$img instanceof PageImage) return '';

    $defaults = [
        'description' => $img->description,
        'aspectRatio' => "16 / 9",
        'objectFit' => 'cover',
        'objectPosition' => 'center',
        'class' => '',
        'lozad' => true,
        'maxWidth' => $img->width,
        'generate' => true,
        'allowedFormats' => ['jpg'],
        'onlyThumb' => false,
        'defaultImgOpt' =>  $defaultImgOpt, // if no generate avif
    ];
    $opt = array_merge($defaults, $opt);

    $stopReflow = '';
    $src = 'src';
    $srcSet = 'srcset';

    // generate avif file
    _generateAvif($img, $opt['allowedFormats']);

    // Get thumb variations
    $imgThumb = $img->getVariations()->first;

    // generate thumb
    if ($imgThumb instanceof PageImage && isset($opt['generate']) && $opt['generate']) {
        _generateAvif($imgThumb, $opt['allowedFormats']);
        $thumbPath = $imgThumb->pagefiles->path . str_replace($img->ext, 'avif', $imgThumb->name);
        $imgThumb = file_exists($thumbPath) ? str_replace($img->ext, 'avif', $imgThumb->url) : $imgThumb->url;
    }

    // Lozad support
    if ($opt['lozad']) {
        $class = trim($opt['class'] . ' lozad');
        $src = 'data-src';
        $srcSet = 'data-srcset';
        $stopReflow = function($width = 640) {
            return
            <<<HTML
                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='{$width}' height='auto' viewBox='0 0 300 200'%3E%3C/svg%3E"
            HTML;
        };
    }

    $setFileName = pathinfo($img->name, PATHINFO_FILENAME) . '.avif';
    $imgFolderPaths = $img->pagefiles->path;

    if (!file_exists($imgFolderPaths . $setFileName)) return Html::img($img, $opt['defaultImgOpt']);

    $imgURL = pathinfo($img->url, PATHINFO_DIRNAME) . '/' . $setFileName;

    if($imgThumb) {
        $srcSet = "$srcSet='{$imgThumb} 320w, {$imgURL}'";
    }

    if($opt['onlyThumb'] && $imgThumb) {
        $srcSet = '';
        $img = $img->getVariations()->first;
        $imgURL = $imgThumb;
        $opt['maxWidth'] = 420;
    }

    $description = $img->description ?: _formatAltText($img->name);

    // set reflow
    $stopReflow = $stopReflow($img->width);
    return <<<HTML
        <img
            {$stopReflow}
            class="{$class} responsive"
            $src="{$imgURL}"
            {$srcSet}
            alt="{$description}"
            width="{$img->width}"
            height="auto"
            style="aspect-ratio: {$opt['aspectRatio']}; max-width: {$opt['maxWidth']}px; object-fit: {$opt['objectFit']}; object-position: {$opt['objectPosition']};"
            alt="{$opt['description']}"
        />
    HTML;
}

/**
 * Renders an email template with optional live preview functionality.
 * 
 * This function renders an email template located in the `assets/emails/` directory, passing custom variables
 * for dynamic content insertion. It optionally displays the rendered email inside a `<div>` container
 * with an `iframe` for live preview functionality.
 * 
 * The `livePreview` option encodes the provided variables as JSON and passes them as a GET parameter
 * to the preview endpoint, allowing real-time preview of dynamic content.
 * 
 * @see ProcessWire\WireFileTools::render
 * 
 * @param string $fileName The email template file name (without extension) to be rendered.
 *                         The file should be located in the `assets/emails/` directory.
 * @param array $vars An associative array of variables to inject into the email template.
 *                    Example: ['siteName' => 'Website', 'content' => 'Welcome message']
 * @param array $options Optional array of rendering options.
 *                       - `livePreview` (bool): If true, the function will return an HTML preview with an `iframe`.
 * @return string The rendered email content or live preview HTML if `livePreview` is enabled.
 * 
 * @example
 * Example usage with live preview:
 * ```php
 * $content = _renderMail('_call-to-action', [
 *     'siteName' => _site()->name,
 *     'siteUrl' => _site()->url,
 *     'logoURL' => _site()->logo->httpUrl,
 *     'welcome' => 'Welcome to our service!',
 *     'callToActionTitle' => __('See our blog'),
 *     'callToActionLink' => _site()->blogPage->httpUrl,
 * ], ['livePreview' => true]);
 * 
 * echo $content; // live preview
 * ```
 * 
 * Example usage with email sending:
 *  set ['livePreview' => false]
 * ```php
 * // Send email with ProcessWire wireMail()
 * $m = wireMail();
 * $m->to('message-to-guest@gmail.com')
 *   ->from(_site()->email, _site()->name)
 *   ->subject('Welcome New User')
 *   ->body(strip_tags($content))
 *   ->bodyHTML($content);
 * 
 * if($m->send()) {
 *     _alpine()->alert('Success', 'success');
 * }
 * ```
 */
function _renderMail($fileName, $vars = [], $options = []) {

    $filePath = "assets/emails/{$fileName}.php";

    if(!files()->exists(paths()->templates . $filePath)) return Html::p("No found file in the $filePath");
    
    $content = files()->render($filePath, $vars, $options);

    if(isset($options['livePreview']) && $options['livePreview'] == true) {

       $encodedVars = urlencode(base64_encode(json_encode($vars)));
    
        $icon = _icon('envelope-simple', ['size' => 'xl']);
        $heading = Html::h3(__('Email preview - ') . $fileName . '.php', ['class' => 'outline -accent']);
        return
            Html::div($icon . $heading . '<hr>' .
            <<<HTML
                <iframe src="_email-preview-{$fileName}?vars={$encodedVars}" width="100%" height="600" sandbox="allow-same-origin"></iframe>
            HTML, ['class' => 'card']);
    }
        
    return $content;
}

/**
 * Check if an email or IP address is blacklisted.
 * @param string $email Email address to check.
 * @param string $ip IP address to check.
 * @param array $blacklist Blacklist containing email addresses and IP addresses.
 * @return bool True if email or IP is blacklisted, false otherwise.
 */
function _isBlacklisted($email = '', $ip = '', $blacklist = array()) {
    if(!is_array($blacklist)) return false;

    // set default blacklist
    $defaults = [
        // 'test@gmail.com',
        // '192.168.0.1',
    ];

    // merge defaults with provided blacklist
    $blacklist = array_merge($defaults, $blacklist);

    // check if email or IP is in the blacklist
    $isEmailBlacklisted = in_array($email, $blacklist);
    $isIpBlacklisted = in_array($ip, $blacklist);

    return $isEmailBlacklisted || $isIpBlacklisted;
}

/**
 * Formats a file size into a more readable format.
 *
 * This function converts a byte count into the appropriate unit (B, KB, MB, GB, TB)
 * and formats the output for easier reading.
 *
 * @param int $bytes The number of bytes to format.
 * @param int $decimals The number of decimal places to display. Defaults to 0,
 *                      meaning no decimal places will be shown.
 *
 * // Example usage
 * ```php
    $logSizeFormatted = _formatFileSize(2400, 0); // Does not show decimal places
 * ```
 * @return string A formatted string representing the file size with its unit.
 */
function _formatFileSize($bytes, $decimals = 2) {
    $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f%s", $bytes / pow(1024, $factor), $sizes[$factor]);
}

/**
 * Converts a given number of seconds into a human-readable time period.
 *
 * This function maps specific durations (in seconds) to corresponding
 * human-readable labels, such as "minute", "hour", or "day". If the
 * input seconds do not match any predefined values, it returns "none".
 *
 * @param int $seconds The number of seconds to convert.
 * @return string The human-readable label for the given duration, or "none" if no match is found.
 *
 * Examples:
 * - 60        -> "minute"
 * - 3600      -> "hour"
 * - 7200      -> "2 hours"
 * - 86400     -> "day"
 * - 604800    -> "week"
 * - 99999     -> "none"
 */
function _secondsToReadableTime($seconds) {
    $message = match ((int)$seconds) {
        60 => __('minute'),
        3600 => __('hour'),
        7200 => __('2 hours'),
        14400 => __('4 hours'),
        21600 => __('6 hours'),
        43200 => __('12 hours'),
        86400 => __('day'),
        172800 => __('2 days'),
        345600 => __('4 days'),
        604800 => __('week'),
        1209600 => __('2 weeks'),
        2419200 => __('4 weeks'),
        default => 'none',
    };

    return $message;
}

/**
 * return spin
 */
function _spin($size = 70, $id='spinner', $class = 'spinner') {
    return <<<HTML
        <svg id='{$id}' class='{$class}' viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg" width='{$size}' height='{$size}'>
            <circle class="spin" cx="400" cy="400" fill="none"
                r="200" stroke-width="50" stroke="#E387FF"
                stroke-dasharray="700 1400"
                stroke-linecap="round" />
        </svg>
    HTML;
}

/**
 * return social share buttons
 * @var Page $item
 * @link https://ellisonleao.github.io/sharer.js/
 */
function _sharerJs($item = null, $title = true) {

    if(!$item) return '';

    // reset variables
    $items = '';

    // title
    $title = $title ? Html::p(_t('share')) : '';

    // set all items
    $sharedItems = WireArray([
        'x',
        'facebook',
        'telegram',
        'linkedin',
        'email',
        // 'whatsapp',
        // 'pocket',
        // 'reddit',
    ]);

    // loop items
    foreach($sharedItems as $shared) {
        // set icon
        $sharedIcon = match ($shared) {
            'email' => 'at',
            // 'twitter' => 'x-logo',
            default => $shared . '-logo',
        };
        $icon = _icon($sharedIcon);

        // set title
        $sharedTitle = match ($shared) {
            'x' => 'x.com',
            default => $shared,
        };

        // set items
        $items .= <<<HTML
            <button
                title='Share on $sharedTitle'
                class='btn -icon'
                data-sharer='$shared'
                data-title='$item->title'
                data-hashtags='$item->name'
                data-url='$item->httpUrl'
            >$icon</button>
        HTML;
    }

    // set region js
    $script = _globalRegion(__FUNCTION__, Html::scriptSrcTag('https://cdn.jsdelivr.net/npm/sharer.js@0.5.2/sharer.min.js'));

    // content
    return <<<HTML
        {$script}
        <div id='sharer-js' class='sharer-js'>
            {$title}
            {$items}
        </div>
    HTML;
}
