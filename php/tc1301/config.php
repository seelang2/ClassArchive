<?php
/*
	config.php - configuration file
*/

// active session support
session_start();

require_once('functions.php');

////////// USER CONFIGURATION SECTION ///////////////

// database parameters
@define('DB_NAME', 'tc1301');
@define('DB_USER', 'root');
@define('DB_PASSWORD', 'portable');


// contact types
$contact_types = array(
	'1' => 'Employee',
	'2' => 'Customer',
	'3' => 'Vendor'
);

// address types
$address_types = array(
	'1' => 'Home',
	'2' => 'Work',
	'3' => 'Billing'
);

// get status message
if (!empty($_SESSION['statusmsg'])) {
	$statusmsg = $_SESSION['statusmsg'];
	unset($_SESSION['statusmsg']);
}

//include('c:/pwa/passwords.php');

//////////// DO NOT MODIFY BELOW THIS LINE /////////////

$dbh = db_connect(DB_NAME, DB_USER, DB_PASSWORD);
if (!$dbh) exit('Error connecting to database or server.');


/*
// connect to database server
$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) exit('Error connecting to database server.');

// select database
$dbh = @mysql_select_db('tc1301', $dbcnx);

if (!$dbh) exit('Error selecting database.');
*/

// run security module
include_once('security.php');




?>