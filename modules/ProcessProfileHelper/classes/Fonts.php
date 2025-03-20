<?php namespace ProcessWire;

/**
 * Class Fonts
 *
 * This class provides functionality for managing and rendering fonts in a web application.
 * It allows you to retrieve font information, generate CSS styles for fonts, and create preloader
 * links for efficient font loading. Additionally, it supports the dynamic rendering of fonts
 * with customizable options such as deletion and previewing of fonts.
 *
 * The class also supports translations for various user interface elements related to font management.
 */
class Fonts {

    /**
     * Constructor for the CookieConsent class.
     *
     * @param array $t An array of translations for the messages.
     */
    public function __construct(
        public array $t = array()
    ) {
        // translations
        $this->t = [
            'deleteFont' => __('Delete Font'),
            'deleteFontConfirm' => __('Are you sure you wish to delete this font?'),
            'fontFamily' => __('Font family'),
            'fontVariable' => __('Font variable'),
            'usage' => __('Usage'),
            'test' => __('Type here to preview text'),
        ];
    }

    /**
     * Retrieves information about fonts and generates CSS code, along with a preloader for them.
     *
     * @param array $fontNames - An array of font names to include, or ['all'] for all fonts.
     * @param array $opt - Configuration options:
     *   - 'loadAll' (bool): load all fonts from assets/fonts.
     *   - 'fontsPath' (string): Path for all fonts.
     *   - 'renderFonts' (bool): Show only content view for Fonts.
     *   - 'canDeleted' (bool): Add options to remove Fonts.
     *   - 'deletedUrl' (string): Url to delete font via htmx response.
     * @return string - HTML code containing links to the preloader, CSS code, and JavaScript script for dynamically adding HTML elements.
     */
    public function render($fontNames = array(), $opt = array()) {

        // Default configuration options.
        $defaults = [
            'loadAll' => true,
            'fontsPath' => 'assets/fonts/',
            'renderFonts' => false,
            'canDeleted' => false,
            'deletedUrl' => './list-fonts/delete/',
            'cacheTime' => 2419200, // 1 month.
        ];

        // Merge default options with the provided options.
        $opt = array_merge($defaults, $opt);

        // set cache key
        $caheName = _baseName(__CLASS__) . '_' . _baseName(__FUNCTION__);

        // return cached content
        if (!config()->debug && $opt['renderFonts'] == false) {
            $output = cache()->get($caheName);
            if ($output) {
                return $output;
            }
        }

        // Find font files in the specified path.
        $findFonts = files()->find(paths()->templates . $opt['fontsPath'],['excludeExtensions' => ['zip']]);

        // Initialize variables to store generated CSS code, preloader links, and JavaScript script.
        $fontFace = '';
        $linkPreload = '';
        $renderFonts = '';
        $delBtn = '';
        $fontVar = [];
        $load = false;

        $strDeleteFont = $this->t['deleteFont'];
        $strDeleteFontConfirm = $this->t['deleteFontConfirm'];
        $strFontFamily = $this->t['fontFamily'];
        $strFontVariable = $this->t['fontVariable'];
        $strUsage = $this->t['usage'];


        if(!$findFonts) return '';

        // Iterate through the found font files.
        foreach ($findFonts as $font) {
            // Get the font variables.
            $delFileName = pathinfo($font, PATHINFO_BASENAME);
            $name = strstr($font, '-v', true);
            $name = pathinfo($name, PATHINFO_FILENAME);
            $varName = $name;
            $name = str_replace('-', " ", $name);
            $name = ucwords($name);
            $type = pathinfo($font, PATHINFO_EXTENSION);
            $path = urls()->templates . $opt['fontsPath'] . pathinfo($font, PATHINFO_BASENAME);

            // Use match to determine the font weight based on the file name.
            $fontWeight = match (true) {
                str_contains($font, '-100.') => '100',
                str_contains($font, '-200.') => '200',
                str_contains($font, '-300.') => '300',
                str_contains($font, '-400.') => '400',
                str_contains($font, '-500.') => '500',
                str_contains($font, '-600.') => '600',
                str_contains($font, '-700.') => '700',
                str_contains($font, '-800.') => '800',
                str_contains($font, '-900.') => '900',
                str_contains($font, '-bold.') => '700',
                str_contains($font, '-regular.') => 'normal',
                str_contains($font, '-light.') => '300',
                str_contains($font, '-medium.') => '500',
                str_contains($font, '-semibold.') => '600',
                str_contains($font, '-heavy.') => '900',
                default => 'normal', // Default to 'normal' if no match
            };

            if( $opt['renderFonts'] ) {

                if( $opt['canDeleted']) {
                    $delBtn = 
                    <<<HTML
                        <button
                            hx-trigger="click"
                            hx-get="$opt[deletedUrl]$delFileName"
                            hx-target="#font-$varName"
                            hx-swap="outerHTML"
                            hx-confirm="$strDeleteFontConfirm"
                            class='uk-button uk-button-danger uk-margin'
                        >
                            $strDeleteFont
                        </button>
                    HTML;
                }

                $previewFont = $this->preview("var(--font-$varName)");
                $renderFonts .= <<<HTML
                <div id='font-$varName' class='uk-card uk-card-default uk-card-body uk-margin-bottom'>
                    <h1 style='font-family: var(--font-$varName); font-weight: $fontWeight; margin: 0'>{$name}</h1>
                    <ul style='font-family: Verdana, Arial, sans-serif;'>
                        <li>{$strFontFamily}: <code>{$name}</code></li>
                        <li>{$strFontVariable}: <code>--font-{$varName}</code></li>
                        <li>{$strUsage}: <code>p {
                            font-family: var(--font-{$varName});
                            font-weight: $fontWeight;
                        }</code></li>
                    </ul>
                    {$previewFont}
                    {$delBtn}
                </div>
                HTML;
            }

            // Check if the font name is listed in the provided array.
            if ($opt['loadAll'] == true || (in_array($name, $fontNames) || in_array($varName, $fontNames))) {

                $load = true;

                // Generate CSS code for the current font.
                $fontVar[] = "--font-{$varName}: '$name'";

                $fontFace .= <<<HTML
                    /* $name */
                    @font-face {
                        font-family: '$name';
                        font-display: swap;
                        src: url('$path') format('$type');
                        font-weight: $fontWeight;
                    }\n
                HTML;

                $linkPreload .= <<<HTML
                    <link
                        rel='preload'
                        href='$path'
                        crossorigin='anonymous'
                        as='font'
                        type='font/{$type}'
                    >\n
                HTML;
            }
        }

        $fontVar = implode(";\n",array_unique($fontVar));

        // Generate CSS code for font variables and font definitions.
        $styleFonts = Html::styleTag(<<<CSS
            :where(html) {
                $fontVar
            }
            $fontFace
        CSS);
        $styleFonts = $load == true ? $styleFonts : '';

        // only for admin area
        if( $opt['renderFonts'] ) {
            return $renderFonts;
        }

        // Return the complete HTML code.
        $content = "<!-- Fonts -->\n{$linkPreload} \n {$styleFonts}";

        // if debug remove old cache
        if(config()->debug && cache()->get($caheName)) {
            cache()->delete($caheName);
        }

        // set cached content
        if(!config()->debug) {
            cache()->save($caheName, $content, $opt['cacheTime']);
        }

        // return content
        return $content;
    }

    /**
     * Generates a font preview based on the provided font family and options.
     *
     * @param string $family The font family to be applied to the preview.
     * @param array $opt Configuration options for the font preview.
     *   - 'checkLetters': Set of characters to check in the heading.
     *   - 'loremIpsum': Lorem Ipsum text to display in the paragraph.
     *
     * @return string HTML containing a heading and paragraph with the generated text, styled with the specified font family.
     */
    public function preview($family = '', $opt = array()) {

        if(!$family) return '';

        $strTest = $this->t['test'];

        // Default configuration options.
        $defaults = [
            'checkLetters' => "
                a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z,<br>
                A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z'",

            'loremIpsum' => "
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy tex't ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        ];

        // Merge default options with the provided options.
        $opt = array_merge($defaults, $opt);

    $testWords =
        <<<HTML
            <div x-data="{ message: '' }">
                <label class='uk-label'>$strTest</label><br>
                <input class='uk-input uk-form-width-large' type="text" x-model="message">
                <p x-text="message" style='font-family: $family;'></p>
            </div>
        HTML;

    return
        <<<HTML
            <h3 style='font-family: $family;'>$opt[checkLetters]</h3>
            <p style='font-family: $family;'>$opt[loremIpsum]</p>
            {$testWords}
        HTML;
    }
}
