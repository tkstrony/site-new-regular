<?php namespace ProcessWire;

/**
 * Retrieve the current HTTP host from the server variables.
 * If the variable is not set, default to an empty string.
 */
$host = $_SERVER['HTTP_HOST'] ?? '';

/**
 * Validate the host name to ensure it conforms to domain name standards 
 * according to RFC 1034 and RFC 1123. This helps prevent invalid or malicious hostnames.
 */
$host = filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME);

/**
 * Terminate the script if the host name is invalid.
 * This provides an additional layer of security against unexpected input.
 */
if (!$host) {
    exit('Invalid host name');
}

/**
 * Define host names for different environments.
 * These values should be customized to match your project's domain structure.
 */
$config->productionSiteHostName = 'yoursite.domain.com'; 
$config->devSiteHostName = 'pw-new-regular.ddev.site';

/**
 * Determine the current environment based on the HTTP host.
 * Uses the match expression to assign environment values dynamically.
 * If no match is found, the environment is set to 'unknown'.
 */
$config->env = match (true) {
    str_contains($host, $config->devSiteHostName) => 'dev',
    str_contains($host, $config->productionSiteHostName) => 'production',
    default => 'unknown', // Optional security fallback
};

/**
 * Stop script execution if the environment cannot be determined.
 * This prevents the application from running with misconfigured domain settings.
 */
if ($config->env == 'unknown') {
    exit('Invalid domain configuration. Please check your host settings.');
}

/**
 * Environment-specific configuration.
 * Development environment settings.
 */
if ($config->env == 'dev') {
    // Database connection details for the development environment.
    $config->dbHost = 'db';
    $config->dbName = 'db';
    $config->dbUser = 'db';
    $config->dbPass = 'db';
    $config->dbPort = '3306';
    $config->dbCharset = 'utf8mb4';
    $config->dbEngine = 'InnoDB';

    // Whitelist of allowed HTTP hosts in the development environment.
    $config->httpHosts = [$config->devSiteHostName];

    // Enable debugging mode to show detailed error messages.
    $config->debug = true;

    // Enable live reload functionality for development.
    $config->liveReload = false;

    // enable advanced mode
    $config->advanced = false;
}

/**
 * Environment-specific configuration.
 * Production environment settings.
 */
if ($config->env == 'production') {
    // Database connection details for the production environment.
    $config->dbHost = 'production_host';
    $config->dbName = 'db_name_prod';
    $config->dbUser = 'db_user_prod';
    $config->dbPass = 'db_pass_prod';
    $config->dbPort = '3306';
    $config->dbCharset = 'utf8mb4';
    $config->dbEngine = 'InnoDB';

    // Whitelist of allowed HTTP hosts in the production environment.
    $config->httpHosts = [$config->productionSiteHostName, 'www.' . $config->productionSiteHostName];

    // Disable debugging mode to prevent sensitive information from being displayed.
    $config->debug = false;
}
