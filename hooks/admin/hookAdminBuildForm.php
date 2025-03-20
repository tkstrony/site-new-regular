<?php namespace ProcessWire;

/**
 * Show related pages list on the home page
 * @link https://processwire.com/talk/topic/28967-related-pages-list-in-admin-area/#comment-235457
 *
 * @param HookEvent $event ProcessWire hook event object
 */

 function hookAdminBuildForm(HookEvent $event) {
    $form = $event->return;
    $page = $event->object->getPage();

    if ($page->template != 'home') return;

    $existingField = $form->get('title');

    $out = '';
    $pages = pages()->find("limit=5, template=basic-page, sort=random");
    foreach ($pages as $p) {
        $out .= "<div><a href={$p->editUrl}>{$p->title}</a></div>";
    }

    $newField = [
        'type' => 'markup',
        'label' => __('Last Posts'),
        'icon' => 'check',
        'value' => $out,
    ];

    // $form->insertBefore($newField, $existingField);
    $form->insertAfter($newField, $existingField);
}