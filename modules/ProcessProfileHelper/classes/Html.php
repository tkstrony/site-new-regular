<?php namespace ProcessWire;

/**
 * html elements
 */
class Html {


    /**
     * Check if a String Contains HTML Tags.
     *
     * This function uses a regular expression to check whether a string contains any HTML tags.
     * If the string contains any HTML tags, the function returns true; otherwise, it returns false.
     *
     * @param string $string The string to check.
     * @return bool True if the string contains HTML tags; false otherwise.
     */
    public static function isHtml($string) {
        return preg_match("/<[^<]+>/", $string, $m) != 0;
    }

    /**
     * Return HTML element
     * @param string $el - HTML element name (e.g., 'div', 'p', 'a', etc.).
     * @param string $content - The content inside the element.
     * @param array $attr - Element html attributes.
     * @param array $opt - Configuration options.
     * @return string - The generated HTML code for the element.
     */
    public static function el($el, $content, $attr = [], $opt = []) {

        if (empty($content) && !isset($opt['allowEmpty'])) return '';

        // Default options
        $default = [
            'before' => '',
            'after' => '',
            'single' => false
        ];
        // Merge with default options
        $opt = array_merge($default, $opt);

        // Default attributes
        $defaultAttr = [
            'id' => '',
            'class' => '',
            'style' => '',
        ];
        // Merge with default attributes
        $attr = array_merge($defaultAttr, $attr);

        // Filter attributes, keeping boolean values and non-empty strings
        $attr = array_filter($attr, function($value) {
            // Keep non-empty strings, integers, and booleans (true/false)
            return $value !== null && $value !== '';
        });

        // Build attribute string
        $itemAttr = '';
        foreach ($attr as $key => $value) {
            if (is_bool($value)) {
                // Boolean true attributes are rendered without a value (e.g., 'disabled')
                if ($value) {
                    $itemAttr .= " $key";
                }
            } else {
                // Escape and append other attributes
                $escapedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $itemAttr .= " $key=\"$escapedValue\"";
            }
        }

        // Build the HTML element with optional before/after content
        $before = $opt['before'];
        $after = $opt['after'];

        $htmlElement = $before;
        $htmlElement .= "<$el{$itemAttr}>";
        $htmlElement .= !$opt['single'] ? $content : '';
        $htmlElement .= !$opt['single'] ? "</$el>" : '';
        $htmlElement .= $after;

        // Return the element
        return $htmlElement;
    }

    /**
     * Return HTML (div) element
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function div($content = '', $attr = [], $opt = []) {
        $el = 'div';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (section) element
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function section($content = '', $attr = [], $opt = []) {
        $el = 'section';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (small) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function small($content = '', $attr = [], $opt = []) {
        $el = 'small';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML link
     * @param string $href
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function a($href = '#', $content = '', $attr = [], $opt = []) {
        $el = 'a';

        if(isset($attr['blank']) && $attr['blank'] == true) {
            $attr['target'] = '_blank';
            $attr['rel'] = 'noopener noreferrer';
        }
        $attr['href'] = $href;
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (button) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function button($content = '', $attr= [], $opt = []) {
        $el = 'button';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (h1) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function h1($content = '', $attr= [], $opt = []) {
        $el = 'h1';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (h2) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function h2($content = '', $attr = [], $opt = []) {
        $el = 'h2';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (h3) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function h3($content = '', $attr = [], $opt = []) {
        $el = 'h3';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (p) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function p($content = '', $attr = [], $opt = []) {
        $el = 'p';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (ul) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function ul($content = '', $attr = [], $opt = []) {
        $el = 'ul';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (ol) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function ol($content = '', $attr = [], $opt = []) {
        $el = 'ol';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (li) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function li($content = '', $attr = [], $opt = []) {
        $el = 'li';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (span) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function span($content = '', $attr = [], $opt = []) {
        $el = 'span';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (title) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function title($content = '', $attr = [], $opt = []) {
        $el = 'title';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (strong) tag
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function strong($content = '', $attr = [], $opt = []) {
        $el = 'strong';
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (meta) tag
     * @param string $name
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function meta($name = '', $content = '', $attr = [], $opt = []) {
        $el = 'meta';

        // set single tag
        $opt['single'] = true;
        $opt['allowEmpty'] = true;

        // set attributes
        if(isset($attr['property'])) {
            $attr['property'] = $name;
        } else {
            $attr['name'] = $name;
        }
        $attr['content'] = $content;

        // Return the element
        return self::el($el, '', $attr, $opt);
    }

    /**
     * Return HTML (input) tag
     * @param string $name
     * @param string $value - input value
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function input($name = '', $value = '', $attr = [], $opt = [],) {
        $el = 'input';

        // set single tag
        $opt['single'] = true;
        $opt['allowEmpty'] = true;

        // set attributes

        $attr['name'] = $name;
        $attr['value'] = $value;

        // Return the element
        return self::el($el,'', $attr, $opt);
    }


    /**
     * Return HTML (style) tag.
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function styleTag($content = '', $attr = [], $opt = []) {
        $el = 'style';

        if(setting('csp') == true && !isset($attr['nonce'])) {
            $attr['nonce'] = session()->cspNonce;
        }

        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (script) tag.
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function scriptTag($content = '', $attr = [], $opt = []) {
        $el = 'script';

        if(setting('csp') == true && !isset($attr['nonce'])) {
            $attr['nonce'] = session()->cspNonce;
        }
        // Return the element
        return self::el($el, $content, $attr, $opt);
    }

    /**
     * Return HTML (script src) tag.
     * @param string $content
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function scriptSrcTag($content = '', $attr = [], $opt = []) {

        $el = 'script';

        // allow to empty content
        $opt['allowEmpty'] = true;

        // set csp
        if(setting('csp') == true && !isset($attr['nonce'])) {
            $attr['nonce'] = session()->cspNonce;
        }

        if(isset($attr['defer']) && $attr['defer'] == false) {
            unset($attr['defer']);
        } else {
            $attr['defer'] = true;
        }

        if(isset($attr['async']) && $attr['async'] == true) {
            unset($attr['defer']);
        }

        $attr['src'] = $content;

        // Return the element
        return self::el($el,'', $attr, $opt);
    }

    /**
     * Return HTML (link stylesheet) tag.
     * @param string $href
     * @param array $attr
     * @param array $opt
     * @return string
     */
    public static function linkStylesheetTag($href = '', $attr = [], $opt = []) {

        $el = 'link';

        // allow to empty content
        $opt['allowEmpty'] = true;

        // set csp
        if(setting('csp') == true && !isset($attr['nonce'])) {
            $optattr['nonce'] = session()->cspNonce;
        }

        $opt['single'] = true;
        $attr['rel'] = 'stylesheet';
        $attr['href'] = $href;

        // Return the element
        return self::el($el,'', $attr, $opt);
    }


    /**
     * Returns an HTML (image) tag - either the first image from the PageImages field or a single image URL.
     *
     * @param PageImage|PageImages|string $img The object containing the single image, multiple images, or a string URL.
     * @param array $opt Configuration options:
     *   - 'alt' (string): Alt attribute for the image (default: description of the first image in PageImages).
     *   - 'thumb' (bool): If true, resize the image to a thumbnail size (default: false).
     *   - 'lozad' (bool): If true, enable Lazy Loading for the image (default: true).
     *   - 'class' (string): CSS class for the image tag (default: '').
     *   - 'cf' (bool): Preventing `content reflow` from lazy-loaded images.
     *   - 'style' (string): Custom inline CSS styles for the image tag (default: '').
     *   - 'width' (string): Custom width for the image tag (default: '').
     *   - 'height' (string): Custom height for the image tag (default: '').
     * @link https://processwire.com/docs/fields/images/
     * @link https://css-tricks.com/preventing-content-reflow-from-lazy-loaded-images/
     * @return string Returns an HTML image tag or an empty string if no images or parameter errors.
     */

    public static function img($img, $opt = array()) {

        if(!$img) return '';

        // If $img is an instance of PageImages, return a message guiding the usage
        if ($img instanceof PageImages) {
            return 'Load only 1 image like `$page->images->first;` or inside a loop `foreach($page->images as $image) echo img($image);`';
        }
        // Set default instanceof PageImage
        $iop = true;
        // Set image src Attribute
        $src = 'src';
        // Content reflow
        $cf = '';
        // Set default attributes
        $default = [
            'alt' => '',
            'thumb' => false,
            'lozad' => true,
            'cf' => true,
            'class' => '',
            'style' => '',
            'width' => '',
            'height' => '',
            'fitCover' => true,
            'fitContain' => false,
        ];
        // Merge options with default attributes
        $opt = array_merge($default, $opt);

        // If $img is not an instance of PageImage, assume it's a URL string
        if (!$img instanceof PageImage) {
            $imgObject = new \stdClass();
            $imgObject->url = $img;
            $imgObject->width = $opt['width'] ?: '640';
            $imgObject->height = $opt['height'] ?: '420';
            $imgObject->alt = $opt['alt'];
            $imgObject->ext = pathinfo($img,PATHINFO_EXTENSION) ?: 'none-ext';
            // Set variable instanceof PageImage => false
            $iop = false;
            $img = $imgObject;
        }

        // Image alt
        if ($opt['alt'] && $iop == true) {
            $img->description = $opt['alt'];
        }

        // If the 'thumb' option is set to true, create a new image at the specified width
        // if ($opt['thumb'] == true && $iop == true) {
        //     $options = array(
        //         'quality' => 70,
        //     );
        //     $img = $img->width(640, $options);
        // }

        // Get first image variations
        if($opt['thumb'] == true && $iop == true) {
            $imgThumb = $img->getVariations()->first;
            if($imgThumb) {
                $img = $img->getVariations()->first;
            }
        }
    
        $width = $opt['width'] ?: $img->width;
        $height = $opt['height'] ?: $img->width;

        $customStyle = '';
        if($opt['fitCover'] == true) {
            // $customStyle = "width:{$width}px; height:{$height}px; object-fit: cover;";
            $customStyle = "object-fit: cover;";
        }

        if($opt['fitContain'] == true) {
            // $customStyle = "width:{$width}px; height:{$height}px; object-fit: cover;";
            $customStyle = "object-fit: contain;";
        }

        // set style
        $style = "style='{$customStyle} $opt[style]'";
        if(!$customStyle && !$opt['style']) $style = '';

        // set css class
        $class = $opt['class'];
        // If the 'lozad' option is set to true, use Lazy Loading
        if ($opt['lozad']) {
            $src = 'data-src';
            $class = 'lozad ' . $opt['class'];
            if ($opt['cf']) {
                $cf = 'src=' . '"' . "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='{$width}' height='{$height}' viewBox='0 0 {$img->width} {$img->height}'%3E%3C/svg%3E" . '"';
            }
        }

        return <<<HTML
            <img
                {$style}
                {$cf}
                {$src}='{$img->url}'
                class='{$class} _{$img->ext}'
                width='{$width}'
                height='{$height}'
                alt='{$img->alt}'
            >
        HTML;
    }

    /**
     * Generates HTML content with optional customization for head and footer.
     *
     * @param string $content The main content to be included in the <main> element.
     * @param array $opt An array of options for customization, including 'customHead' and 'customFooter'.
     *                   - 'title': Html title tag.
     *                   - 'customHead': Custom content to be added within the <head> element.
     *                   - 'customFooter': Custom content to be added before the closing </body> tag.
     *
     * @return string The generated HTML document.
     */
    public static function content($content, $opt = array()) {

        $default = [
            'title' => 'Title',
            'customHead' => '',
            'customFooter' => '',
            'uikit' => false,
        ];
        $opt = array_merge($default, $opt);

        // set uikit
        $uikt = $opt['uikit'] ? <<<HTML
                <!-- UIkit CSS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/css/uikit.min.css" />
                <!-- UIkit JS -->
                <script defer src="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/js/uikit.min.js"></script>
                <script defer src="https://cdn.jsdelivr.net/npm/uikit@3.19.1/dist/js/uikit-icons.min.js"></script>
        HTML : '';

        return
        <<<HTML
            <!DOCTYPE html>
            <html>
                <head id='head'>
                    <title>$opt[title]</title>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1" />
                    {$uikt}
                    <!-- Alpine -->
                    <script defer src="//unpkg.com/alpinejs"></script>
                    <!-- HTMX -->
                    <script defer src='https://unpkg.com/htmx.org@1.9.10'></script>
                    <!-- HYPERSCRIPT -->
                    <!-- <script defer src="https://unpkg.com/hyperscript.org@0.9.12"></script> -->
                    $opt[customHead]
                </head>
                <body>
                    <main id='main' class='uk-container uk-margin-medium-top'>
                        {$content}
                    </main>
                    $opt[customFooter]
                </body>
            </html>
        HTML;
    }
}
