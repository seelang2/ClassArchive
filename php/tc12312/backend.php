<?php
/**
 * Simple application back end
 * 
 * Query string parameters:
 * module 		- client | fund
 * action 		- view | save | delete
 * id 				- (optional) record id
 *
 * Response schema (JSON):
 * {
 *		"status": 		Response status. Ok or Error
 * 		"statusmsg": 	Optional. Description of status
 * 		"data": 			Optional. Result set
 * }
 */
require('init.php');

//output(['status' => 'Ok']);

// retrieve application parameters
if (!empty($_GET['module'])) 
	$module = strtolower($_GET['module']);
else 
	unset($module);

if (!empty($_GET['action'])) 
	$action = strtolower($_GET['action']);
else 
	unset($action);

if (!empty($_GET['id'])) 
	$id = strtolower($_GET['id']);
else 
	unset($id);

// bail if required parameters are not specified
if (empty($module))
	output(['status' => 'Error', 'statusmsg' => 'Module not specified']);

if (empty($action))
	output(['status' => 'Error', 'statusmsg' => 'Action not specified']);

// module control
switch($module) {
	case 'client':
		require('backend_mod_client.php');
	break;
	case 'fund':
		require('backend_mod_fund.php');
	break;
	default:
		output(['status' => 'Error', 'statusmsg' => 'Invalid module']);
	break;
}
