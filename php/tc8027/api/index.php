<?php
// init app
require_once('init.php');
//require_once('function.php');
require_once('classes.php');

// retrieve request parameters
$model = empty($_GET['model']) ? null : strtolower($_GET['model']);
$action = empty($_GET['action']) ? null : strtolower($_GET['action']);
$id = empty($_GET['id']) ? null : $_GET['id'];


//$dataModel = new Model($dbh, $model);

// create an instance of whatever model class is needed
$dataModel = new $model($dbh);

// set up response array
$response = array();

$data = $dataModel->$action();

if ($data === false) {
	// no data, request failed
	$response['status'] = 0; 
	$response['statusmessage'] = 'There was a query error';
} else {
	$response['status'] = 1; 
	$response['statusmessage'] = 'Ok';
	// if data is boolean true there's no data to include
	if ($data !== true) $response['data'] = $data;
}

// JSONify the response
echo json_encode($response);


