<?php namespace ProcessWire;

if(!defined("PROCESSWIRE")) die();

/** @var ProcessWire $wire */

// include site setings
include_once('_site-settings.php');

// include all Hooks
$hooks = files()->find(paths()->site . '/hooks');
foreach ($hooks as $hook) {
   require_once($hook);
}

// Hooks for admin area
if(_isAdmin()){
    include_once('_hooks-admin.php');
    return '';
}

// Hooks For front site
include_once('_hooks-site.php');
