<?php namespace ProcessWire;

/**
 * Block users with the "login-register" role from accessing the admin area.
 * If a user with this role is logged in, they will be logged out and redirected.
 */

if(user()->isLoggedin() && user()->hasRole('login-register')) {
    session()->logout();
    _flashMessage()->error(_t('notPremissions'), _home()->httpUrl);
}

/** @var Config $config */
require($config->paths->core . "admin.php");
