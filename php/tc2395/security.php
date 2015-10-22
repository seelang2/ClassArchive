<?php
/*
	security.php - basic security
*/

// process logout
if (isset($_GET['logout'])) {
	// delete session user variables
	unset($_SESSION['userid']);
	unset($_SESSION['userpermission']);
	// redirect to login page
	$_SESSION['flashmsg'] = 'You have been logged out.'; // set flash message
	header('Location: ' . SITE_URL . 'login.php');
	exit();
}
//is page secured?
if (!empty($page_permission)) {
	
	// is user logged in?
	if (empty($_SESSION['userid'])) {
		// user is not logged on
		
		// is login form data present?
		if ( (!empty($_POST['email'])) && (!empty($_POST['password'])) ) {
			// login form submitted, validate user
			$query = "SELECT * FROM users ".
					 " WHERE email = '".escape($_POST['email'])."' AND password = '".escape($_POST['password'])."' LIMIT 1";
			
			$result = @mysql_query($query);
			// did we find the user?
			if (!$result || mysql_num_rows($result) != 1) {
				// did not find a matching record - send back to login form with an error message
				$_SESSION['flashmsg'] = 'Invalid user or password.'; // set flash message
				$_SESSION['flashdata'] = $_SERVER['REQUEST_URI']; // set temp data to current page
				header('Location: ' . SITE_URL . 'login.php');
				exit();
			} else {
				// found user, store credentials
				$user = mysql_fetch_array($result);
				$_SESSION['userid'] = $user['id'];
				$_SESSION['userpermission'] = $user['permissions'];
			}
		} else {
			// send user to login page to log in
			$_SESSION['flashdata'] = $_SERVER['PHP_SELF']; // set temp data to current page
			header('Location: ' . SITE_URL . 'login.php');
			exit();
		}
		
	}
	
	// does the user have permission to view the page?
	if ($_SESSION['userpermission'] < $page_permission) {
		// user permission not high enough
		header('Location: ' . SITE_URL . 'noaccess.php');
		exit();
	}

}



