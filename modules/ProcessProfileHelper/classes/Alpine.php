<?php namespace ProcessWire;

/**
 * Alpine.js helpers for creating UI components with Alpine.js framework.
 *
 * This class provides utility methods to create interactive UI elements using the Alpine.js framework.
 * Methods include generating lightbox modals and alerts with customizable content and styles.
 */
class Alpine {

    /**
     * Alpine's Collapse plugin allows you to expand and collapse elements using smooth animations.
     * @param string $content
     * @param string $btnLabel
     * @link https://alpinejs.dev/plugins/collapse
     */
    public function collapse($content = '', $btnLabel = '', $opt = array()) {

        if(!$content) return '';

        // set default options
        $def = [
            'expanded' => false,
            'fullWidth' => false,
            'maxWidth' => '', // 3xs 2xs xs md sm xl
            'class' => '',
        ];
        // merdge options with default settings
        $opt = array_merge($def, $opt);

        if(!$btnLabel) {
            $btnLabel = _t('seeMore');
        }

        // set icon
        $icon = function($icon, $opt = array()) {
            return _icon($icon, $opt);
        };

        // css class
        $class = _baseName(__CLASS__) . '_' . __FUNCTION__;
        $class = $opt['class'] ? $class . ' ' . $opt['class'] : $class;

        // expanded
        $expanded = $opt['expanded'] ? 'true' : 'false';

        // set button style
        $fullWidth = $opt['fullWidth'] ? "width: 100%; justify-content: space-between;" : '';
        $maxWidth = $opt['maxWidth'] ? "max-width: var(--mw-{$opt['maxWidth']});" : '';
        $style = $fullWidth || $maxWidth ? " style='{$fullWidth}{$maxWidth}'" : '';

        $content =
        <<<HTML
            <div class='{$class}' x-data="{ expanded: {$expanded} }">
                <button class='-icon' @click="expanded = ! expanded"{$style}>
                    $btnLabel
                    <span x-show="expanded">{$icon('minus',['size' => '2xs'])}</span>
                    <span x-show="!expanded">{$icon('plus', ['size' => '2xs'])}</span>
                </button>

                <div x-show="expanded" x-collapse.duration.500ms>
                    {$content}
                </div>
            </div>
        HTML;

        return $content;
    }

    /**
     * Generates a lightbox component using Alpine.js.
     *
     * This method creates a lightbox/modal component that can be triggered by a specified HTML element.
     * The lightbox is controlled using Alpine.js directives for smooth transitions and visibility control.
     *
     * @param string $label The label text for the lightbox trigger element.
     * @param string $content The HTML content to display inside the lightbox.
     * @param string $el The HTML element used as the lightbox trigger (default is 'button').
     * @param array $attr Additional attributes to add to the trigger element.
     *
     * @return string The HTML markup for the lightbox component.
     */
    public function lightbox($label, $content, $attr = [], $el = '') {

        if(!$el) $el = 'button';
        $class = strtolower(_baseName(__CLASS__) . '_'. _baseName(__FUNCTION__));
        $openedClass = 'lightbox-open';

        // set element
        $defAttr = [
            "@click" => "open = true; document.body.classList.add('$openedClass')",
        ];
        $attr = array_merge($defAttr, $attr);
        $el = Html::el($el,$label,$attr);

        $iconX = _icon('x');
        $zx = time();

        $content =
        <<<HTML
            <div class='{$class}' x-data="{ open: false }">
                {$el}
                <div class='{$class} overlay dn' x-show="open" x-transition>
                    <div class='{$class}-content'
                        @click.outside="document.body.classList.remove('$openedClass'); open = false;"
                        @keydown.window.escape="document.body.classList.remove('$openedClass'); open = false;"
                    >
                        <button class='close -icon'
                            @click="document.body.classList.remove('$openedClass'); open = false;"
                        >$iconX</button>
                        $content
                    </div>
                </div>
            </div>
        HTML;

        $css = <<<CSS
            body.lightbox-open {
                overflow: hidden;
            }
            .lightbox-open .{$class}.overlay {
                background: color-mix(in srgb, var(--bg-color), transparent 8%);
                display: grid;
                justify-items: center;
                align-items: center;
                gap: var(--sp-xs);
                padding: var(--sp-4xl) var(--sp-md);
                box-sizing: border-box;
                overflow: auto;
                z-index: {$zx};
                .close {
                    position: fixed;
                    top: 0;
                    right: var(--sp-xl);
                    z-index: $zx;

                    /* desktops */
                    @media (min-width: 64rem) {
                        top: var(--sp-5xl);
                        right: var(--sp-7xl);
                        /* position: relative; */
                    }
                }
            }

            .{$class}-content {
                display: grid;
                justify-items: center;
                align-items: center;
                gap: var(--sp-2xl);
                max-width: var(--mw-lg);
                img {
                    max-width: var(--mw-md);
                }
            }
        CSS;
        $css = _globalRegion('Alpine_lightbox', Html::styleTag($css));

        // return item
        return $css . $content;
    }

    /**
     * Generates an alert component using Alpine.js.
     *
     * This method creates an alert component that can be displayed in different styles (success, warning, error, etc.).
     * The alert can be dismissed by clicking an icon. Custom options allow control over the alert's appearance and behavior.
     *
     * @param string $content The content/message to display inside the alert.
     * @param string $type The type of alert, which determines the styling (default is 'success'). Options: success, warning, error, primary, secondary, accent.
     * @param array $opt Additional options for customizing the alert. Supported options:
     *   - 'htmlElement' (string): The HTML element to use for the alert container (default is 'p').
     *   - 'position' (string): The CSS position property for the alert ('fixed' or 'relative', default is 'fixed').
     *   - 'zIndex' (int): The CSS z-index property for the alert (default is 1999).
     *
     * @return string The HTML markup for the alert component.
     */
    public function alert($content, $type='success', $opt = array()) {

        // default options
        $def = [
            'htmlElement' => 'p',
            'position' => 'relative', // fixed, relative
            'margin' => '',
            'maxWidth' => '',
            'zIndex' => 999,
            'hideOnClickOutside' => false,
            'autoHide' => false,
            'autoHideTime' => 4000, // 4000ms
        ];
        $opt = array_merge($def, $opt);

        // alert id
        $id = 'Alpine_alert-' . rand();

        // default HTML element
        $el = $opt['htmlElement'];

        // element class
        $elClass = "{$id}_content";

        // close icon
        $icon = _icon('x');

        // margin
        $margin = $opt['margin'] ? "margin: $opt[margin];\n" : '';

        // max width
        $maxWidth = $opt['maxWidth'] ? "max-width: $opt[maxWidth];\n" : '';

        // click outside
        $clickOutside = <<<HTML
            @click.outside="\$root.classList.add('fade-out'); setTimeout(() => \$root.remove(), 1000);"
        HTML;
        if($opt['hideOnClickOutside'] == false) {
            $clickOutside = '';
        }

        $btn = <<<HTML
            <br>
            <button
                class='alertRemove -icon'
                @click="\$root.classList.add('fade-out'); setTimeout(() => \$root.remove(), 1000);"
                {$clickOutside}
            >
                {$icon}
            </button>
        HTML;

        $autoHide = '';
        if($opt['autoHide']) {
            $btn = '';
            $autoHide = "setTimeout(() => { \$el.classList.add('fade-out'); setTimeout(() => \$el.remove(), 500); }, $opt[autoHideTime]);";
        }

        $top = '';
        if($opt['position'] == 'fixed') {
            $top = 'top: 0; left: 0;';
        }

        // return content
        return
        <<<HTML
            <div
                id='{$id}'
                class='Alpine_alert'
                x-init="{$autoHide}"
                x-data=""
            >
                <{$el} class='{$elClass} alert -{$type} fade-in'>
                    {$content}
                    {$btn}
                </{$el}>

                <style>
                    #{$id} {
                        position: $opt[position];
                        {$top}
                        z-index: {$opt['zIndex']};
                        {$el}.{$elClass} {
                            {$margin}
                            {$maxWidth}
                            a {
                                color: var(--color-white);
                                background: var(--color-cerulean);
                                padding: var(--sp-3xs);
                                &:hover {
                                    background: var(--color-white);
                                    color: var(--color-cerulean);
                                }
                            }
                            button {
                                outline: none;
                                color: var(--color-black) !important;
                            }
                        }
                    }
                </style>
            </div>
        HTML;
    }

    /**
     * Return copy to clipboard
     * @param string $content
     * @param array $opt 
     * @return string
     */
    public function copyToClipboard($content, $opt = []) {
        $defOpt = [
            'copiedText' => _t('copied') ?: __('Copied'),
            'tooltipText' => _t('copyToClipboard') ?: __('Copy to Clipboard'),
            'class' => 'copy-to-clipboard',
            'icon' => 'copy'
        ];
        $opt = array_merge($defOpt, $opt);

        $icon = _icon($opt['icon'],['size' => 'sm']);
        $safeContent = json_encode($content, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

        return <<<HTML
            <div class='copy-clipboard' x-data='{ "input": $safeContent, "open": false }'>
                <button
                    x-clipboard="input"
                    class="tooltip-button -bg-none -xs {$opt['class']}"
                    data-tooltip="{$opt['tooltipText']}"
                    @click="open = true; setTimeout(() => open = false, 2000)"
                >
                    <small class='text-xs'>{$icon}
                        <span class='lead' x-show="open" x-transition.opacity>{$opt['copiedText']}</span>
                    </small>
                </button>
            </div>
        HTML;
    }

}
