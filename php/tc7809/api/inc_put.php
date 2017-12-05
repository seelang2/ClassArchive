<?php

/*
// debugging device
$data = array();
$data['server'] = $_SERVER;
$data['get'] = $_GET;
$data['post'] = $_POST;
$data['request'] = $REQUEST;

echo json_encode($data);
*/

// determine table to add record into 
switch($pattern) {
	case 'C':
		$table = $requestArray[0];
		unset($id);
	break;
	
	case 'CIC':
		$table = $requestArray[2];
		$id = $requestArray[1];
	break;
}

// POST request create new records 
// ALWAYS REMEMBER TO SANITIZE YOUR DATA!
$query = "UPDATE {$table} SET ";
// loop through form fields
foreach ($REQUEST as $column => $value) {
	$query .= $db->quote($column) . ' = ' . $db->quote($value);
}
if (isset($id) $query .= " WHERE id = ".$db->quote($_POST['name']);

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

