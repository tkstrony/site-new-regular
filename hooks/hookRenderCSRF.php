<?php namespace ProcessWire;

/**
 * Render CSRF
 *
 * @param HookEvent $event ProcessWire hook event object
 */

function hookRenderCSRF(HookEvent $event) {
    return _renderCSRF();
}