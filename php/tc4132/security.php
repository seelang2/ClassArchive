<?php
/*
	security.php - page security and login control
*/

if (isset($_GET['logout'])) {
	// handle log out
	//unset($_SESSION['userid']);
	//unset($_SESSION['username']);
	$_SESSION = array();
	$_SESSION['flashdata']['text'] = 'You have been logged out.'; // set flash data for next pageload
	header('Location: http://localhost/tc4132/login.php');
	exit(); // ALWAYS EXIT AFTER A REDIRECT!
}

// is page secure?
if ($pagesecured) {
	// is user logged in?
	if (empty($_SESSION['userid'])) { // if no userid stored
		if (empty($_POST['login']) || empty($_POST['password'])) { // is login form data present?
			// NO - redirect to login form
			$_SESSION['flashdata']['fromurl'] = $_SERVER['PHP_SELF'];
			$_SESSION['flashdata']['text'] = 'Please log in to continue.'; // set flash data for next pageload
			header('Location: http://localhost/tc4132/login.php');
			exit(); // ALWAYS EXIT AFTER A REDIRECT!
		} else {
			// is login data valid?
			$query = "SELECT id, firstname FROM users WHERE " .
					 "login = '".mysql_escape_string($_POST['login'])."' " .
					 "AND password = '".sha1(mysql_escape_string($_POST['password']).$securitySalt)."' " .
					 "AND status = 1 LIMIT 1";
			
			$result = @mysql_query($query);
			if (!$result || mysql_num_rows($result) != 1) {
				// NO - set error message and redirect to login form
				$_SESSION['flashdata']['text'] = 'Login or password is incorrect.'; // set flash data for next pageload
				$_SESSION['flashdata']['fromurl'] = $_SERVER['PHP_SELF'];
				header('Location: http://localhost/tc4132/login.php');
				exit(); // ALWAYS EXIT AFTER A REDIRECT!
			}
			// Data valid - store user credentials
			$user = mysql_fetch_array($result);
			$_SESSION['userid'] = $user['id'];
			$_SESSION['username'] = $user['firstname'];
			
		} // if login form data present
	}
	
	// does user have access to this page?
		// NO - send to 'no access' page
	
} // if pagesecured

