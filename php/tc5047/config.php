<?php
// config.php - basic setup

// database settings
@define('DB_HOST','localhost');
@define('DB_USER','root');
@define('DB_PASSWORD','xampp');
@define('DB_NAME','tc5047');

// define permissions list
$permissionList = array(
	'1' => 'Subscriber',
	'2' => 'Author',
	'3' => 'Editor',
	'255' => 'Administrator'
);


require('functions.php');

session_start(); // initialize session


// connect to database server
$dbLink = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$dbLink) exit('Error connecting to database server.');

// select database
if (!@mysql_select_db(DB_NAME)) exit('Error selecting database.');






?>