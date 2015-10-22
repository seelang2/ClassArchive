<?php
/*
	security.php - simple security
*/

// check for logout
if (isset($_GET['logout'])) {
	// clear all session data
	$_SESSION = array();
	$_SESSION['flashMsg'] = 'You are now logged out.';
	redirect('http://localhost/tc2514/login.php');
}

// is page secure?
if (!empty($page_security)) {
	// is user logged in?
	if ($_SESSION['user_logged_in']) {
		// does user have permission to access page?
		if ($_SESSION['user_permissions'] < $page_security) {
			// user does NOT have access, send to noaccess page
			redirect('http://localhost/tc2514/noaccess.php');
		}
	} else {
		// is login data present?
		if ((!empty($_POST['email'])) && (!empty($_POST['password'])) ) {
			// validate login data
			$query = 'SELECT id, firstname, permissions FROM users ' .
					 "WHERE email = '".escape($_POST['email']).
					 "' AND password = '".escape($_POST['password'])."' LIMIT 1";
			
			$result = @mysql_query($query);
			// is user valid?
			if (!$result || mysql_num_rows($result) != 1) {
				// set message & send to login page
				$_SESSION['flashMsg'] = 'Invalid user or password.';
				$_SESSION['flashData'] = $_SERVER['REQUEST_URI']]; // using REQUEST_URI instead of PHP_SELF will include query string
				redirect('http://localhost/tc2514/login.php');
			} else {
				// store login credentials
				$data = mysql_fetch_array($result);
				$_SESSION['user_id'] = $data['id'];
				$_SESSION['user_logged_in'] = true;
				$_SESSION['user_permissions'] = $data['permissions'];
				$_SESSION['user_name'] = $data['firstname'];
				// does user have permission to access page?
				if ($_SESSION['user_permissions'] < $page_security) {
					// user does NOT have access, send to noaccess page
					redirect('http://localhost/tc2514/noaccess.php');
				}
			}
		} else {
			// set flash data to current page
			$_SESSION['flashData'] = $_SERVER['REQUEST_URI']; // using REQUEST_URI instead of PHP_SELF will include query string
			// send to login page
			redirect('http://localhost/tc2514/login.php');
		}
	}
} // if page secure






?>