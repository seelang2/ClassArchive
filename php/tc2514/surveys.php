<?php
// set permission flag
$page_security = 9;

require_once('config.php');
include('header.php');

$action = 'LIST'; // set a default action
if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']); }
if (!empty($_GET['sid'])) { $sid = escape($_GET['sid']); } else { unset($sid); }

switch($action) {
	case 'LIST': // list surveys
		require('inc_surveys_list.php');
	break; // LIST
	case 'NEW': // new survey
		require('inc_surveys_list.php');
	break; // NEW
	case 'PROCESS': // process 
} // switch action


include('footer.php');
?>