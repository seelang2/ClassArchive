<?php
/*
	config.php - general configuration
*/

@define('DBNAME', 'tc708');
@define('DBUSER', 'root');
@define('DBPASSWORD', 'portable');

$me = $_SERVER['PHP_SELF'];

// define additional constants - types
@define('PROFILE_BIO', 1);
@define('PROFILE_INTERESTS', 2);
@define('PEOFILE_ACTIVITIES', 3);
@define('PROFILE_MUSIC', 4);

// include any additional required files
require 'functions.php';

if (!$dbh = db_connect(DBNAME, DBUSER, DBPASSWORD)) {
	die("Error connecting to database or server.");
}

session_start();

if (!$_SESSION['loggedin'] && $me != '/login.php') {
	// user is not logged in, redirect to login page
	
	// set return page
	$_SESSION['from'] = $me;
	
	header('Location: /login.php');
	exit;

}

if ($_GET['mode'] == 'logout') {
	$_SESSION['loggedin'] = false;
	unset($_SESSION['loggedin']);
	header('Location: /login.php');
	exit;
}

?>