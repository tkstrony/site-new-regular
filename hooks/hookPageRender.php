<?php namespace ProcessWire;

/**
 * Modifies the rendered page content before output.
 *
 * Applies dynamic content replacements such as flash messages, 
 * guest notifications and CSRF token injection.
 * Also minimizes whitespace in the final output.
 * 
 * @param HookEvent $event ProcessWire hook event object
 */
function hookPageRender(HookEvent $event) {

    // get content
    $content = $event->return;

    // show flash message
    $message = _flashMessage()->render();
    if ($message) {
        _flashMessage()->remove(); // remove flash message
    }

    // show guest message
    $guestNotification = _site()->guestNotification();

    // Define replacements in an array
    $replacements = [
        '</header>' => $message ? "</header>{$message}" : '</header>',
        '<header'   => $guestNotification ? "{$guestNotification}<header" : '<header',
        '{CSRF_TOKEN}' => _renderCSRF(),
        '{COOKIE_SCRIPTS}' => _partial('_cookie-scripts-JS'),
    ];
    // Apply all replacements at once
    $content = strtr($content, $replacements);

    // return html content with changes, minifying white spaces
    $content = preg_replace("/(\s)\s+/", "$1", $content);

    // return content
    $event->return = $content;
}
