<?php
// config.php - basic configuration file

// database constants
define('DB_USERNAME','root');
define('DB_PASSWORD','portable');
define('DB_NAME','php319');
define('DB_HOST','localhost');

$me = $_SERVER['PHP_SELF'];


include("functions.php");



// initialize database
$dbh = db_connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
if (!$dbh) exit('Error connecting to database server or selecting database');


//start the session handler
session_start();

?>