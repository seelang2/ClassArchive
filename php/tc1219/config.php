<?php
/*
	config.php - configuration file
*/
session_start(); // activate sessions

require_once('functions.php');

//////// USER CONFIGURATION ////////

@define('DB_NAME', 'tc1219');
@define('DB_USER', 'root');
@define('DB_PASSWORD', 'portable');

// configuration parameters
@define('USERTYPE_CUSTOMER', 1);
@define('USERTYPE_USER', 10);
@define('USERTYPE_ADMIN', 100);


/////// END USER CONFIGURATION - DO NOT MODIFY BELOW THIS LINE /////////

// user type array
$usertypes = array(
	'Customer' 	=> USERTYPE_CUSTOMER,
	'User' 		=> USERTYPE_USER,
	'Admin' 	=> USERTYPE_ADMIN
);


if (!$db = db_connect(DB_NAME, DB_USER, DB_PASSWORD)) exit('Error connecting to db server or database');

// security system

// check for user logged in or the page is unlocked
if (!$_SESSION['logged_in'] && !$page_unsecured) {
	
	// check for login form data submitted
	if (!empty($_POST['loginSubmit'])) {
		// login form present, validate login credentials
		$query = "SELECT id, name, type FROM users " .
				 " WHERE login = '". escape($_POST['login']) ."'" .
				 " AND pwd = '". escape($_POST['pwd']) ."' LIMIT 1";
		
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// login credentials invalid, create error message
			$_SESSION['message'] = 'The login or password is invalid. ';
			
			// redirect to login page
			header('Location: http://localhost/login.php');
			exit;
		} else {
			// login good - save data to session
			$_SESSION['logged_in'] = true;
			
			// save user data to session
			$_SESSION['userdata'] = mysql_fetch_array($result);
			
		} // if result
	} else {
		// redirect to login page
		header('Location: http://localhost/login.php');
		exit;
	} // if login form data
} // if logged in

// handle logout
if (!empty($_GET['logout'])) {
	// log user out of system
	
	// erase session variables
	foreach($_SESSION as $key => $value) {
		unset($_SESSION[$key]);
	}
	
	// set flash message stating logout
	$_SESSION['message'] = 'You have been logged out of the system. ';
	
	// redirect to login page
	header('Location: http://localhost/login.php');
	exit;
}

// flash message handler
if (!empty($_SESSION['message'])) {
	$flashmessage = $_SESSION['message'];
	unset($_SESSION['message']);
}





?>