<?php namespace ProcessWire;

function hookDeleteFont(HookEvent $event) {

    $fileName = $event->fileName;
    $templatesPath = paths()->templates;
    $filePath = $templatesPath.'assets/fonts/'.$fileName;

    $strRemove = __('Remove Font from - %s');
    $strFailed = __('Some Problems ( not remove font ) - %s');


    if( files()->exists($filePath) ) {
        $unlink = files()->unlink($filePath);

        if($unlink) {
            return Html::p(sprintf($strRemove, $filePath), ['class' => 'alert -success']);
        }

        return Html::p(sprintf($strFailed, $filePath), ['class' => 'alert -danger']);
    }
}
