<?php
/*
	init.php
*/

require('inc_functions.php');
require('database.php');

if (empty($_GET['action'])) {
	$action = 'LIST'; // set default action
} else {
	$action = strtoupper($_GET['action']);
}

$self = $_SERVER['PHP_SELF'];

