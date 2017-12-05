<?php
// inc_post.php - Save new record to collection

/*

// debugging device
$data = array();
$data['server'] = $_SERVER;
$data['get'] = $_GET;
$data['post'] = $_POST;

echo json_encode($data);
*/

// determine table to add record into 
switch($pattern) {
	case 'C':
		$table = $requestArray[0];
	break;
	
	case 'CIC':
		$table = $requestArray[2];
	break;
}

// POST request create new records 
// ALWAYS REMEMBER TO SANITIZE YOUR DATA!
$query = "INSERT INTO {$table} SET " .
			"name = ".$db->quote($_POST['name']).", " .
			"capacity = ".$db->quote($_POST['capacity']).", " .
			"location_id = ".$db->quote($_POST['location_id'])." ";

//echo $query;

// send query to server
$results = $db->query($query);

// check response
if ($results === false) {
	// error encountered
	$error = $db->errorInfo();
	
	$response = array(
		'status' => 0,
		'message' => 'Query error ('.$error[0].') near "'.$error[2].'": '. $query
	);
	exit(json_encode($response)); // send data as JSON and terminate
}

// check if insert completed
if ($results->rowCount() != 1) {
	$response = array(
		'status' => 0,
		'message' => 'The record was not saved.'
	);
	exit(json_encode($response)); // send data as JSON and terminate
}

// save successful, provide feedback

	$response = array(
		'status' => 1,
		'message' => 'The record was saved.',
		'lastInsertId' => $db->lastInsertId()
	);
	exit(json_encode($response)); // send data as JSON and terminate

