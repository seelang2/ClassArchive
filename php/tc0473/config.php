<?php
/*
	config.php - simple application configuration file
*/

// file includes
require_once 'functions.php';

define('DB_NAME', 'tc473');
define('DB_USER', 'root');
define('DB_PASSWORD', 'portable');


$me = $_SERVER['PHP_SELF'];

// Template parameters
$showDefaultSubMenu = true;		// display CRUD submenu by default


// connect to database
if (!$dbh = db_connect(DB_NAME, DB_USER, DB_PASSWORD)) die('Error connecting to database or database server.');


?>