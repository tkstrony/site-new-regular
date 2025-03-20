<?php namespace ProcessWire;

class ColorMode {

    /**
     * @param array $t Translation strings
     */
    public function __construct(
        public string $defaultTheme = '',
        public array $t = [],
        public string $id = '',
    ) {
        // translate
        $this->t = [
            // Color mode
            'lightTheme' => _t('lightTheme'),
            'darkTheme' => _t('darkTheme'),
            'cyberPunkTheme' => _t('cyberPunkTheme'),
            'coolTheme' => _t('coolTheme'),
            'systemTheme' => _t('systemTheme'),
            'selectColor' => _t('selectColor'),
        ];

        $parts = explode('\\', __CLASS__);
        $this->id = lcfirst(end($parts));
    }

    public function render() {
        // Color Palette
        $colorPalette = [
            $this->t['systemTheme'] => 'system',
            $this->t['lightTheme'] => 'basic',
            $this->t['darkTheme'] => 'dark',
            $this->t['coolTheme'] => 'cool',
            $this->t['cyberPunkTheme'] => 'cyberpunk',
        ];

        // set default
        $this->defaultTheme = $this->defaultTheme ?: 'system';

        $icon = _icon('palette');

        $option = '';
        foreach ($colorPalette as $name => $value) {
            $option .= <<<HTML
                <option value='{$value}' class='option-$value'>{$name}</option>
            HTML;
        }

        $legend = isset($showLegend) && $showLegend == true ? "<legend>{$this->t['selectColor']}</legend>" : '';

        // content
        $content = <<<HTML
        <fieldset id='{$this->id}' class='{$this->id}'>
            {$legend}
            <label class='-labels'>{$icon}
                <select aria-label="State" class='colorPalette' id='colorPalette' name='colorPalette'>
                    {$option}
                </select>
            </label>
        </fieldset>
        HTML;

        // return all
        return $content . $this->load();
    }

    public function load() {
        $style = <<<CSS
        .{$this->id} {
            .-labels {
                display: flex;
                align-items: center;
                gap: var(--sp-3xs);
                select {
                    margin-bottom: 0;
                }
            }
        }
        CSS;

        $script = <<<JS
            var defaultTheme = '{$this->defaultTheme}'; // Set system as default theme
            var storedTheme = localStorage.getItem('theme');
            var systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            var systemTheme = systemPrefersDark ? 'dark' : 'basic';

            // Apply system theme as default if no theme is stored
            if (!storedTheme || storedTheme === 'system') {

                if(defaultTheme && !storedTheme) {
                    document.documentElement.setAttribute("data-theme", defaultTheme);
                    localStorage.setItem('theme', defaultTheme); // Store 'theme' as default
                } else {
                    document.documentElement.setAttribute("data-theme", systemTheme);
                    localStorage.setItem('theme', 'system'); // Store 'system' as default
                }

            } else {
                document.documentElement.setAttribute("data-theme", storedTheme);
            }

            var colorSelect = document.getElementById('colorPalette');

            if (colorSelect) {
                function setTheme(themeName) {
                    localStorage.setItem('theme', themeName);
                    if (themeName === 'system') {
                        document.documentElement.setAttribute("data-theme", systemTheme);
                    } else {
                        document.documentElement.setAttribute("data-theme", themeName);
                    }
                }

                function changeColor() {
                    var selectedColor = colorSelect.value;
                    setTheme(selectedColor);
                }

                colorSelect.addEventListener('change', changeColor);

                // Set select option to stored theme or system by default
                if (storedTheme) {
                    colorSelect.value = storedTheme;
                } else {
                    colorSelect.value = defaultTheme;
                }
            }

            // Listen to system color scheme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                if (localStorage.getItem('theme') === 'system') {
                    var newColorScheme = e.matches ? 'dark' : 'basic';
                    document.documentElement.setAttribute('data-theme', newColorScheme);
                }
            });
        JS;

        return Html::styleTag($style) . Html::scriptTag($script);
    }
}
