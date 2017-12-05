<?php
// init app
require_once('init.php');
require_once('function.php');

// retrieve request parameters
$model = empty($_GET['model']) ? null : strtolower($_GET['model']);
$action = empty($_GET['action']) ? null : strtolower($_GET['action']);
$id = empty($_GET['id']) ? null : $_GET['id'];


// model = schools and action = get => schools_get
$methodName = $model . '_' . $action;
// see if a custom function has been defined for this method name

if (function_exists($methodName)) {
	$fnName = $methodName;
} else {
	$fnName = $action;
}

// set up response array
$response = array();
// get data
if ($action == 'save') {
	if (empty($_POST)) {
		exit('{"status":0,"statusmessage":"No data present to save"}');
	}
	// send POST data to handler function
	$data = $fnName($dbh, $model, $_POST);
} else {
	$data = $fnName($dbh, $model);
}
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


