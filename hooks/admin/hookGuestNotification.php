<?php namespace ProcessWire;

/**
 * Hide select_pages field from guest_notification field
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

function hookGuestNotification(HookEvent $event) {
    // Check if the page is not 'home'
    if (input()->get('id') == 1) return '';
    // $value contains the full rendered markup of a $page
    $value  = $event->return;
    // Inject CSS to hide the element 
    $css = '#wrap_Inputfield_guest_notification .Inputfields .Inputfields .Inputfields li:last-child { display: none !important; }';
    // replace content 
    $value = str_replace("</head>", "<style>{$css}</style></head>", $value);
    // set the modified value back to the return value
    $event->return = $value;
}
