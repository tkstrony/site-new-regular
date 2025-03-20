<?php namespace ProcessWire;

/**
 * Class Reveal
 * This class handles the integration of the reveal.js library into a PHP project.
 * It allows the initialization of reveal.js with customizable options and includes
 * necessary stylesheets and scripts from a CDN.
 * ```php
    // put iframe => home.php
    <iframe data-src='reveal/' referrerpolicy='no-referrer-when-downgrade' sandbox='allow-same-origin allow-scripts' width='100%' height='600px' style='border:none;' class='lozad'></iframe>

    // Hook inside ready.php
    wire()->addHook('/reveal', function($event) {
        $html = <<<HTML
        <section>
            <div class="reveal">
                <div class="slides">
                    <section>Horizontal Slide</section>
                    <section>
                        <section>Vertical Slide 1</section>
                        <section>Vertical Slide 2</section>
                    </section>
                </div>
            </div>
        </section>
        HTML;
        $reveal = new Reveal();
        return $html . $reveal->init(['autoPlayMedia' => false, 'transition' => 'fade']);
    });
 * ```
 */
class Reveal
{
    /**
     * Base URL for the reveal.js library
     * @var string
     */
    private string $revealLibs = 'https://cdnjs.cloudflare.com/ajax/libs/reveal.js/5.1.0/';

    /**
     * Default configuration options for reveal.js
     * @var array
     * @link https://revealjs.com/config/
     */
    private array $defaultOptions = [
        // 'view' => 'scroll',
        // 'scrollProgress' => true,

        // The "normal" size of the presentation, aspect ratio will
        // be preserved when the presentation is scaled to fit different
        // resolutions. Can be specified using percentage units.
        // 'width' => 960,
        // 'height' => 700,

        // // Factor of the display size that should remain empty around
        // // the content
        // 'margin' => 0.04,

        // // Bounds for smallest/largest possible scale to apply to content
        // 'minScale' => 0.2,
        // 'maxScale' => 2.0,

        'controls' => true,
        'controlsTutorial' => true,
        'controlsLayout' => 'bottom-right',
        'controlsBackArrows' => 'faded',
        'progress' => true,
        'slideNumber' => false,
        'showSlideNumber' => 'all',
        'hashOneBasedIndex' => false,
        'hash' => false,
        'respondToHashChanges' => true,
        'jumpToSlide' => true,
        'history' => false,
        'keyboard' => true,
        'keyboardCondition' => null,
        'disableLayout' => false,
        'overview' => true,
        'center' => true,
        'touch' => true,
        'loop' => false,
        'rtl' => false,
        'navigationMode' => 'default',
        'shuffle' => false,
        'fragments' => true,
        'fragmentInURL' => true,
        'embedded' => false,
        'help' => true,
        'pause' => true,
        'showNotes' => false,
        'autoPlayMedia' => null,
        'preloadIframes' => null,
        'autoAnimate' => true,
        'autoAnimateMatcher' => null,
        'autoAnimateEasing' => 'ease',
        'autoAnimateDuration' => 1.0,
        'autoAnimateUnmatched' => true,
        'autoAnimateStyles' => [
            'opacity',
            'color',
            'background-color',
            'padding',
            'font-size',
            'line-height',
            'letter-spacing',
            'border-width',
            'border-color',
            'border-radius',
            'outline',
            'outline-offset',
        ],
        'autoSlide' => 0,
        'autoSlideStoppable' => true,
        'autoSlideMethod' => null,
        'defaultTiming' => null,
        'mouseWheel' => false,
        'previewLinks' => false,
        'postMessage' => true,
        'postMessageEvents' => false,
        'focusBodyOnPageVisibilityChange' => true,
        'transition' => 'slide',
        'transitionSpeed' => 'default',
        'backgroundTransition' => 'fade',
        'pdfMaxPagesPerSlide' => PHP_INT_MAX,
        'pdfSeparateFragments' => true,
        'pdfPageHeightOffset' => -1,
        'viewDistance' => 3,
        'mobileViewDistance' => 2,
        'display' => 'block',
        'hideInactiveCursor' => true,
        'hideCursorTime' => 5000,
    ];

    /**
     * Stylesheets required for reveal.js
     * @var array
     */
    private array $stylesheets = [
        'reset.min.css',
        'reveal.min.css',
        'theme/black.min.css',
        'plugin/highlight/monokai.min.css'
    ];

    /**
     * Scripts required for reveal.js
     * @var array
     */
    private array $scripts = [
        'reveal.min.js',
        'plugin/notes/notes.min.js',
        'plugin/markdown/markdown.min.js',
        'plugin/highlight/highlight.min.js'
    ];

    /**
     * Initializes the reveal.js presentation with custom options.
     *
     * @param array $customOptions Custom configuration options to override the defaults.
     * @return string
     */
    public function init(array $customOptions = []): string
    {
        $options = array_merge($this->defaultOptions, $customOptions);
        $optionsJs = json_encode($options, JSON_UNESCAPED_SLASHES);

        return
        $this->outputStylesheets() .
        $this->outputScripts() .
        $this->initializeReveal($optionsJs);
    }

    /**
     * Outputs the necessary stylesheet links for reveal.js.
     *
     * @return string
     */
    private function outputStylesheets(): string
    {
        $out = '';
        foreach ($this->stylesheets as $stylesheet) {
            $out .= Html::linkStylesheetTag($this->revealLibs . $stylesheet)."\n";
        }
        return $out;
    }

    /**
     * Outputs the necessary script tags for reveal.js.
     *
     * @return string
     */
    private function outputScripts(): string
    {
        $out = '';
        foreach ($this->scripts as $script) {
            $out .= Html::scriptSrcTag($this->revealLibs . $script)."\n";
        }
        return $out;
    }

    /**
     * Outputs the JavaScript code to initialize reveal.js with the specified options.
     *
     * @param string $optionsJs JSON-encoded options for reveal.js.
     * @return void
     */
    private function initializeReveal(string $optionsJs): string
    {
        return Html::scriptTag("Reveal.initialize($optionsJs);",['type' => 'module']);
    }
}
