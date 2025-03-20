<?php namespace ProcessWire;

/**
 * ProcessWire Configuration File
 *
 * Site-specific configuration for ProcessWire
 *
 * Please see the file /wire/config.php which contains all configuration options you may
 * specify here. Simply copy any of the configuration options from that file and paste
 * them into this file in order to modify them.
 *
 * SECURITY NOTICE
 * In non-dedicated environments, you should lock down the permissions of this file so
 * that it cannot be seen by other users on the system. For more information, please
 * see the config.php section at: https://processwire.com/docs/security/file-permissions/
 *
 * This file is licensed under the MIT license
 * https://processwire.com/about/license/mit/
 *
 * ProcessWire 3.x, Copyright 2023 by Ryan Cramer
 * https://processwire.com
 *
 */

if(!defined("PROCESSWIRE")) die();

/** @var Config $config */

/*** SITE CONFIG *************************************************************************/

// Let core API vars also be functions? So you can use $page or page(), for example.
$config->useFunctionsAPI = true;

// Use custom Page classes in /site/classes/ ? (i.e. template "home" => HomePage.php)
$config->usePageClasses = true;

// Use Markup Regions? (https://processwire.com/docs/front-end/output/markup-regions/)
$config->useMarkupRegions = true;

// Prepend this file in /site/templates/ to any rendered template files
$config->prependTemplateFile = '_init.php';

// Append this file in /site/templates/ to any rendered template files
$config->appendTemplateFile = '_main.php';

// Allow template files to be compiled for backwards compatibility?
$config->templateCompile = false;

/**
 * Use lazy loading of fields (plus templates and fieldgroups) for faster boot times?
 *
 * One significant change in 3.0.200 (relative to the previous master) is that ProcessWire now uses lazy-loading fields,
 * templates and fieldgroups. This is a fairly major system-level change
 *
 * This delays loading of fields, templates and fieldgroups until they are requested.
 * This can improve performance on systems with hundreds of fields or templates, as
 * individual fields, templates/fieldgroups won't get constructed until they are needed.
 *
 * Specify `true` to use lazy loading for all types, `false` to disable all lazy loading,
 * or specify array with one or more of the following for lazy loading only certain types:
 * `[ 'fields', 'templates', 'fieldgroups' ]`
 *
 * @var bool|array
 * @since 3.0.194
 *
 */
// $config->useLazyLoading = false;

/**
 * Example Custom Config
 * https://processwire.com/api/variables/config/
 * https://processwire.com/blog/posts/pw-3.0.87/#new-field-template-context-settings
 */

/** Advanced Configuration **/
// $config->advanced = true;

/** Show demo site **/
// $config->demo = true;

/** Predefined image size settings https://processwire.com/blog/posts/pw-3.0.151/#predefined-image-size-settings **/
// $config->imageSizes = [
// 	'thumb' => [
// 	  'width' => 200,
// 	  'height' => 200
// 	],
// 	'thumb2x' => [
// 	  'width' => 400,
// 	  'height' => 400,
// 	  'quality' => 50
// 	]
//   ];

/** https://processwire.com/blog/posts/pw-3.0.99/ **/
// $config->noHTTPS = true;

/**  ignore HTTPS for this hostname only: **/
// $config->noHTTPS = 'dev.processwire.com';

/** ignore HTTPS for these hostnames: **/
//     $config->noHTTPS = [
//       'dev.processwire.com',
//       'stage.processwire.com',
//       'your-localhost:8888',
//     ];

/**
 * ~~~~~
 * // Example of blacklist definition
 * $config->wireMail('blacklist',[
 *   'email@domain.com', // blacklist this email address
 *   '@host.domain.com', // blacklist all emails ending with @host.domain.com
 *   '@domain.com', // blacklist all emails ending with @domain.com
 *   'domain.com', // blacklist any email address ending with domain.com (would include mydomain.com too).
 *   '.domain.com', // blacklist any email address at any host off domain.com (domain.com, my.domain.com, but NOT mydomain.com).
 *   '/something/', // blacklist any email containing "something". PCRE regex assumed when "/" is used as opening/closing delimiter.
 *   '/.+@really\.bad\.com$/', // another example of using a PCRE regular expression (blocks all "@really.bad.com").
 * ]);
 *
 * // Test out the blacklist
 * $email = 'somebody@bad-domain.com';
 * $result = $mail->isBlacklistEmail($email, [ 'why' => true ]);
 * if($result === false) {
 *   echo "<p>Email address is not blacklisted</p>";
 * } else {
 *   echo "<p>Email is blacklisted by rule: $result</p>";
 * }
 * ~~~~~
 */

/** Set Custom Template Path ( https://processwire.com/api/ref/paths/ ) **/
// $customTemplate = 'basic';
// $PathTemplates = $config->paths->root . "site/templates-$customTemplate/";
// $UrlTemplates = $config->urls->root . "site/templates-$customTemplate/";
// $config->paths->templates = $PathTemplates; // i.e. /path/to/htdocs/site/templates/
// $config->urls->templates = $UrlTemplates; // i.e. /site/templates/

/*** INSTALLER CONFIG ********************************************************************/

/**
 * Installer: Database Configuration
 */
$config->dbHost = $dbHost;
$config->dbName = $dbName;
$config->dbUser = $dbUser;
$config->dbPass = $dbPass;
$config->dbPort = $dbPort;
$config->dbEngine = $dbEngine;

/**
 * Installer: User Authentication Salt
 *
 * This value was randomly generated for your system on 2021/07/15.
 * This should be kept as private as a password and never stored in the database.
 * Must be retained if you migrate your site from one server to another.
 * Do not change this value, or user passwords will no longer work.
 *
 */
$config->userAuthSalt = $userAuthSalt;

/**
 * Installer: Table Salt (General Purpose)
 *
 * Use this rather than userAuthSalt when a hashing salt is needed for non user
 * authentication purposes. Like with userAuthSalt, you should never change
 * this value or it may break internal system comparisons that use it.
 *
 */
$config->tableSalt = $tableSalt;

/**
 * Installer: File Permission Configuration
 *
 */
$config->chmodDir = '0755'; // permission for directories created by ProcessWire
$config->chmodFile = '0644'; // permission for files created by ProcessWire

/**
 * Installer: Time zone setting
 *
 */
$config->timezone = $timezone;

/**
 * Installer: Admin theme
 *
 */
$config->defaultAdminTheme = 'AdminThemeUikit';

/**
 * Installer: Unix timestamp of date/time installed
 *
 * This is used to detect which when certain behaviors must be backwards compatible.
 * Please leave this value as-is.
 *
 */
$config->installed = $installed;


/**
 * Installer: HTTP Hosts Whitelist
 *
 */
$config->httpHosts = array($httpHosts);


/**
 * Installer: Debug mode?
 *
 * When debug mode is true, errors and exceptions are visible.
 * When false, they are not visible except to superuser and in logs.
 * Should be true for development sites and false for live/production sites.
 *
 */
$config->debug = $debug;

// Site Live Reload ( Watch the site files for changes )
$config->liveReload = false;