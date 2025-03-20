<?php namespace ProcessWire;

/**
 * Photoswipe
 * @link https://photoswipe.com/getting-started/
 *
 * Usage:
 * ```php
    <?php 
        $ps = _photoswipe();
        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-200.jpg',
        [
            'data-width' => "1669",
            'data-height' => "2500",
        ]);

        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-200.jpg',
            [
                'data-width' => "1875",
                'data-height' => "2500",
            ]);
        echo $ps->render('#gallery',[
            'customStyle' => <<<CSS
                {
                    display: flex;
                    flex: wrap;
                    gap: var(--sp-sm);
                }
            CSS
        ]);

        $ps = _photoswipe();
        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-200.jpg',
        [
            'data-width' => "3500",
            'data-height' => "2500",
        ]);

        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/4/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/4/img-200.jpg',
            [
            'data-width' => "1875",
            'data-height' => "2500",
            ]);
        echo $ps->render('#gallery_next',[
            'customStyle' => <<<CSS
                {
                    display: flex;
                    flex: wrap;
                    gap: var(--sp-sm);
                }
            CSS
        ]);
    ?>
 * ```
 */
class Photoswipe {

    /**
     * Photoswipe CDN library url
     * @var string
     */
    private string $photoswipeCDN = 'https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.4/';

    /**
     * Base photoswipe script file name
     * @var string
     */
    private string $photoswipeJS = 'photoswipe.esm.min.js';

    /**
     * Base script file name for the photoswipe lightbox
     * @var string
     */
    private string $photoswipeLightboxJS = 'photoswipe-lightbox.esm.min.js';

    /**
     * Base photoswipe style file name
     * @var string
     */
    private string $photoswipeCSS = 'photoswipe.min.css';

    /**
     * Photoswipe Assets path folder name
     * @var string
     */
    private string $assetsPath = 'assets'.DIRECTORY_SEPARATOR.'photoswipe'.DIRECTORY_SEPARATOR;

    /**
     * set list items
     * @var array
     */
    private $items = [];

    public function __construct() {

        // set assets path
        $this->assetsPath = urls()->templates . $this->assetsPath;

        $this->photoswipeCSS = $this->assetsPath . $this->photoswipeCSS;
        if(!files()->exists($this->photoswipeCSS)) {
            $this->photoswipeCSS = $this->photoswipeCDN . str_replace($this->assetsPath, '', $this->photoswipeCSS);
        }

        $this->photoswipeJS = $this->assetsPath . $this->photoswipeJS;
        if(!files()->exists($this->photoswipeJS)) {
            $this->photoswipeJS = $this->photoswipeCDN . str_replace($this->assetsPath, '', $this->photoswipeJS);
        }

        $this->photoswipeLightboxJS = $this->assetsPath . $this->photoswipeLightboxJS;
        if(!files()->exists($this->photoswipeLightboxJS)) {
            $this->photoswipeLightboxJS = $this->photoswipeCDN . str_replace($this->assetsPath, '', $this->photoswipeLightboxJS);
        }
    }

    /**
     * render default content
     * @param string $galleryID
     * @param array $opt
     */
    public function render($galleryID = '#my-gallery', $opt = []) {

        $defaults = [
            'childrenElement' => 'a',
            'column' => 'single',
            'customStyle' => false,
        ];
        $opt = array_merge($defaults, $opt);

        $col = match ($opt['column']) {
            'single' => '-single-column',
            default => '-single-column'
        };

        $script = <<<JS
            import PhotoSwipeLightbox from '{$this->photoswipeLightboxJS}';
            const lightbox = new PhotoSwipeLightbox({
                gallery: '{$galleryID}',
                children: '{$opt['childrenElement']}',
                pswpModule: () => import('{$this->photoswipeJS}'),
                bgOpacity: 0.8,
            });
            lightbox.init();
        JS;

        $galleryID = str_replace('.','',$galleryID);
        $galleryID = str_replace('#','',$galleryID);

        // set items
        $listItems = '';
        foreach ($this->items as $item) {
            $listItems .= $item;
        }

        $content =
            <<<HTML
                <!-- PhotoSwipe / {$galleryID} -->
                <div class="pswp-gallery pswp-gallery-{$col}" id="{$galleryID}">
                    {$listItems}
                </div><!-- PhotoSwipe END/ {$galleryID} -->
            HTML;

        $customStyle = '';
        if($opt['customStyle']) {
            $customStyle = Html::styleTag(
            <<<CSS
                #{$galleryID} 
                {$opt['customStyle']} 
            CSS) . "\n";
        }

        $globalRegion = _globalRegion(_baseName(__CLASS__) . '_' . sanitizer()->pageName($galleryID), $customStyle . Html::scriptTag($script, ['type' => 'module']));

        return  $content . $globalRegion . $this->globalStyle() . $this->clean();
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
    public function item($imgUrl = '', $thumbUrl = '', $opt = []) {

        if(!$imgUrl) return '';

        // set defaults
        $defaults = [
            'htmlElement' => 'a',
            'data-width' => "1280",
            'data-height' => "960",
            'thumb-width' => "640",
            'thumb-height' => "420",
            'target' => '_blank',
            'thumb' => true,
            'lozad' => true,
            'fitCover' => true,
        ];
        $opt = array_merge($defaults, $opt);

        // set thumb if
        $thumbUrl = $thumbUrl ?: $imgUrl; 

        $thumb = '';
        if($opt['thumb'] && $thumbUrl) {
            $thumb = ' ' . 
            Html::img($thumbUrl,[
                'alt' => '',
                'class' => 'responsive scrool-animation',
                'lozad' => $opt['lozad'],
                'fitCover' => $opt['fitCover'],
                'width' => $opt['thumb-width'],
                'height' => $opt['thumb-height'],
            ]);
        }

        $item = "<{$opt['htmlElement']} href='$imgUrl'";
        $item .= " data-pswp-width=\"{$opt['data-width']}\"";
        $item .= " data-pswp-height=\"{$opt['data-height']}\"";
        $item .= " target=\"{$opt['target']}\">";
        $item .= $thumb;
        $item .= "</{$opt['htmlElement']}>";

        $this->items[] = $item;
    }

    /**
     * return global css style
     */
    public function globalStyle() {
        // load base styles
        $globalStyle = 
        <<<CSS
            .pswp section {
                margin: 0;
            }
            .pswp__button {
                outline: none !important;
            }
            .pswp__button--arrow {
                width: 40px;
                height: 60px;
            }
        CSS;

        // load global css
        return _globalRegion(_baseName(__CLASS__), Html::linkStylesheetTag($this->photoswipeCSS) . "\n" .Html::styleTag($globalStyle));
    }
}
