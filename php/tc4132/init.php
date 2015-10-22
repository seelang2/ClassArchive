<?php
/*
	init.php - system initialization
*/

session_start(); // initialize sessions

// check for session flash data
if (isset($_SESSION['flashdata'])) {
	$flashdata = $_SESSION['flashdata'];
	unset($_SESSION['flashdata']);
} else {
	$flashdata = null;
}

// status code descriptions
$userStatus = array('Inactive', 'Active');

// security salt phrase
$securitySalt = 'Some random phrase';

// connect to db server
$dbLink = @mysql_connect('localhost','root','xampp');
if (!$dbLink) exit('Error connecting to database.');

// select database
if (!@mysql_select_db('tc4132')) exit('Error selecting database.');


include('security.php');
