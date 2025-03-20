<?php namespace ProcessWire;

// Template file for pages using the “http404” template

// set lottie item
$lottie404 = _lottie()->load('http404.lottie',[
    'loop' => true,
    'controls' => false,
    'speed' => 1.5,
    'maxWidth' => 640,
    'autoplay' => true
])->render('id-http404',[
'styleTag' =>
    <<<CSS
        {
            position: fixed;
            top: 0;
            left: 50%;
            opacity: 0.20;
            transform: translateX(-50%);
            z-index: -1;
        }
    CSS
]);
?>

<div id="content-body" pw-append>
    <?= $lottie404 ?>
</div>

<?php
// save http 404
if(!user()->isLoggedin()) {

    $cleanUrl = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');

    $ip = session()->getIP();

    // Collect user data
    $visitorData = [
        'IP'        => $ip,     // User's IP address
        'Page'      => $cleanUrl,                              // URL of the visited page
        'UserAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown', // User's browser (User-Agent header)
        'Timestamp' => date("d-m-Y H:i:s"),                     // Date and time of the visit
        'Country'   => _getCountryFromIP($ip)     // User's country
    ];
    
    // save log 
    _log('404-log-' . date('d-m-Y'), $visitorData);
}
