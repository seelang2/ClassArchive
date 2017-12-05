<?php
/*
	config.php - simple configuration file
*/

// User parameters
@define('DB_NAME','class472');
@define('DB_USER','root');
@define('DB_PASSWORD','portable');


// include function library
require_once('functions.php');


$me = $_SERVER['PHP_SELF'];

$db = db_connect(DB_USER, DB_PASSWORD, DB_NAME);
if (!$db) die('Error connecting to database or server');


if ($_GET['action'] == 'logout') {
	$_SESSION['loggedin'] = false;
	unset($_SESSION['loggedin']);
	header('Location: /login.php');
	exit;
}

?>