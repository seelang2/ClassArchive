<?php

session_start(); // initialize sessions

// system config constants
@define('DS', DIRECTORY_SEPARATOR);

// database connection
@define('DB_HOST', 'localhost');
@define('DB_NAME', 'tc11583');
@define('DB_USER', 'dbuser');
@define('DB_PASSWORD', 'password');


// system includes
require_once('inc_functions.php');
require_once('database.php');
require_once('inc_baseclasses.php');
require_once('content_controller.php');
require_once('users_controller.php');

// user data definitions
/*

status
0 - inactive
1 - active
*/
Config::set('users_status', [
	'Inactive',
	'Active'
]);

/*
permissions
0 		- no access
1 		- upload content & view own content
2 		- can view all content
3 		- can approve content
255 	- superuser

We store this as an associative array instead of a numeric array 
because the key values aren't necessarily consecutive, as for sysadmin
*/
Config::set('users_permissions', [
	'0' 	=> 'No Access',
	'1' 	=> 'Basic User',
	'2' 	=> 'Privileged User',
	'3' 	=> 'Approver',
	'255'	=> 'System Administrator'
]);

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









