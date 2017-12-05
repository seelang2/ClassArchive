<?php
// config.php - app configuration data

// Database settings
define('DB_DSN', 'mysql:dbname=tc8984;host=localhost');
define('DB_USER', 'root');
define('DB_PASSWD', 'xampp');

// Table schema
$schema = array(
	'facilities' => array(
		'labels' => array('ID', 'Site ID', 'Short Name', 'Long Name'),
		'fields' => array('id', 'site_id', 'short_name', 'long_name')
	),
	'users' => array(
		'labels' => array('ID', 'Login', 'Password', 'Permissions'),
		'fields' => array('id', 'login', 'password', 'permissions')
	)
);

/*
	Ticket status:
	0 - archived
	1 - open, not assigned to tech
	2 - assigned to tech
	3 - confirmed by originator
	4 - closed by ops
*/

// Enumeration lists
$enum = array(
	'ticket_status' => array(
		'Archived',
		'Unassigned',
		'Assigned',
		'Confirmed',
		'Closed'
	)
);





?>