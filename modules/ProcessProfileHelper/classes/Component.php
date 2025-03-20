<?php namespace ProcessWire;

/**
 * render component
 */
class Component {

    public function __construct(
        public string $basename = '',
    ) {
        $parts = explode('\\', __CLASS__);
        $this->basename = lcfirst(end($parts));
    }

    /**
     * Render a component.
     *
     * @param string $name - The name of the component.
     * @param array $componentVariables - Associative array of custom variables or base ptions to modify behavior:
     *   - 'baseName' (string): The base name for the component, typically derived from the function name. This option is crucial as it forms the basis for other component names and paths. Only change this if you need to change the component's base folder or function name.
     *   - 'componentFolderName' (string): The name of the folder containing the component.
     *   - 'filePath' (string): The file path of the component.
     *   - 'name' (string): The name of the component.
     *   - 'itemClassName' (string): CSS class name for the component.
     *   - 'id' (string): The ID attribute for the component.
     *   - 'class' (string): Additional CSS classes for the component.
     *   - 'content' (string): The content of the component.
     *   - 'generate' (bool): Whether to auto-generate the component if it does not exist.
     *   - 'showID' (int): Show the component only if this ID is not equal to the current page ID.
     *   - 'hideID' (int): Hide the component if this ID is equal to the current page ID.
     *   - 'cacheTime' (int): Enables caching and sets the cache duration (in seconds).
     *   - 'cspNonce' (string): Content-Security-Policy nonce, retrieved from the session.
     * @param array $opt - Render options, see WireFileTools::render().
     * @return string - The rendered component HTML.
     *
     * Example usage:
     * echo _component('_myComponent', [
     *   'cacheTime' => 600,
     *   'id' => 'customId',
     *   'class' => 'custom-class'
     * ]);
     */
    public function render($name, array $componentVariables = [], $opt = []) {

        // Hide the component if requested (e.g., setting('_customComponentName','remove'))
        if (setting($name) == 'remove') return '';

        // Set cache name based on device type (mobile or desktop)
        $cacheName = _isMobile() ? $name . '-mobile' : $name . '-desktop';

        // Get cached value
        $cachedValue = cache()->get($cacheName);

        // Return cached value if caching is enabled and not in debug mode
        if (isset($componentVariables['cacheTime']) && config()->debug == false && $cachedValue) {
            return $cachedValue;
        }

        // Delete cache in debug mode to force fresh content
        if (config()->debug === true && $cachedValue) {
            cache()->delete($cacheName);
        }

        // Set baseName, default to the function name if not provided.
        $componentVariables['baseName'] = $componentVariables['baseName'] ?? $this->basename;

        // Generate a unique item class name
        $itemClassName = $componentVariables['baseName'] . $name;

        // set componentfie Path
        config()->setPath('componentfilePath', paths()->templates . $componentVariables['baseName'] . 's/'."{$name}.php");

        // Default options
        $defaultOptions = [
            'componentFolderName' => $componentVariables['baseName'] . 's',
            'filePath' => rtrim(paths()->componentfilePath, '/'),
            'type' => ucfirst($componentVariables['baseName']),
            'name' => _baseName($name),
            'itemClassName' => $itemClassName,
            'id' => '',
            'class' => '',
            'content' => '',
            'generate' => config()->debug,
            'showID' => null,
            'hideID' => null,
            'cspNonce' => session()->get('cspNonce') ?: '',
        ];

        // Merge component options with default options
        $componentVariables = array_merge($defaultOptions, $componentVariables);

        // If the component name contains a '/', replace it with '_' in the item class name
        if(str_contains($name, '/')) {
            $componentVariables['itemClassName'] = $componentVariables['baseName'] . '_' . str_replace('/', '_', $name);
            if(str_contains($componentVariables['itemClassName'], '__')) {
                $componentVariables['itemClassName'] = str_replace('__','_',$componentVariables['itemClassName']);
            }
        }

        // Set id
        $componentVariables['id'] = $componentVariables['id'] ?: $componentVariables['itemClassName'];

        // Set CSS class
        $componentVariables['class'] = $componentVariables['itemClassName'] . ($componentVariables['class'] ? " {$componentVariables['class']}" : '');

        // Show/hide the component based on specified IDs
        if ($componentVariables['showID'] && $componentVariables['showID'] != page()->id) return '';
        if ($componentVariables['hideID'] && $componentVariables['hideID'] == page()->id) return '';

        // Create HTML comments for the component
        $htmlComments = "<!-- \\ " . $componentVariables['baseName']. ' ' .$componentVariables['name'] . " \-->\n";

        // Generate a custom component if it doesn't exist and auto-generation is enabled
        if (!file_exists($componentVariables['filePath']) && $componentVariables['generate']) {
            return $this->generateComponent($name, $componentVariables);
        }

        // if debug == false not show empty component in production mode
        if (!file_exists($componentVariables['filePath']) && !$componentVariables['generate']) return '';

        // Render the component content
        $renderedItem = files()->render($componentVariables['filePath'], $componentVariables, $opt);

        // Check if the rendered item is null and return an empty string if so
        if ($renderedItem == '') return '';

        // set content
        $renderedContent = "$htmlComments $renderedItem\n";

        // save cache
        if(isset($componentVariables['cacheTime']) && config()->debug == false) {
            cache()->save($cacheName, $renderedContent, $componentVariables['cacheTime']);
        }

        // Return the component content with comments, before, and after
        return $renderedContent;
    }

    /**
     * Render a partial.
     *
     * @param string $name - The name of the partial component.
     * @param array $partialVariables - Associative array of variables for rendering the partial:
     *   - 'baseName' (string): Partial folder name ('partials' by default).
     * @param array $opt - Render options, see WireFileTools::render().
     * @return string - The rendered partial component HTML.
     *
     * Example usage:
     * echo _partial('_myPartial', [
     *   'cacheTime' => 600,
     *   'id' => 'customId',
     *   'class' => 'custom-class'
     * ]);
     */
    public function partial($name, $partialVariables = array(), $opt = array()) {

        if (!$name) return '';

        $customPath = false;

        $customOptions = [
            'baseName' => _baseName(__FUNCTION__),
        ];
        // Merge all with default Options
        $partialVariables = array_merge($customOptions, $partialVariables);

        // SET CSS partial
        if(str_contains($name,'-JS') && !str_contains($name,'/')) {
            $partialPath = paths()->templates . $partialVariables['baseName'] . 's'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR."{$name}.php";
            $customPath = true;
        }

        // SET JS partial
        if(str_contains($name,'-CSS') && !str_contains($name,'/')) {
            $partialPath = paths()->templates . $partialVariables['baseName'] . 's'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR."{$name}.php";
            $customPath = true;
        }

        if($customPath == true) {
            $partialVariables['filePath'] = $partialPath;
        }

        // Render the partial.
        return $this->render($name, $partialVariables, $opt);
    }

    /**
     * render custom blocks
     */
    public function block($name, $blockOptions = array(), $opt = array()) {
        $customOptions = [
            'baseName' => _baseName(__FUNCTION__),
        ];
        // Merge all with default Options
        $blockOptions = array_merge($customOptions, $blockOptions);

        // return block
        return $this->partial($name, $blockOptions, $opt);
    }

    /**
     * Generate a custom component file and redirect to the current page.
     *
     * @param string $name - The name of the component.
     * @param array $componentOptions - Associative array of options for generating the component:
     *   - 'componentFolderName' (string): Component folder name.
     *   - 'filePath' (string): Component file path.
     *   - 'name' (string): Component name.
     * @return string|Session::___redirect - The path to the generated component file or a redirect to the current page after generating the component.
     */
    private function generateComponent($name, $componentOptions = array()) {

        // get the generator type
        $generator = '_' . lcfirst($componentOptions['type']);


        $content = $this->defaultContent();

        // SET CSS partial
        if(str_contains($name,'-JS') && $generator == '_partial') {
            $content = $this->scriptContent();
        }

        // SET JS partial
        if(str_contains($name,'-CSS') && $generator == '_partial') {
            $content = $this->styleContent();
        }

        // Replace placeholder with the component name.
        $content = str_replace(
            [
                'setItemName',
            ],
            [
                "$componentOptions[name]",
            ],
            $content
        );

        // create directory
        $dir = files()->mkdir(dirname($componentOptions['filePath']),true);

        if(!$dir) return 'Problem with generate component Content';

        // Generate the component file.
        if(files()->filePutContents($componentOptions['filePath'], $content)) {
            // Redirect back to the current page.
            return session()->redirect(page()->url);
        }
    }

    /**
     * Content scripts
     */
    private function scriptContent() {
        return
        <<<"TEXT"
        <?php namespace ProcessWire;

            /**
             * Name setItemName
             * @var string \$name
             * @var string \$content
             *
             */

            // content
            \$content = <<<JS
                alert('Generate - \$name');
            JS;

            return Html::scriptTag(\$content);
        TEXT;
    }

    /**
     * Content styles
     */
    private function styleContent() {
        return
        <<<"TEXT"
        <?php namespace ProcessWire;

            /**
             * Name setItemName
             * @var string \$content
             *
             */

            // content
            \$content = <<<CSS
                body {
                    background: red;
                    color: white;
                }
            CSS;

            return Html::styleTag(\$content);
        TEXT;
    }

    /**
     * default content
     */
    private function defaultContent() {
        return <<<"TEXT"
        <?php namespace ProcessWire;

        /**
        * Name setItemName
        * @var string \$html
        * @var string \$type
        * @var string \$name
        * @var string \$class
        * @var string \$itemClassName
        * @var string \$content
        * @var string \$filePath
        */

        // content
        \$html = <<<HTML
            <h3>{\$type} {\$name}</h3>

            {\$content}

            <p>{\$type} path -> <code>{\$filePath}</code></p>
            <p>{\$type} CSS Class Name -> <code>{\$itemClassName}</code></p>
        HTML;

        // CSS
        \$style = <<<CSS
            .{\$itemClassName} {
                font-family: var(--font-primary);
                background: var(--color-navy);
                color: var(--color-teal);
                padding: var(--sp-md);

                p {
                    color: var(--color-white);
                }

                h1,h2,h3 {
                    color: var(--color-orange);
                }

                code {
                    color: var(--color-purple);
                }
            }
        CSS;

        // JS
        \$script = <<<JS
            console.log('{\$itemClassName}');
        JS;

        // set region
        \$globalRegion = _globalRegion(\$itemClassName, Html::styleTag(\$style) . Html::scriptTag(\$script));
        return Html::div(\$globalRegion . \$html,['class' => \$class]);
        TEXT;
    }
}
