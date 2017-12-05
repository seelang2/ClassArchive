<?php
/*
	tkt-config.php - basic application configuration
*/

// database access parameters
define('DB_HOST','localhost');
define('DB_NAME','demo1');
define('DB_USER','root');
define('DB_PASSWD','portable');

// template configuration
define('TEMPLATE_HEADER', 'tkt-header.php');
define('TEMPLATE_FOOTER', 'tkt-footer.php');

// load libraries and modules
require_once "functions.php";

// other common system-wide variables
$me = $_SERVER['PHP_SELF'];

if (!$dbcnx = db_connect(DB_HOST, DB_NAME, DB_USER, DB_PASSWD)) exit("<p>Error connecting to or selecting database.</p>");

?>