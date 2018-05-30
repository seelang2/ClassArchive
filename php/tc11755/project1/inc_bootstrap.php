<?php
/**
 * inc_bootstrap.php
 *
 * Put all project-specific implementation and bootstrap code here
 *
 * The difference between inc_config.php and inc_bootstrap.php is that
 * config runs BEFORE the database connection is established, while 
 * bootstrap runs AFTER the database connection is established.
 */


// project-specific classes (controllers, etc.)
require_once('content_controller.php');
require_once('users_controller.php');

// set up Auth database stuff
Auth::setDB($db, [
	'loginPOST' 			=> 'login',			// $_POST key containing login value
	'loginField' 			=> 'login',			// database column containing login value
	'passwordPOST' 		=> 'password',	// $_POST key containing password value
	'passwordField' 	=> 'password',	// database column containing password value
	'loginTable' 			=> 'users'			// database table name
]);

// configure authentication parameters
Auth::setLoginURL('users/login');
Auth::setLogoutURL('users/logout');

// add ACL entries
Auth::addACLEntry('content.view', 1);
Auth::addACLEntry('content.add', 1);
Auth::addACLEntry('users.view', 255);
Auth::addACLEntry('users.edit', 255);

