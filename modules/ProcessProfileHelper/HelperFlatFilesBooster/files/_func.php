<?php namespace FlatFilesBooster;

function _getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }
    return 'UNKNOWN';
}


/**
 * Get the country name from IP address using DB-IP.
 *
 * @param string $ip
 * @return string
 */
function _getCountry($ip) {

    $_ds = DIRECTORY_SEPARATOR;

    // Check for localhost
    if ($ip === '127.0.0.1' || $ip === '::1') {
        return 'Localhost'; // or any other placeholder for testing
    }

    /**
     * Path to the DB-IP Country database ( https://db-ip.com/db/download/ip-to-country-lite )
     * The free IP to Country Lite database by DB-IP is licensed under a Creative Commons Attribution 4.0 International License.
     * You are free to use this IP to Country Lite database in your application, provided you give attribution to DB-IP.com for the data.
     * In the case of a web application, you must include a link back to DB-IP.com on pages that display or use results from the database.
     * You may do it by pasting the HTML code snippet below into your code : <a href='https://db-ip.com'>IP Geolocation by DB-IP</a>
     *
     */

    $databaseFile = __DIR__ .$_ds.'site'.$_ds.'modules'.$_ds.'ProcessProfileHelper'.$_ds.'inc/dbip-country-lite-2024-10.mmdb';

    try {
        // Create a GeoIP2 Reader instance
        $reader = new \GeoIp2\Database\Reader($databaseFile);

        // Get country information based on IP address
        $record = $reader->country($ip);
        return $record->country->isoCode; // Return the country code
    } catch (\Exception $e) {
        return 'unknown'; // Handle exceptions (e.g., IP not found)
    }
}

/**
 * Get the country name from IP address using DB-IP.
 *
 * @param string $ip
 * @return string
 */
function _saveLog($ip, $pageURL, $logName = 'visitors-log') {


    // Ignore URLs ending with "phcv1" Page Hit Counter Module
    if (str_ends_with($pageURL, 'phcv1')) {
        return;
    }

    static $recentLogs = [];

    // Check if this IP + Page URL has been logged recently
    $logKey = md5($ip . $pageURL); // Unique key for this visit
    if (isset($recentLogs[$logKey]) && (time() - $recentLogs[$logKey]) < 1) {
        return; // Skip logging if a log was made in the last second
    }

    $recentLogs[$logKey] = time(); // Update recent log timestamp

    $logger = new Logger();

    // Collect user data
    $visitorData = [
        'IP'        => $ip,                       // User's IP address
        'Page'      => $pageURL,                              // URL of the visited page
        'UserAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown', // User's browser (User-Agent header)
        'Timestamp' => date("d-m-Y H:i:s"),                     // Date and time of the visit
        'Country'   => _getCountry($ip)     // User's country
    ];

    // Convert the array to a JSON string
    $visitorData = json_encode($visitorData);

    // Create the log file name based on the current date (e.g., visitors-log-22-10-2024.txt)
    $logFileName = "{$logName}-" . date('d-m-Y'); // Each day has a separate log file

    $logger->save($logFileName, $visitorData, true);
}

function hostUrl(){
    $hostUrl = sprintf(
        "%s://%s/",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http',
        $_SERVER['HTTP_HOST']
    );
    return $hostUrl;
}

function deleteDirectory($dirPath) {
    if (!is_dir($dirPath)) {
        return false; // The folder does not exist
    }

    // Remove all files and subfolders
    $files = array_diff(scandir($dirPath), ['.', '..']);
    foreach ($files as $file) {
        $filePath = $dirPath . $file;
        is_dir($filePath) ? deleteDirectory($filePath) : unlink($filePath); // Recursively delete subfolders or unlink files
    }

    // Remove the now-empty folder
    return rmdir($dirPath);
}
