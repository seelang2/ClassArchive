<?php
/*****
	init.php - Application initialization file
 **/
 
 
// define some basic config parameters
define('API_BASE_PATH', '/tc7809/api/');

// load additional modules
require('lib.php');
require('schema.php');

// read request data from standard input into a variable
// ref: http://www.lornajane.net/posts/2008/accessing-incoming-put-data-from-php
parse_str(file_get_contents("php://input"),$REQUEST);



// get link to database
try {
	$db = new PDO('mysql:dbname=bookings;host=localhost', 'root', 'xampp');
} catch(PDOException $e) {
	//exit('<p>Database error. No soup for you! *snap*</p>');
	// we're in an API. everything is data.
	$response = array(
		'status' => 0,
		'message' => 'Database error. No soup for you! *snap*'
	);
	exit(json_encode($response)); // send data as JSON and terminate
}

// set content type header to json
header('Content-Type: application/json');

