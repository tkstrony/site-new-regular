<?php namespace ProcessWire;

/**
 * ProcessProfileHelper.info.php
 *
 * Return information about this module.
 *
 * If you prefer to keep everything in the main module file, you can move this
 * to a static getModuleInfo() method in the ProcessProfileHelper.module.php file, which
 * would return the same array as below.
 *
 * Note that if you change any of these properties for an already installed
 * module, you will need to do a Modules > Refresh before you see them.
 *
 * @link https://processwire.com/api/ref/module/
 *
 */

$info = array(

	// Your module's title
	'title' => 'Profile Helper Module, based on ProcessHello module',

	// A 1 sentence description of what your module does
	'summary' => 'A starting point module skeleton from which to build your own Process module.',

	// Module version number (integer)
	'version' => 1,

	// Name of person who created this module (change to your name)
	'author' => 'rafaoski',

	// Icon to accompany this module (optional), uses font-awesome icon names, minus the "fa-" part
	'icon' => 'thumbs-up',

	// Indicate any requirements as CSV string or array containing [RequiredModuleName][Operator][Version]
	'requires' => 'ProcessWire>=3.0.164',

	// Should this module load automatically at boot? (default=false). This is good for modules that attach hooks or that need to otherwise load on every single request.
	'autoload' => true,

	// URL to more info: change to your full modules.processwire.com URL (if available), or something else if you prefer
	// 'href' => 'https://processwire.com/modules/process-hello/',

	// name of permission required of users to execute this Process (optional)
	'permission' => 'profilehelper',

	// permissions that you want automatically installed/uninstalled with this module (name => description)
	'permissions' => array(
		'profilehelper' => 'Run the profilehelper module'
	),

	'installs' => [
		'HelperBackup',
		'HelperOembed',
		'HelperMaintenance',
		'HelperFlatFilesBooster'
	],
	// 'autoload' => 10, // high priority to always load base class
	// 'singular' => true,

	// page that you want created to execute this module
	'page' => array(
		'name' => 'profile-helper',
		'parent' => 'setup',
		'title' => 'Profile Helper'
	),

	// optional extra navigation that appears in admin drop down menus
	'nav' => array(
		array(
			'url' => 'manage-logs/',
			'label' => 'Manage Logs',
			'icon' => 'crosshairs',
		),
		array(
			'url' => '',
			'label' => 'Hello',
			'icon' => 'smile-o',
		),
		array(
			'url' => 'something/',
			'label' => 'Something',
			'icon' => 'beer',
		),
		array(
			'url' => 'something-else/',
			'label' => 'Something Else',
			'icon' => 'glass',
		),
		array(
			'url' => 'form/',
			'label' => 'Simple form',
			'icon' => 'building',
		)
	)

	// for more options that you may specify here, see the file: /wire/core/Process.php
	// and the file: /wire/core/Module.php

);
