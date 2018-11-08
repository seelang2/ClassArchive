<?php
/**
 * database connectivity
 */

// connect to db server and select db
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($db->connect_error) {
	//exit('<strong>Error:</strong> Unable to connect to database server.<br />Error: '.$db->connect_error);

	// redirect to error page
	header('Location: errorpage.php');
	exit(); // ALWAYS explicitly call exit() after redirect
}

