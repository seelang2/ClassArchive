<?php
// config.php - configuration file

// USER CONFIGURATION SECTION
@define('DBNAME', 'tc854');
@define('DBUSER', 'root');
@define('DBPASSWORD', 'portable');

$inventoryTypes = array(
	'Please Select a Type',
	'Air Conditioners',
	'Heaters',
	'Air Exchangers',
	'Boilers',
	'Baseboards'
);


// END USER CONFIGURATION
session_start();

$statusmsg = $_SESSION['statusmsg'];
unset($_SESSION['statusmsg']);

require_once('functions.php');

if (!$dbh = db_connect(DBNAME, DBUSER, DBPASSWORD)) exit('Error connecting to database or server.');


// security handler
if (!$_SESSION['is_logged_in']) {
	// user not logged in
	
	// check for login form data
	if (isset($_POST['butLogin'])) {
		// validate login info
		
		$query = "SELECT id, firstname, lastname, login, password FROM users " . 
				 "WHERE login = '" . mysql_escape_string($_POST['login']) . "'" .
				 "AND password = '" . mysql_escape_string($_POST['password']) . "' LIMIT 1";
				 
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// query error or invalid login or password
			$_SESSION['statusmsg'] = 'Invalid login or password';
			
			// redirect to login page
			header('Location: http://localhost/login.php');
			exit();
		} else {
			// good login, store info
			$userinfo = mysql_fetch_array($result);
			
			$_SESSION['is_logged_in'] = true;
			$_SESSION['userid'] = $userinfo['id'];
			$_SESSION['username'] = $userinfo['firstname'] . ' ' . $userinfo['lastname'];
			
		} // if $result
	
	} else {
		if ($_SERVER['PHP_SELF'] != '/login.php') {
			// redirect to login page
			header('Location: http://localhost/login.php');
			exit();
		}
	} // if butLogin


} // if !is_logged_in

// handle logout request
if (isset($_GET['logout'])) {
	// unset session vars
	unset($_SESSION['is_logged_in']);
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	
	$_SESSION['statusmsg'] = 'You have been logged out.';
	header('Location: http://localhost/login.php');
	exit();

}


?>