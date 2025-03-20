<?php namespace ProcessWire;

/**
 * Name: _analytics-JS
 * @var string $gaCode Google Analytics tracking code
 */

// Retrieve Google Analytics tracking code from site options
$gaCode = _site()->gaCode;

// If no tracking code is set, exit early
if (!$gaCode) return '';

// Initialize an empty string to store the script output
$out = '';

// Define the JavaScript snippet for initializing Google Analytics
$gaScript = <<<JS
    if (!window.gaListenerAdded) {
        window.gaListenerAdded = true;

        function initializeAnalytics() {
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{$gaCode}');
        }

        // Run analytics initialization immediately if the page is already loaded,
        // otherwise, wait for the DOM to be ready
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            initializeAnalytics();
        } else {
            document.addEventListener('DOMContentLoaded', initializeAnalytics);
        }

        // Reinitialize analytics after an HTMX page swap if boost mode is enabled
        window.addEventListener('htmx:afterSwap', function(evt) {
            if (evt.detail.boosted) {
                initializeAnalytics();
            }
        });
    }
JS;

// Load Google Analytics script
$out .= Html::scriptSrcTag("https://www.googletagmanager.com/gtag/js?id={$gaCode}");
$out .= Html::scriptTag($gaScript);

// Return the generated script tags
return $out;
