<?php
/***
 * startup.php - Application initialization
 *
 * The purpose of this file is to implement the simple login security
 * system. In production this would also do other tasks like connect to the
 * database, load classes, and so on.
 */

session_start(); // initialize session

// include support files
require('functions.php');

// how do we know a page is protected?
// store secured page names in an array - if it's not on the list it's
// considered open
$securedPages = [
	'entertainment.php',
	'international.php',
	'local.php'
];

// some user data
$users = [
	'jdoe' => 'obvious'
];

//echo dumpvar($_SESSION);

// retrieve flash message info
if (!empty($_SESSION['flash'])) {
	$flashMessages = $_SESSION['flash']; // get messages from session
	$_SESSION['flash'] = []; // delete flash from session
} else {
	$flashMessages = null;
}


// login security process

// is page open?
$pageName = basename($_SERVER['PHP_SELF']);
if (in_array($pageName, $securedPages)) {
	// is user logged in?
	if (empty($_SESSION['userdata'])) {
		// is login form data present?
		if (empty($_POST['username']) || empty($_POST['password'])) {
			// if not, send to login page
			// use the flash array to store where we came from
			$_SESSION['flash']['redirectFrom'] = $_SERVER['PHP_SELF'];
			header('Location: login.php'); // header redirect
			exit(); // terminate script. ALWAYS ADD THIS AFTER REDIRECT
		}
			// is user valid?
			if ( isset($users[$_POST['username']]) && 
				 $users[$_POST['username']] == $_POST['password'] ) {
				// save credentials (and continue)
				$_SESSION['userdata'] = [
					'username' => $_POST['username']
				];
			} else {
				// if not, set error message and send to login page
				$_SESSION['flash']['errorDisplay'] = 'Username or password is incorrect.';
				header('Location: login.php'); // header redirect
				exit(); // terminate script. ALWAYS ADD THIS AFTER REDIRECT
			}
	}
		// does user have permission to view page?
			// if not, send to 'no access' page
}
// show page



