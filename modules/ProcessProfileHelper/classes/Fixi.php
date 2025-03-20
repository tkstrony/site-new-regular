<?php namespace ProcessWire;

/**
 * Generates an HTML element with Fixi attributes for dynamic content loading.
 * @link https://github.com/bigskysoftware/fixi
 *  
 */
class Fixi {

public function __construct(
    public array $attr = [],
    public string $requestMethod = 'get',
) {
    $defaults = [
        'requestVariable' => '', // like ?hello=allo
        'text' => 'Get Content',
        'elType' => 'button',
        'class' => 'btn',    
        'fx-action' => '/_hook-url',  
        'fx-method' => $this->requestMethod,
        'fx-trigger' => 'click',  
        'fx-target' => 'body',  
        'fx-swap' => 'innerHTML',  
        'fx-confirm' => '',  
        'fx-indicator' => '',  
        'fx-disable' => ''  
    ];
    $attr = array_merge($defaults, $this->attr);
    $this->attr = array_filter($attr); // remove unused items
}

    /**
     * @param array $options Configuration options for the Fixi element.
     * @return string The generated HTML element.
     *
     */
    function render() {

        if (isset($this->attr['requestVariable'])) {
            $this->attr["fx-$this->requestMethod"] = $this->attr["fx-$this->requestMethod"] . sanitizer()->text($this->attr['requestVariable']);  
        }
    
        $attr = '';
        foreach ($this->attr as $key => $value) {
            $items = match ($key) {
                'text' => '', // unset
                'elType' => '', // unset
                'fx-disable' => "$key='true'\n",
                default => "$key='$value'\n",
            };
            $attr .= $items;
        }
        $attr = rtrim($attr);

        $script = '';
        // Set confirmation dialog if needed
        if (isset($this->attr['fx-confirm'])) {
            $script = <<<JS
                document.addEventListener("fx:before", (event) => {
                    const el = event.target;
                    const message = el.getAttribute('fx-confirm');
                    if (message && !window.confirm(message)) {
                        event.preventDefault();
                    }
                });
            JS;
            $script = _globalRegion(_basename(__FUNCTION__), Html::scriptTag($script));
        }

        $el = $this->attr['elType'];
        $text = $this->attr['text'];
        $elEnd = "</{$el}>";

        if ($el == 'input') {
            $elEnd = '';
            $text = '';
        } 

        return <<<HTML
            {$script}
            <{$el}
                {$attr}
            >
                $text
            {$elEnd}
        HTML;
    }

    /**
     * Creates a Fixi button for fetching a component or partial dynamically.
     *
     * @param string $name Name of the component or partial to load.
     * @param string $type Type of content to fetch (component or partial).
     * 
     */
    function get($name = '', $type = 'component') {
        $requestVariable = isset($this->attr['requestVariable']) ? $this->attr['requestVariable'] : '';

        if (isset($this->attr['modal']) && $this->attr['modal'] == true) {
            $modal = "modal=1";
            $requestVariable = $requestVariable ? $requestVariable . "&$modal" : "?$modal";
        }

        $this->attr['requestVariable'] = $requestVariable ? "$requestVariable&type=$type" : "?type=$type";

        $defaults = [
            "fx-{$this->requestMethod}" => _setURL("_load-content/{$name}"),  
            'fx-swap' => 'beforeend',
            'fx-target' => 'body'
        ];
        $this->attr = array_merge($this->attr, $defaults);

        return $this->render();
    }

    /**
     * Generates a Fixi button for dynamically loading a component.
     *
     * @param string $componentName Name of the component to load.
     * @return string The generated Fixi button.
     * 
     */
    public function getComponent($componentName) {
        $type = 'component';
        return $this->get($componentName, $type);
    }

    /**
     * Generates a Fixi button for dynamically loading a partial.
     *
     * @param string $partialName Name of the partial to load.
     * @return string The generated Fixi button.
     *
     */
    public function getPartial($partialName) {
        $type = 'partial';
        return $this->get($partialName, $type);
    }
}
