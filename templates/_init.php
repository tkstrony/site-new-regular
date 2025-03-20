<?php namespace ProcessWire;

// Optional initialization file, called before rendering any template file.
// This is defined by $config->prependTemplateFile in /site/config.php.
// Use this to define shared variables, functions, classes, includes, etc. 


// include custom functions
files()->include('./_func');

/**
 * Experimental rules for CSP - `Content Security Policy (CSP)`
 * @link https://content-security-policy.com/
 * https://www.writesoftwarewell.com/content-security-policy/
 * https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
 */
$cspRules = function() {
    // Generate CSP nonce
    $cspNonce = base64_encode(random_bytes(16));

    // Set nonce in session if needed
    session()->set('cspNonce', $cspNonce);

    // Return CSP rules
    return [
        "default-src 'self'",
        "script-src 'nonce-$cspNonce' 'strict-dynamic'",
        "connect-src 'self' https://www.google.com",
        "frame-src https://www.google.com https://www.youtube.com/ https://www.youtube-nocookie.com/",
        "img-src 'self' data: https://www.google.com https://i.ytimg.com/",
        "style-src 'self' 'nonce-$cspNonce'",
        "font-src 'self' https://fonts.gstatic.com",
        "base-uri 'self'",
        "form-action 'self'",
    ];
};

// Apply CSP headers for non-logged-in users and non-htmx requests
if (!user()->isLoggedin() && _site()->enable_csp === true && !_isHxRequest()) {
    header("Content-Security-Policy: " . implode('; ', $cspRules()));
}


/**
 * Save logs for visitors who are not logged in and when debugging is not enabled.
 */
if (!user()->isLoggedin() && config()->debug && _site()->saveGuestVisitLogs && !_is404()) {

    // Collect user data
    $visitorData = [
        'IP'        => session()->getIP(),                       // User's IP address
        'Page'      => $page->url,                              // URL of the visited page
        'UserAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown', // User's browser (User-Agent header)
        'Timestamp' => date("d-m-Y H:i:s"),                     // Date and time of the visit
        'Country'   => _getCountryFromIP(session()->getIP())     // User's country
    ];

    // Convert the array to a JSON string
    $visitorData = json_encode($visitorData);

    // Create the log file name based on the current date (e.g., visitors-log-22-10-2024.txt)
    $logFileName = 'visitors-log-' . date('d-m-Y'); // Each day has a separate log file

    // Save the log entry to the file with the daily name
    _log($logFileName, $visitorData);
}

/**
 * Publish post on date
 * https://processwire.com/docs/more/lazy-cron/
 */
wire()->addHook('LazyCron::everyHour', function($e){
    $posts = $this->pages->find('template=blog-post,status=unpublished,cbox=1');
    foreach($posts as $post) {
        $publicationTime = wireDate('ts',$post->date);
        if($publicationTime <= time()) {
            $post->of(false);
            // https://processwire.com/api/ref/page/remove-status/
            $post->removeStatus('unpublished');
            $post->cbox = 0;
            $post->save();
            // Collect blog data
            $postData = [
                'Post Title'  => $post->title, // URL of the post
                'Post URL'  => $post->httpUrl, // URL of the post
                'Scheduled publication'  => wireDate('d-m-Y H:i:s', $post->date()), // Scheduled publication date
                'Published' => wireDate('d-m-Y H:i:s',$post->published), // Date and time of the published post
            ];
            // set message
            _log('published-log-' . date('d-m-Y'),$postData);
        }
    }
});

