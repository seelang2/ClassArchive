<?php

// initialize sessions
session_start();

@define('SITE_URL', 'http://localhost/tc2395/');

// define permission array
$PERMISSION_CODES = array(
	'1' => 'Regular User',
	'2' => 'Author',
	'3' => 'Editor',
	'9' => 'Administrator'
);

require_once('functions.php');

// connect to database server
$dbcnx = @mysql_connect('localhost', 'root', 'xampp');
if (!$dbcnx) exit('Error connecting to database server.');

// select database
$dbh = @mysql_select_db('tc2395', $dbcnx);
if (!$dbh) exit('Error selecting database.');
 
// retrieve flash content
if (!empty($_SESSION['flashmsg'])) {
	$flashmsg = $_SESSION['flashmsg'];
	unset($_SESSION['flashmsg']);
} else unset($flashmsg);

if (!empty($_SESSION['flashdata'])) {
	$flashdata = $_SESSION['flashdata'];
	unset($_SESSION['flashdata']);
} else unset($flashdata);

require_once('security.php');
