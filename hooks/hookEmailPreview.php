<?php namespace ProcessWire;

/**
 * return email template preview.
 *
 * @param HookEvent $event ProcessWire hook event object
 */

function hookEmailPreview(HookEvent $event) {

    header('Content-Type: text/html; charset=UTF-8');
    header('X-Internal-Request: true');
    header('X-Robots-Tag: noindex, nofollow');

    $fileName = $event->fileName;

    $filePath = "assets/emails/{$fileName}.php";

    if(!files()->exists(paths()->templates . $filePath)) return Html::p("No found file in the $filePath");

    $vars = [];

    if($encodedVars = trim(input()->get('vars'))) {
        $vars = json_decode(base64_decode($encodedVars), true);
    }

    if($vars === null && json_last_error() !== JSON_ERROR_NONE) {
        return "Invalid JSON data in email preview.";
    }    
    
    return _renderMail($fileName, $vars);
} 