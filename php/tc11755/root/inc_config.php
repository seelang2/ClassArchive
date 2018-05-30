<?php
/**
 * inc_config.php
 * Put all project-specific configuration code here
 *
 * The difference between inc_config.php and inc_bootstrap.php is that
 * config runs BEFORE the database connection is established, while 
 * bootstrap runs AFTER the database connection is established.
 */


// database connection
@define('DB_HOST', 'localhost');
@define('DB_NAME', 'tc11755');
@define('DB_USER', 'root');
@define('DB_PASSWORD', '');

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

// user type
Config::set('content_type', [
	'0' 	=> 'Type I',
	'1' 	=> 'Type II'
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
	'2' 	=> 'Event Coordinator',
	'255'	=> 'System Administrator'
]);

// Event enumerations
Config::set('event_type', [
	'0' 	=> 'Public',
	'1' 	=> 'Private'
]);

/* 
	Bitmask flags are tied to the decimal equivalent
	of their appropriate bit
*/
Config::set('event_status', [
	'1' 	=> 'Active',
	'2' 	=> 'Published',
	'4' 	=> 'Confirmed'
]);

// Location enumerations
Config::set('location_type', [
	'0' 	=> 'Office',
	'1' 	=> 'Venue'
]);



