<?php
/*
	config.php
*/

// initialize sessions
session_start();

// retrieve flash vars
if (!empty($_SESSION['flashData'])) {
	$flashData = $_SESSION['flashData'];
	unset($_SESSION['flashData']);
}
if (!empty($_SESSION['flashMsg'])) {
	$flashMsg = $_SESSION['flashMsg'];
	unset($_SESSION['flashMsg']);
}

// load library files
require_once('functions.php');


// connect to db server
$dbLink = @mysql_connect('127.0.0.1', 'root', 'a9e1fd');
if (!$dbLink) exit('Error connecting to database server.');

// select database
$dbh = @mysql_select_db('tc2514');
if (!$dbh) exit('Error selecting database.');


// load page security
include_once('security.php');

?>