<?php namespace FlatFilesBooster;

/**
 * @var string $_ds Directory Separator
 * @var arrray $opt Baese options
 */

/**
 * X-Powered-By header behavior
 */
header('X-Powered-By: ProcessWire CMS');

// get ip
$ip = _getUserIP();
$_ds = DIRECTORY_SEPARATOR;
$filesPath = $opt['filesFolder'] . $_ds;
$mobileFilesPath = $filesPath . $opt['mobileFilesFolder'] . $_ds;
$logsFolder = __DIR__ . $_ds .'site' . $_ds . 'assets' . $_ds . 'logs' . $_ds;
$http404Folder = $filesPath . $opt['http404Folder'] . $_ds;
$http404FolderMobile = $mobileFilesPath . $opt['http404Folder'] . $_ds;

// Get cache time ( seconds )
$cachetime = $opt['cacheTime'];

// Create cache directory
if (!is_dir($filesPath)) {
    mkdir($filesPath, 0775, true);
}

// Create cache directory for mobile
if (!is_dir($mobileFilesPath)) {
    mkdir($mobileFilesPath, 0775, true);
}

if (!is_dir($http404FolderMobile)) {
    mkdir($http404FolderMobile, 0775, true);
}

// Create cache directory for mobile
if (!is_dir($http404Folder)) {
    mkdir($http404Folder, 0775, true);
}

// Create .htaccess file in cache directory
$htaccessFile = "{$filesPath}.htaccess";
if (!file_exists($htaccessFile)) {
    $htaccessContent = "Order deny,allow\nDeny from all\n";
    file_put_contents($htaccessFile, $htaccessContent);
}

// mobile detect
use Detection\MobileDetect;
$detect = new MobileDetect();
$isMobile = $detect->isMobile();

// Check if the user is logged in
$userIsLoggedIn = isset($_COOKIE["wires_challenge"]) || isset($_COOKIE["wire_challenge"]) || isset($_COOKIE["user_loggedin"]);

// Update via hook
$updateCacheViaGetRequest = isset($_GET['update_cache']);

// Get the URL (remove special characters)
$cleanUrl = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');

// Enable caching by default
$enableCache = true;

// check queries
$queryString = $_SERVER['QUERY_STRING'];
if (strpos($queryString, 'it=') === 0) {
    // default ProcesWire Query
} else if (!empty($queryString)) {
    $enableCache = false; // Inne parametry GET
}

// if post request
if(count($_POST) > 0) {
    $enableCache = false;
}

// if htmx request
if (isset($_SERVER['HTTP_HX_REQUEST'])) {
    // Check if the request has been boosted
    if (isset($_SERVER['HTTP_HX_BOOSTED']) && $_SERVER['HTTP_HX_BOOSTED'] === 'true') {
        // echo "HTMX BOOST.";
    } else {
        $enableCache = false;
    }
}

// Disable caching if pagination is used or if the URL contains GET or POST parameters
if (preg_match('/page(\d+)/', $cleanUrl) || parse_url($cleanUrl, PHP_URL_QUERY) !== null) {
    $enableCache = false;
}

// Disable caching if the user is logged in
if ($userIsLoggedIn) $enableCache = false;

// Disable caching for specific URLs
$notCachingUrls = [
    'qbit', // Admin URL
];
if (in_array(basename($cleanUrl), $notCachingUrls)) {
    $enableCache = false;
}

// If caching is disabled && dont update cache get request, include the ProcessWire bootstrap and exit
if ($enableCache == false && $updateCacheViaGetRequest == false) {
    include('_bootstrap.php');
    exit();
}

if($cleanUrl == '/rss.xml') {
    header('Content-type: application/xml');
}

if($cleanUrl == '/sitemap.xml') {
    header('Content-type: application/xml');
}

if($cleanUrl == '/robots.txt') {
    header("Content-Type: text/plain");
	http_response_code(200);

	$sitemapURL = hostUrl() . "sitemap.xml";
	echo
        <<<TEXT
            User-agent: *
            Allow: /
            Sitemap: {$sitemapURL}
        TEXT;
    return;
}

/**
 * PWA - Service Worker
 */
if($cleanUrl == '/pwa_sw') {
    header('Content-Type: application/javascript');
    header('X-Robots-Tag: noindex, nofollow');
    header('Service-Worker-Allowed: /'); // Allows SW to run across the entire domain
}


// Generate cache file name
$url = parse_url($cleanUrl, PHP_URL_PATH);
$url = trim($url, '/');
$url = str_replace('/', '-', $url);

// Set Home
if($url == '') $url = 'homePage';

// Set multilanguage prefix
if($url != 'homePage' && preg_match('#\b(en|de|pl)\b#', $url, $matches)) {
    // get prefix
    $prefix = $matches[1];
    // set homePage prefix url
    if($url == $prefix) {
        $url = "$prefix-homePage";
    }
}

// set base cahe file
$cachefile = "{$filesPath}{$url}.html";

// set mobile file
if($isMobile) {
    $cachefile = "{$mobileFilesPath}{$url}.html";
}

// set 404 false
$_404 = false;

// Read cached file if not send get request ( update_cache ) via hook && user is not logged in
if($updateCacheViaGetRequest == false && $userIsLoggedIn == false) {
    // if 404 file exsists
    if(file_exists(str_replace($url, "{$opt['http404Folder']}{$_ds}{$url}", $cachefile))) {
        // set rsponse header
        header("HTTP/1.0 404 Not Found");
        // save 404 log
        _saveLog($ip,$cleanUrl,'404-log');
        // set read file
        $cachefile = str_replace($url, "{$opt['http404Folder']}{$_ds}{$url}", $cachefile);
        // set 404 to true
        $_404 = true;
    }

    // Serve the cached copy if it's younger than $cachetime
    if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
        // save visitors log
        if(!$_404 && !str_contains($cleanUrl, 'http404')) {
            _saveLog($ip,$cleanUrl,'visitors-log');
        }
        // echo "<!-- Cached copy, generated " . date('Y-m-d | H:i', filemtime($cachefile)) . " -->\n";
        readfile($cachefile);
        exit();
    }
}

// Start output buffering
ob_start();

// Include the ProcessWire bootstrap
include('_bootstrap.php');

// http 404
if(http_response_code() == 404) {
    // save 404 as file
    if($opt['save404']) {
        $cachefile = str_replace($url, "{$opt['http404Folder']}{$_ds}{$url}", $cachefile);
    } else {
        ob_end_flush();
        exit();
    }
}

// if ProcessWireAdminTheme inited via custom hook
if (strpos(ob_get_contents(), 'ProcessWireAdminTheme.init()') !== false) {
    ob_end_flush();
    exit();
}

// Set filetime
// $caheTime = "\n<!-- Cached copy, generated " . date('Y-m-d | H:i') . " -->";
// Cache the output to a file and send it to the browser
$cached = fopen($cachefile, 'w');

// If the file could not be created (possibly due to permission issues or an invalid path)
if ($cached === false) {
    // Log the error using ProcessWire's logging system
    wire('log')->error("_flatFileBooster: Failed to open file for writing: $cachefile");

    // End output buffering and stop further execution
    ob_end_flush();
    exit();
}

// fwrite($cached, ob_get_contents() . $caheTime);
fwrite($cached, ob_get_contents());
fclose($cached);
// Change file permissions to 0644
chmod($cachefile, 0644);
ob_end_flush();
