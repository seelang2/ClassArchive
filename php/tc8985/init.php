<?php
/**
 *	init.php - app startup
 */

require('config.php');
require('inc-lib.php');

// connect to database server and select database
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// check if connected
if ($db->connect_error) {
	exit('<p>Error: Unable to connect to database. </p>');
}

// get operation parameter from URI
if (empty($_GET['action'])) {
	$action = 'LIST';
} else { 
	$action = strtoupper($_GET['action']);
}

if (empty($_GET['id'])) {
	unset($id); // make sure $id doesn't exist
} else {
	// sanitize id to make it safe for use in queries
	$id = $db->real_escape_string($_GET['id']);
}

