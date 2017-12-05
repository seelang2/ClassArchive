<?php
/*
	config.php - configuration settings
*/


// Database parameters
@define('DB_NAME', 'tc1612');
@define('DB_USER', 'root');
@define('DB_PASSWD', 'xampp');
@define('DB_HOST', 'localhost');

@define('TEMPLATE_PATH', $_SERVER['DOCUMENT_ROOT'] . 'tc1612/');

//////////////// DO NOT MODIFY BELOW THIS LINE ////////////////

// load libraries
require_once('functions.php');


// connect to database server
$dbcnx = @mysql_connect(DB_HOST, DB_USER, DB_PASSWD);
if (!$dbcnx) {
	exit('Error: unable to connect to database server.');
}

//select database
$dbh = @mysql_select_db(DB_NAME, $dbcnx);
if (!$dbh) exit('Error: unable to select database.');



?>