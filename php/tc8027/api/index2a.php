<?php
// init app
require_once('init.php');
require_once('function.php');

// retrieve request parameters
$model = empty($_GET['model']) ? null : strtolower($_GET['model']);
$action = empty($_GET['action']) ? null : strtolower($_GET['action']);
$id = empty($_GET['id']) ? null : $_GET['id'];

// variable variable names. (yeah, I know...)
$x = 'fnName';
$$x = 'get';





switch($model) {

	case 'schools':
		
		switch($action) {
			case 'get':
				// set up response array
				$response = array();
				// get data
				$data = $fnName($dbh, $model);
				if ($data === false) {
					// no data, request failed
					$response['status'] = 0; 
					$response['statusmessage'] = 'There was a query error';
				} else {
					$response['status'] = 1; 
					$response['statusmessage'] = 'Ok';
					$response['data'] = $data;
				}
				
				// JSONify the response
				echo json_encode($response);
				
			break;
			default:
				// return error issue
				echo '{"status":0,"statusmessage":"Invalid action"}';
			break;
		} // switch $action
		
	break;
	
	case 'alumni':
		
		switch($action) {
			case 'get':
				
				
			break;
		} // switch $action
	
	break;

	default:
		// return error issue
		echo '{"status":0,"statusmessage":"Invalid parameters"}';
	break;
	// etc.

} // switch $model


