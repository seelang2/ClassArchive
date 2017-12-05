<?php
/*
	config.php - general configuration file
*/


// database configuration
@define('DB_HOST', 'localhost');
@define('DB_USER', 'root');
@define('DB_PASSWORD', 'xampp');
@define('DB_NAME', 'tc1706');



//////////////// DO NOT MODIFY BELOW THIS LINE ////////////////////

// start session
session_start();

// include additional libraries
require_once('functions.php');

$dbcnx = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if (!$dbcnx) {
	header('Location: http://localhost/tc1706/dberror.php');
	exit();
}

$dbh = @mysql_select_db(DB_NAME);
if (!$dbh) {
	header('Location: http://localhost/tc1706/dberror.php');
	exit();
}

// get parameters from query string
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']); else $action = 'LIST';
if (!empty($_GET['id'])) $id = escape($_GET['id']); else unset($id);


?>