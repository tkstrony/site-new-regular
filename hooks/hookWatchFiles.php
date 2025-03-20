<?php namespace ProcessWire;

/**
 * Watch the site files for changes
 * 
 * @param HookEvent $event ProcessWire hook event object
 */

 function hookWatchFiles(HookEvent $event) {
    // set function watch
    function getFiles( $watchedDirectory ) {

        $watchedDirectory = realpath($watchedDirectory);
        $scanDir = files()->find($watchedDirectory,[
                'excludeHidden' => true,
                'excludeDirNames' => [
                'vendor',
                'cache',
                'backups',
                'logs',
                'sessions',
                'files',
                'icons',
                'TracyDebugger',
                'LogsJsonViewer',
                'node_modules'
            ]
        ]);
        if(!is_array($scanDir)) return '';
        $lastModifiedTime = '';
        foreach ($scanDir as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if(!$ext) {
                $lastModifiedTime .= getFiles($file);
            } else {
                $lastModifiedTime .= filemtime($file);
            }
        }

        return $lastModifiedTime;
    }

    $watchedDirectory = config()->paths->site;
    getFiles( $watchedDirectory );


    if( !session()->get('lastModifiedTime') ) {
        $lastModifiedTime = getFiles($watchedDirectory);
        $lastModifiedTime = session()->set('lastModifiedTime', $lastModifiedTime);
    }

    if( session()->get('lastModifiedTime') ) {
        $lastModifiedTime = session()->get('lastModifiedTime');

        if($lastModifiedTime != getFiles($watchedDirectory)) {
            session()->remove('lastModifiedTime');
            http_response_code(205);
            return '';
        }
    }

    http_response_code(200);
    return '';
}
