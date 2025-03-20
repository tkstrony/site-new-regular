<?php namespace ProcessWire;

/**
 * Class Htmx
 * 
 * A utility class for generating HTML elements with HTMX attributes 
 * to enable dynamic content loading via AJAX.
 * 
 * @link https://github.com/bigskysoftware/htmx
 */
class Htmx {

    /**
     * Allowed HTTP methods for HTMX requests.
     * 
     * @var array<string>
     */
    private array $allowedMethods = ['get', 'post', 'put', 'delete'];

    /**
     * Constructor for Htmx class.
     *
     * @param array $attr Associative array of attributes for the HTML element.
     * @param string $requestMethod HTTP request method (GET, POST, PUT, DELETE).
     * 
     * @throws \InvalidArgumentException If an invalid request method is provided.
     */
    public function __construct(
        public array $attr = [],
        public string $requestMethod = 'get'
    ) {
        // Ensure requestMethod is valid
        if (!in_array(strtolower($this->requestMethod), $this->allowedMethods)) {
            throw new \InvalidArgumentException("Invalid request method: {$this->requestMethod}");
        }
        
        /**
         * Default attributes for the generated HTML element.
         *
         * @var array{
         *     requestVariable: string, // Query string parameter (only for GET requests), e.g., "?hello=world"
         *     text: string, // Button or element text content
         *     elType: string, // Type of HTML element, e.g., "button" or "a"
         *     class: string, // CSS classes for styling
         *     modal: bool, // Determines if the request should trigger a modal
         *     hx-<METHOD>: string, // HTMX request URL, dynamically set based on requestMethod
         *     hx-trigger: string, // Event that triggers the request, e.g., "click"
         *     hx-target: string, // Element target for content replacement, e.g., "this"
         *     hx-swap: string, // Swap strategy for HTMX, e.g., "innerHTML"
         *     hx-confirm: string, // Confirmation message before request execution
         *     hx-indicator: string, // Loading indicator element ID
         *     hx-disable: string // Whether the element should be disabled
         * }
         */
        $defaults = [
            'requestVariable' => '', // Query string parameter, e.g., "?id=123"
            'text' => 'Get Content', // Default button text
            'elType' => 'button', // Default element type
            'class' => 'btn', // Default CSS class
            'modal' => false, // Whether the request should open a modal
            "hx-{$this->requestMethod}" => '/_hook-url', // HTMX request URL
            'hx-trigger' => 'click', // Event that triggers the request
            'hx-target' => 'this', // Target element for response content
            'hx-swap' => 'outerHTML', // How to swap content
            'hx-confirm' => '', // Optional confirmation message
            'hx-indicator' => '', // Optional loading indicator
            'hx-disable' => '', // Whether to disable the element during the request
            'hx-headers' => '{"X-Internal-Request": "true", "X-Robots-Tag": "noindex, nofollow"}'
        ];

        $attr = array_merge($defaults, $this->attr);
        $this->attr = array_filter($attr); // Remove empty values
    }

    /**
     * Render Htmx element.
     *
     * @return string The generated HTML element.
     */
    function render() {

        if (isset($this->attr['requestVariable'])) {
            $this->attr["hx-$this->requestMethod"] = $this->attr["hx-$this->requestMethod"] . sanitizer()->text($this->attr['requestVariable']);  
        }

        $attr = '';
        foreach ($this->attr as $key => $value) {
            $items = match ($key) {
                'requestVariable' => '', // unset
                'text' => '', // unset
                'elType' => '', // unset
                'modal' => '', // unset
                'hx-disable' => "$key='true'\n",
                default => "$key='$value'\n",
            };
            $attr .= $items;
        }
        $attr = rtrim($attr);

        $el = $this->attr['elType'];
        $text = isset($this->attr['text']) ? $this->attr['text'] : '';
        $elEnd = "</{$el}>";

        if ($el == 'input') {
            $elEnd = '';
            $text = '';
        } 

        return <<<HTML
            <{$el}
                {$attr}
            >
                $text
            {$elEnd}
        HTML;
    }

    /**
     * Creates a HTMX button for fetching a component or partial dynamically.
     *
     * @param string $name Name of the component or partial to load.
     * @param string $type Type of content to fetch (component or partial).
     */
    function get($name = '', $type = 'component') {

        $modal = false;

        $requestVariable = isset($this->attr['requestVariable']) ? sanitizer()->text($this->attr['requestVariable']) : '';

        if (isset($this->attr['modal']) && $this->attr['modal'] == true) {
            $modal = "modal=1";
            $requestVariable = $requestVariable ? $requestVariable . "&$modal" : "?$modal";
        }
        $this->attr['requestVariable'] = $requestVariable ? "$requestVariable&type=$type" : "?type=$type";

        $attrModal = [
            'hx-swap' => 'beforeend',
            'hx-target' => 'body'
        ];

        $defaults = [
            "hx-{$this->requestMethod}" => $type == 'hook' ? _setURL($name) : _setURL("_load-content/{$name}"),
        ];
        if($modal) $defaults += $attrModal;
        
        $this->attr = array_merge($this->attr, $defaults);

        return $this->render();
    }

    /**
     * load hooks
     */
    function loadHook($hookUIrl) {
        $type = 'hook';
        return $this->get($hookUIrl, $type);
    }

    /**
     * Generates a HTMX button for dynamically loading a component.
     *
     * @param string $componentName Name of the component to load.
     * @return string The generated HTMX button.
     */
    public function getComponent($componentName) {
        $type = 'component';
        return $this->get($componentName, $type);
    }

    /**
     * Generates a HTMX button for dynamically loading a partial.
     *
     * @param string $partialName Name of the partial to load.
     * @return string The generated HTMX button.
     *
     */
    public function getPartial($partialName) {
        $type = 'partial';
        return $this->get($partialName, $type);
    }


    /**
     * Generates a HTMX button for dynamically loading a component.
     *
     * @param string $componentName Name of the component to load.
     * @return string The generated HTMX button.
     */
    public function getPage($pageID, $field) {
        $type = 'page';
        $defaults = [
            'requestVariable' => "?pageID=$pageID&field=$field"
        ];
        $this->attr = array_merge($this->attr, $defaults);
        return $this->get($pageID, $type);
    }
}
