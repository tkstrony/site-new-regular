<?php namespace ProcessWire;

/**
 *
 * Lightweight and simple carousel with no dependencies
 * @link https://splidejs.com/
 *
 * ```php
<?php
    // load splide
    $splide = _splide();

    // set items
    $splide->item(Html::p('Slide - 1'));
    $splide->item(Html::p('Slide - 2'));
    $splide->item(Html::p('Slide - 3'));
    $splide->item(Html::p('Slide - 4'));

    // init first slider ( .first-slider )
    echo $splide->render('.first-slider',[
        'perPage' => 4,
        'autoplay' => true,
    ]) . '<br>';

    // set next items
    $splide->item(Html::p('Slide - 5'));
    $splide->item(Html::p('Slide - 6'));
    $splide->item(Html::p('Slide - 7'));
    $splide->item(Html::p('Slide - 8'));
    $splide->item(Html::p('Slide - 9'));
    $splide->item(Html::p('Slide - 10'));
    $splide->item(Html::p('Slide - 11'));
    $splide->item(Html::p('Slide - 12'));
    // init next slider ( .next-slider )
    echo $splide->render('.next-slider',[
        'perPage' => 3
    ]) . '<br>';
?>
 * ```
 */
class Splide {

    /**
     * Splide CDN library url
     * @var string
     */
    private string $splideCDN = 'https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/';

    /**
     * Base splide css file name
     * @var string
     */
    private string $splideCSS = 'splide.min.css';

    /**
     * Base splide script file name
     * @var string
     */
    private string $splideJS = 'splide.min.js';

    /**
     * assets path folder name
     * @var string
     */
    private string $assetsPath = 'assets/splide/';

    /**
     * set list items
     * @var array
     */
    private $items = [];

    public function __construct() {

        // set assets path
        $this->assetsPath = urls()->templates . $this->assetsPath;

        // set splide js
        $this->splideJS = $this->assetsPath . $this->splideJS;
        if(!files()->exists($this->splideJS)) {
            $this->splideJS = $this->splideCDN . 'js/' . str_replace($this->assetsPath, '', $this->splideJS);
        }

        // set splide css
        $this->splideCSS = $this->assetsPath . $this->splideCSS;
        if(!files()->exists($this->splideCSS)) {
            $this->splideCSS = $this->splideCDN . 'css/' . str_replace($this->assetsPath, '', $this->splideCSS);
        }
    }

    /**
     * render default splide content
     * @param string $items items content
     * @param string $querySelector
     * @param array $opt
     */
    public function render($querySelector = '.first-slider', $opt = []) {

        if(!is_array($this->items)) return '';

        // set items
        $listItems = '';
        foreach ($this->items as $item) {
            $listItems .= "<li class='splide__slide'>$item</li>";
        }

        $default = [
            'showNav' => true,
        ];
        $opt = array_merge($default, $opt);

        $assets = $this->globalAssets();
        $load = $this->load($querySelector, $opt);
        $querySelector = str_replace('.','',$querySelector);
        $querySelector = str_replace('#','',$querySelector);

        $content =
        <<<HTML
            <div id='$querySelector' class="splide {$querySelector}">
                <div class="splide__track">
                    <ul class="splide__list">
                        {$listItems}
                    </ul>
                </div>
            </div>
        HTML;

        return $assets . $content . $load . $this->clean();
    }

    /**
     * clean up items
     */
    public function clean() {
        return $this->items = null;
    }

    /**
     * set item
     */
    public function item($content = '') {
        if(!$content) return '';
        $this->items[] = $content;
    }

    /**
     * load splide
     * @param string $querySelector
     * @param array $opt
     */
    public function load($querySelector = '', $opt = []) {

        $default = [
            'type' => 'loop',
            'autoplay' => false,
            'pauseOnHover' => true,
            'pauseOnFocus' => true,
            'perPage' => 4,
            'pagination' => true,
            'autoWidth' => false,
            'break_1200' => 3,
            'break_900' => 2,
            'break_768' => 2,
            'break_600' => 1,
        ];
        $opt = array_merge($default, $opt);

        // set autoplay
        $pauseOnHover = var_export($opt['pauseOnHover'], true);
        $pauseOnFocus = var_export($opt['pauseOnFocus'], true);
        $autoPlay = var_export($opt['autoplay'], true);
        $pagination = var_export($opt['pagination'], true);
        $autoWidth = var_export($opt['autoWidth'], true);

        // set custom var name
        $varName  = str_replace('.','',$querySelector);
        $varName  = str_replace('#','',$varName);
        $varName  = str_replace('_','',$varName);
        $varName  = str_replace('-','',$varName);

        $script = <<<JS
            document.addEventListener( 'DOMContentLoaded', function() {
                var {$varName} = new Splide( '{$querySelector}',{
                    type   : '$opt[type]',
                    perPage: $opt[perPage],
                    autoplay: {$autoPlay},
                    pauseOnHover: {$pauseOnHover},
                    pauseOnFocus: {$pauseOnFocus},
                    pagination: {$pagination},
                    autoWidth: {$autoWidth},
                    breakpoints: {
                        1200: {
                            perPage: $opt[break_1200],
                        },
                        900: {
                            perPage: $opt[break_900],
                        },
                        768: {
                            perPage: $opt[break_768],
                        },
                        600: {
                            perPage: $opt[break_600],
                        },
                    },
                }).mount();
            } );
        JS;

        // $style = <<<CSS
        //     .{$querySelector} {}
        // CSS;

        // load modules / scripts
        return _globalRegion(_baseName(__CLASS__) . '_' . $varName, Html::scriptTag($script, ['type' => 'module']));
    }

    /**
     * return Splide global assets ( load only once ) 
     */
    public function globalAssets() {

        // set global style for splide
        // $style = <<<CSS
        //     .splide__slide {
        //         margin: 0;
        //         padding: 0;
        //     }

        //     .splide__pagination {
        //         position: relative;
        //         bottom: 0;
        //     }

        //     .splide__arrow {
        //         top: 30vh;
        //     }
        // CSS;

        // // https://github.com/Splidejs/splide/issues/227
        // if(_isMobile()) {
        //     $style .= <<<CSS
        //         .splide {
        //             .splide__track {
        //                 .splide__list {
        //                     align-items: flex-start !important;
        //                 }
        //             }
        //         }
        //         .splide__slide:not(.is-active) {
        //             height: 0 !important;
        //         }
        //     CSS;
        // }

        // load - base css / js
        return _globalRegion(_baseName(__CLASS__) . '_global', Html::linkStylesheetTag($this->splideCSS) . Html::scriptSrcTag($this->splideJS));
    }
}
