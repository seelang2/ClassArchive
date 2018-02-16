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
@define('DB_NAME', 'tc11583');
@define('DB_USER', 'dbuser');
@define('DB_PASSWORD', 'password');

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



// content enumerations
Config::set('content_type', [
	'0' 	=> 'Unused',
	'1' 	=> 'Image',
	'2' 	=> 'PDF',
	'3' 	=> 'Text file'
]);

Config::set('content_status', [
	'0' 	=> 'Inactive',
	'1' 	=> 'Pending Approval',
	'2' 	=> 'Approved',
	'3' 	=> 'Rejected'
]);



