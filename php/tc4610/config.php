<?php
/****
 * config.php - common initialization file
 *
 **/

session_start(); // initialize session data

//print_r($_SESSION); // for debugging session data

$password_salt = '5baa61e4c2b93f3!f06850b+6cf331b7ee&68fd8';

// basic settings
@define('SITE_URL', 'http://localhost/tc4610'); // note NO trailing slash

// database connectivity
@define('DB_NAME', 'tc4610');
@define('DB_HOST','localhost');
@define('DB_USER','root');
@define('DB_PASSWORD','xampp');

// library includes
require('functions.php');

// connect to database server
$dbLink = db_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$dbLink) exit('Error connecting to database server.');
// select database
if (!@mysql_select_db(DB_NAME, $dbLink)) exit('Error selecting database.');

	
// set up flash data system
if (!empty($_SESSION['flashdata'])) {
	$flashdata = $_SESSION['flashdata'];
	unset($_SESSION['flashdata']);
}

require('security.php');

