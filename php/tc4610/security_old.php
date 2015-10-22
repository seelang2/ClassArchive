<?php
/****
 * security.php - basic access restriction system
 **/

// security routine - logged in users only

// check to see if user is logging out
if (isset($_GET['logout'])) {
	$_SESSION = array(); // destroy session data
	session_regenerate_id(); // create new session id
	header('Location: ' . SITE_URL . '/home.php');
	exit(); // ALWAYS CALL EXIT AFTER A HEADER REDIRECT!
}

if (empty($page_permission)) $page_permission = 0; // set page permission level
if ($page_permission > 0) { // is this page secured?
	// is user logged in?
	if (empty($_SESSION['userdata'])) {
		// user not logged in
		if (empty($_POST['loginemail']) || empty($_POST['loginpassword'])) { // is login form data present?
			// send to login page
			$_SESSION['flashdata'] = array('from' => $_SERVER['PHP_SELF'], 'message' => 'You must be logged in to continue.');
			header('Location: ' . SITE_URL . '/login.php');
			exit(); // ALWAYS CALL EXIT AFTER A HEADER REDIRECT!
		} else { 
			// yes, form data is present
			// is login form data valid?
			$password = sha1($_POST['loginpassword'] . $password_salt); // hash the password using sha1
			// build query
			$query = "SELECT id, fullname, permission FROM users " .
					 "WHERE email = '".escape($_POST['loginemail'])."' AND password = '".$password."' LIMIT 1";
			
			$result = @mysql_query($query); // send query to server
			if (!$result || mysql_num_rows($result) != 1) {
				// user not found or query error - set error message and send back to login page
				$_SESSION['flashdata'] = array('from' => $_SERVER['PHP_SELF'], 'message' => 'User or password invalid.');
				header('Location: ' . SITE_URL . '/login.php');
				exit(); // ALWAYS CALL EXIT AFTER A HEADER REDIRECT!
			}
			// user valid, store credentials
			$_SESSION['userdata'] = mysql_fetch_array($result, MYSQL_ASSOC);
		} // if login form data present
	} // if logged in
} // if page secured

// does user have permission to view this page?
if ($_SESSION['userdata']['permission'] < $page_permission) {
	// user doesn't have permission to view this page
	header('Location: ' . SITE_URL . '/noaccess.php');
	exit(); // ALWAYS CALL EXIT AFTER A HEADER REDIRECT!
}
