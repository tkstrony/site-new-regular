<?php namespace ProcessWire;

/**
 * load custom content ( partials, components )
 * 
 * @param HookEvent $event ProcessWire hook event object
 */
function hookLoadContent(HookEvent $event) {

    $type = sanitizer()->text(input()->get('type'));

    $pathName = ltrim($event->arguments(1), '/');
    $pathName = sanitizer()->text($pathName);
 
    if(!$pathName || !$type) return 'No specified item';

    $content = '';
    if($type == 'page') {
        $pageID = sanitizer()->int(input()->get('pageID'));
        $field = sanitizer()->selectorValue(input()->get('field'));
        
        if ($pageID && $field) {
            $allowedTemplates = "contact|personal-data|basic-page|blog-post";
            $page = pages()->get("id=$pageID,template=$allowedTemplates,check_access=1,has_parent!=2");
        
            if (!$page->id) return '';
        
            // We allow access to hidden pages only for the "personal-data" template
            if (!$page->hasStatus(Page::statusHidden) || $page->template == 'personal-data') {
                $content = $page->hasField($field) ? $page->$field : null;
            }
        }
    }

    $item = match($type) {
        'component' => _component($pathName),
        'partial' => _partial($pathName),
        'page' => $content, 
        default => '',
    };

    if(!$item) return "No found any item for {$type} - {$pathName}";

    if(input()->get('modal')) {
        return  _modal($item);
    }

    return $item;
}
