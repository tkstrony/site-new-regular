<?php namespace ProcessWire;

/**
 * Copied Bootstrap from inex.php
 *
 */

if(!defined("PROCESSWIRE")) define("PROCESSWIRE", 300); // index version
$rootPath = __DIR__;
if(DIRECTORY_SEPARATOR != '/') $rootPath = str_replace(DIRECTORY_SEPARATOR, '/', $rootPath);
$composerAutoloader = $rootPath . '/vendor/autoload.php'; // composer autoloader
if(file_exists($composerAutoloader)) require_once($composerAutoloader);
if(!class_exists("ProcessWire\\ProcessWire", false)) require_once("$rootPath/wire/core/ProcessWire.php");
$config = ProcessWire::buildConfig($rootPath);

if(!$config->dbName) {
	// If ProcessWire is not installed, go to the installer
	if(is_file("./install.php") && strtolower($_SERVER['REQUEST_URI']) == strtolower($config->urls->root)) {
		require("./install.php");
		exit(0);
	} else {
		header("HTTP/1.1 404 Page Not Found");
		echo "404 page not found (no site configuration or install.php available)";
		exit(0);
	}
}

$process = null;
$wire = null;

try {
	// Bootstrap ProcessWire's core and make the API available with $wire
	$wire = new ProcessWire($config);
	$process = $wire->modules->get('ProcessPageView'); /** @var ProcessPageView $process */
	$wire->wire('process', $process);
	echo $process->execute($config->internal);
	$config->internal ? $process->finished() : extract($wire->wire('all')->getArray());

} catch(\Exception $e) {
	// Formulate error message and send to the error handler
	if($process) $process->failed($e);
	$wire ? $wire->trackException($e) : $config->trackException($e);
	$errorMessage = "Exception: " . $e->getMessage() . " (in " . $e->getFile() . " line " . $e->getLine() . ")";
	if($config->debug || ($wire && $wire->user && $wire->user->isSuperuser())) $errorMessage .= "\n\n" . $e->getTraceAsString();
	trigger_error($errorMessage, E_USER_ERROR);
}
