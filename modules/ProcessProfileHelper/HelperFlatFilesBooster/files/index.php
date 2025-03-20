<?php namespace ProcessWire;

// load bootstrap if .envFlatFiles not exsists
if(!file_exists(__DIR__.DIRECTORY_SEPARATOR. '.envFlatFiles')) {
	// load pw botstrap
	require_once('_bootstrap.php');
	return '';
}

// require env
require (__DIR__.DIRECTORY_SEPARATOR.'EnvManager.php');
$env = new \FlatFilesBooster\EnvManager(__DIR__.DIRECTORY_SEPARATOR. '.envFlatFiles');

/**
 * Load essential project dependencies, including Composer autoload and additional files.
 *
 * @param string $baseDir Base directory for the project (default is __DIR__).
 * @param array $autoloadPathSegments Path segments leading to Composer autoload.php (default to common structure).
 * @return bool True if all essential files were successfully loaded, false otherwise.
 */
function _loadEssentialFiles(
    string $baseDir = __DIR__,
    array $autoloadPathSegments = ['site', 'modules', 'ProcessProfileHelper', 'vendor', 'autoload.php']
): bool {
    // Construct the autoload path using DIRECTORY_SEPARATOR
    $autoloadPath = $baseDir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $autoloadPathSegments);

    // Attempt to load Composer autoload.php
    if (is_readable($autoloadPath)) {
        require_once($autoloadPath);
    } else {
        error_log("The file autoload.php was not found or is unavailable: " . $autoloadPath);
        return false;
    }

    // Attempt to load additional essential files
    $additionalFiles = [
        $baseDir . DIRECTORY_SEPARATOR . 'Logger.php',
        $baseDir . DIRECTORY_SEPARATOR . '_func.php',
    ];

    foreach ($additionalFiles as $file) {
        if (is_readable($file)) {
            require_once($file);
        } else {
            error_log("The required file was not found or is unavailable: " . $file);
            return false;
        }
    }

    return true;
}

// URL patterns to check when load HTMX or POST Request
$protectedPaths = [
    '_likes',
    '_block-images',
    '_processForm',
    '_loadImg',
    '_email-preview',
    '_load-content',
    '_load-scripts',
    '_load-component',
    '_find-one',
    '_search-query',
    '_load-partial',
    '_load-partial_searchForm',
	'_load-partial_contactForm',
	'_render-csrf',
    'embera_load_youtube',
    'embera_load_content',
    'embed_url',
];

// Check if the URL contains a protected path
$requestUri = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');

// Exclude this urls from boosting 
$notBoost = [
    '/user-zone'
];
foreach ($notBoost as $path) {
    if (strpos($requestUri, $path) !== false) {
        require_once('_bootstrap.php');
        return '';
    }
}

// Set default protected to false
$isProtected = false;

// Check protected paths 
foreach ($protectedPaths as $path) {
    if (strpos($requestUri, $path) !== false) {
        $isProtected = true;
        break;
    }
}

// Check if the URL contains unwanted file extensions
if (preg_match('/\.(php|txt|log|env)$/', $requestUri)) {
    $isProtected = true;
}

// Exception for _load-partial_contactForm with POST method
if (strpos($requestUri, '_load-partial_contactForm') !== false && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $isProtected = false; // We allow this request
}

// Checking HTMX headers
$isHxRequest = isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] === 'true';

// Returning a 403 error if the request is unauthorized
if ($isProtected && !$isHxRequest) {

	// save log
	if (_loadEssentialFiles()) {
		// get ip
		$ip = \FlatFilesBooster\_getUserIP();

		// Get the URL (remove special characters)
		$cleanUrl = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');

		// save log
		\FlatFilesBooster\_saveLog($ip,$cleanUrl,'access-denied');
	}

    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Access denied']);

    return '';
}

// default options
$opt = [
    'boost' => $env->get('BOOST'),
    'filesFolder' => $env->get('FILES_FOLDER'),
    'mobileFilesFolder' => $env->get('MOBILE_FILES_FOLDER'),
    'http404Folder' => $env->get('HTTP404_FOLDER'),
    'save404' => $env->get('SAVE404'),
    'cacheTime' => $env->get('CACHE_TIME'),
];

// load flat file booster
if($opt['boost'] == true && _loadEssentialFiles()) {
	require_once('_flatFileBooster.php');
	return '';
}

// load pw botstrap
require_once('_bootstrap.php');
