<?php namespace ProcessWire;

/**
 * Class Chart
 * This class handles the integration of the Chart.js library into a PHP project.
 * It provides methods to include Chart.js via a CDN and create chart elements
 * with customizable configurations.
 *
 * Usage example:
 * ```php
// set charts
$chart = new Chart('max-width: 960px; margin: auto; padding: 10px;');

// basic charts
echo $chart->render('myChart', 'bar',
    <<<JS
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            // backgroundColor: '#ff8942',
            backgroundColor: ['red','blue','yellow','green','purple','orange'],
            borderColor: 'black',
            borderWidth: 2,
        }]
    JS,
    [
        'scales' => [
            'y' => [
                'beginAtZero' => true,
                'max' => 10
            ]
        ]
    ]
);

// pattern charts
echo $chart->render('myChart2', 'pie',
    <<<JS
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                pattern.draw('square', 'red'),
                pattern.draw('circle', 'blue'),
                pattern.draw('diamond', 'yellow'),
                pattern.draw('diamond', 'green'),
                pattern.draw('diamond', 'purple'),
                pattern.draw('triangle', 'orange    ')
            ],
            borderWidth: 1
        }]
    JS,
    [
        'scales' => [
            'y' => [
                'beginAtZero' => true,
                'max' => 10
            ]
        ]
    ]
);

// pw comparison charts
echo $chart->render('cmsComparisonChart', 'bar',
    <<<JS
        labels: ['Flexibility', 'Performance', 'Ease of Use', 'Security', 'Scalability'],
        datasets: [
            {
                label: 'ProcessWire',
                data: [9, 8, 9, 9, 8],
                backgroundColor: pattern.draw('square', '#3498db')
            },
            {
                label: 'WordPress',
                data: [7, 6, 9, 6, 7],
                backgroundColor: pattern.draw('circle', '#e74c3c')
            },
            {
                label: 'Drupal',
                data: [8, 7, 6, 8, 8],
                backgroundColor: pattern.draw('triangle', '#2ecc71')
            },
            {
                label: 'Joomla',
                data: [7, 6, 7, 7, 7],
                backgroundColor: pattern.draw('diamond', '#f1c40f')
            },
            {
                label: 'Payload',
                data: [8, 7, 7, 8, 7],
                backgroundColor: pattern.draw('cross', '#9b59b6')
            },
            {
                label: 'Grav',
                data: [7, 8, 8, 7, 7],
                backgroundColor: pattern.draw('zigzag', '#34495e')
            }
        ],
    JS,
    [
        'scales' => [
            'y' => [
                'beginAtZero' => true,
                'max' => 10
            ]
        ]
    ]
);
 * ```
 *
 * @link https://github.com/chartjs/awesome?tab=readme-ov-file#plugins
 */

class Chart
{
    /**
     * Base URL for the Chart.js library
     * @var string
     */
    private string $chartLibs = 'https://cdn.jsdelivr.net/npm/chart.js';

    /**
     * Base URL for the patternomaly library
     * @var string
     */
    private string $patternLibs = 'https://cdnjs.cloudflare.com/ajax/libs/patternomaly/1.3.2/patternomaly.js';

    /**
     * Default options for the chart
     * @var array
     */
    private array $defaultOptions = [
        'responsive' => true,
        'scales' => [
            'y' => [
                'beginAtZero' => true
            ]
        ]
    ];

    /**
     * Set basic options
     * @var string $containerStyle - basic style for container
     */
    public function __construct(
        public string $containerStyle = 'max-width: 960px; margin: auto; padding: 10px;'
    ) {
    }


/**
 * Renders a chart using Chart.js.
 *
 * @param string $elementId The ID of the canvas element where the chart will be rendered.
 * @param string $type The type of chart (e.g., 'bar', 'line', 'pie').
 * @param string $data The chart data as a string.
 * @param array $userOptions The user-defined options for the chart.
 * @param array $plugins Optional plugins for the chart.
 * @return string The HTML and JavaScript required to render the chart.
 */
public function render(string $elementId, string $type, string $data, array $userOptions = [], array $plugins = []): string
{

    // Merge default options with user-defined options
    $options = $this->mergeOptions($this->defaultOptions, $userOptions);

        // Convert options and plugins to JSON
        $optionsJs = json_encode($options, JSON_UNESCAPED_SLASHES);
        $pluginsJs = json_encode($plugins, JSON_UNESCAPED_SLASHES);

        $script = <<<JS
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('{$elementId}');

            let myChart = null;

            function getCSSVariableValue(variableName) {
                return getComputedStyle(document.documentElement).getPropertyValue(variableName).trim();
            }

            function updateChartDefaults() {
                Chart.defaults.backgroundColor = getCSSVariableValue('--color-accent');
                Chart.defaults.borderColor = getCSSVariableValue('--color-secondary');
                Chart.defaults.color = getCSSVariableValue('--text-color');
            }

            function loadChart() {
                // Destroy existing chart if it exists
                if (myChart) {
                    myChart.destroy();
                }

                // Create a new chart instance
                myChart = new Chart(ctx, {
                    type: '{$type}',
                    data: {
                        {$data}
                    },
                    options: {$optionsJs},
                    plugins: {$pluginsJs}
                });
            }

            // Initial setup
            updateChartDefaults();
            loadChart();

            // Monitor theme changes
            const themeObserver = new MutationObserver((mutations) => {
                mutations.forEach(() => {
                    updateChartDefaults();
                    loadChart(); // Destroy the old chart and create a new one
                });
            });

            // Observe changes to the data-theme attribute for theme switching
            themeObserver.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['data-theme']
            });
        });
        JS;

        $script = Html::scriptTag($script);

        $libs = _globalRegion('Chart_libs', Html::scriptSrcTag($this->chartLibs) . Html::scriptSrcTag($this->patternLibs));

        return 
        <<<HTML
            <div class='$elementId chart-container' style='$this->containerStyle'>
                <canvas id='{$elementId}'></canvas>
            </div>
            {$libs} \n {$script}
        HTML;
    }

    /**
     * Merges user-defined options with default options.
     * This method recursively combines the default options with the user-defined options.
     * It overrides the default values with user-specified values, instead of merging them into arrays.
     *
     * @param array $default The default options array.
     * @param array $user The user-defined options array.
     * @return array The merged options array, where user-defined values override the defaults.
     */
    private function mergeOptions(array $default, array $user): array
    {
        foreach ($user as $key => $value) {
            if (is_array($value) && isset($default[$key]) && is_array($default[$key])) {
                $default[$key] = $this->mergeOptions($default[$key], $value);
            } else {
                $default[$key] = $value;
            }
        }
        return $default;
    }
}
