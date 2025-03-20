<?php namespace ProcessWire;

$out = '';

/**
 * Toggle class on view
 */
$out .= Html::scriptTag(<<<JS
    function toggleClassOnView(elementSelector, targetSelector, className) {
    const element = document.querySelector(elementSelector);
    const target = document.querySelector(targetSelector);
    if (!element || !target) return;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                element.classList.add(className);
            } else {
                element.classList.remove(className);
            }
        });
    }, {
        root: null, // observes visibility relative to the viewport
        threshold: 0 // triggers when even a small part of the target is visible
    });
        observer.observe(target);
    }
JS);

/**
 * Head room
 */
$out .= Html::scriptTag(<<<JS
    window.addEventListener("load", (event) => {
    // grab elements
    var elements = document.querySelectorAll(".hdrom");
    // iterate over the elements
        elements.forEach(function(element) {
            // construct an instance of Headroom, passing each element
            var headroom = new Headroom(element);
            // initialise
            headroom.init();
        });
    });
JS);

/**
 * tooltip
 */
$out .= Html::scriptTag(<<<'JS'
import {
  computePosition,
  flip,
  shift,
  offset,
  arrow,
} from 'https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.13/+esm';

// Function to initialize tooltips
function initTooltips() {
  document.querySelectorAll('.tooltip-button:not([data-tooltip-initialized])').forEach(button => {
    button.setAttribute('data-tooltip-initialized', 'true'); // Mark button as initialized

    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.innerHTML = '<div class="tooltip-arrow"></div>';
    document.body.appendChild(tooltip);
    const arrowElement = tooltip.querySelector('.tooltip-arrow');

    function showTooltip() {
      if (window.innerWidth < 768 && !button.classList.contains('mobile-on')) return;

      tooltip.textContent = button.dataset.tooltip;
      tooltip.appendChild(arrowElement);
      tooltip.style.opacity = '1';
      tooltip.style.zIndex = Date.now().toString();

      computePosition(button, tooltip, {
        placement: 'top',
        middleware: [offset(6), flip(), shift({ padding: 5 }), arrow({ element: arrowElement })],
      }).then(({ x, y, placement, middlewareData }) => {
        Object.assign(tooltip.style, {
          left: `${x}px`,
          top: `${y}px`,
        });

        if (middlewareData.arrow) {
          const { x: arrowX, y: arrowY } = middlewareData.arrow;
          const staticSide = {
            top: 'bottom',
            right: 'left',
            bottom: 'top',
            left: 'right',
          }[placement.split('-')[0]];

          Object.assign(arrowElement.style, {
            left: arrowX != null ? `${arrowX}px` : '',
            top: arrowY != null ? `${arrowY}px` : '',
            right: '',
            bottom: '',
            [staticSide]: '-4px',
          });
        }
      });
    }

    function hideTooltip() {
      tooltip.style.opacity = '0';
    }

    button.addEventListener('mouseenter', showTooltip);
    button.addEventListener('mouseleave', hideTooltip);
    button.addEventListener('focus', showTooltip);
    button.addEventListener('blur', hideTooltip);

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const showDuration = button.dataset.show ? parseInt(button.dataset.show, 10) * 1000 : 0;
          const startDelay = button.dataset.start ? parseInt(button.dataset.start, 10) * 1000 : 0;

          if (showDuration > 0) {
            setTimeout(() => {
              showTooltip();
              setTimeout(hideTooltip, showDuration);
            }, startDelay);

            observer.unobserve(button);
          }
        }
      });
    }, { threshold: 1.0 });

    observer.observe(button);
  });
}

// Initialize tooltips on page load
initTooltips();

// Reinitialize tooltips after HTMX swaps content
document.body.addEventListener('htmx:afterSwap', () => {
  initTooltips();
});

JS,['type' => 'module']);

/**
 * Lozad.js
 */
$out .= Html::scriptTag(<<<JS
if (!window.lozadListenerAdded) {
    window.lozadListenerAdded = true;
    function lozadRun() {
        const observer = lozad('.lozad', {
            // load: function(el) {},
            loaded: function(el) {
                el.classList.add('loaded-finish');

                // Call the function when the images are finished loading
                if (typeof window.onLozadLoaded === 'function') {
                    window.onLozadLoaded();
                }
            }
        });
        observer.observe();
    }
    window.addEventListener('DOMContentLoaded', lozadRun);
    window.addEventListener('htmx:load', function(evt) {
        lozadRun();
    });
}
JS);

/**
 * scrool animation
 *
 * @link https://developer.chrome.com/docs/css-ui/scroll-driven-animations
 * @link https://scroll-driven-animations.style/demos/image-reveal/waapi/?embed
 *
 */
$out .= Html::scriptTag(<<<JS
    (function() {
        // Check if the browser supports ViewTimeline.
        // If ViewTimeline is not available (e.g., in older browsers or Firefox),
        // the script stops further execution to prevent errors related to unsupported features.
        if (!('ViewTimeline' in window)) return;

        // Get all images with the class 'scroll-animation'
        const images = document.querySelectorAll('.scrool-animation');

        // Iterate over each image and apply the animation
        images.forEach((image) => {
            const animation = image.animate(
                {
                    opacity: [0, 1],
                    clipPath: ['inset(45% 20% 45% 20%)', 'inset(0% 0% 0% 0%)'],
                },
                {
                    fill: 'both', // The effect applies before and after the animation
                    timeline: new ViewTimeline({
                        subject: image,
                    }),
                    rangeStart: 'entry 25%',
                    rangeEnd: 'cover 50%',
                }
            );

            // Optionally, stop the animation and reset to the initial state after completion
            // animation.addEventListener('finish', () => {
            //     animation.cancel();  // Stop the animation and restore the state before it started
            // });
        });
    })();
JS,['type' => 'module']);

/**
 * Glowing corners
 */
$out .= Html::scriptTag(<<<JS
    function glowingCorners() {
        document.querySelectorAll(".glowing-corners").forEach(el => {
            // We check if `span` is already added
            if (el.querySelectorAll("span").length === 4) return;

            for (let i = 0; i < 4; i++) {
                let span = document.createElement("span");
                span.setAttribute("aria-hidden", "true"); // Ukrycie dla czytników ekranowych
                el.appendChild(span);
            }
        });
    }

    // We run it once per DOM load
    window.addEventListener('DOMContentLoaded', glowingCorners);

    // We only run it for new elements loaded via htmx
    window.addEventListener('htmx:load', function(evt) {
        evt.target.querySelectorAll(".glowing-corners").forEach(el => {
            if (el.querySelectorAll("span").length === 4) return;
            glowingCorners();
        });
    });
JS);

/**
 * background scrool animation ( on desktop )
 */
// if(_isDesktop()) $out .= Html::scriptTag(<<<JS
//     window.addEventListener('scroll', function() {
//         const scrollY = window.scrollY; // The current vertical scroll position
//         document.documentElement.style.setProperty('--scroll-pos', `\${scrollY * 0.05}px`);
//     });
// JS);

return $out;
