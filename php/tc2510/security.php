<?php
// security.php - authentication stuff

if (!empty($_GET['logout'])) {
	$user->logout();
	// redirect to login page
	header('Location: http://localhost/tc2510/login.php');
	exit(); // ALWAYS EXIT AFTER A REDIRECT!
}

// if page is secured
if (!empty($pagesecurity)) {
	// check to see if user's session has expired
	// based on http://www.daniweb.com/forums/thread124500.htm
	if ($user->logged_in()) {
		// check for session timeout
		$session_timeout = 120; // time in seconds until session expires
		if(isset($_SESSION['starttimer'])) {
			$session_life = time() - $_SESSION['starttimer'];
			if($session_life > $session_timeout){
				// set error message
				$_SESSION['flashmessage'] = 'Your session has timed out.';
				// redirect to login page
				header('Location: http://localhost/tc2510/login.php');
				exit(); // ALWAYS EXIT AFTER A REDIRECT!
			}
		}
		$_SESSION['starttimer'] = time();
	}
	// if user logged in
	if (!$user->logged_in()) {
		// has the login form been posted?
		if( (!empty($_POST['login'])) && (!empty($_POST['password'])) ) {
			// is the user NOT authenticated?
			if ($user->authenticate($_POST['login'], $_POST['password']) == false) {
				// set error message
				$_SESSION['flashmessage'] = 'Invalid login or password.';
				// set return url
				$_SESSION['flashdata'] = $_SERVER['PHP_SELF'];
				// redirect to login page
				header('Location: http://localhost/tc2510/login.php');
				exit(); // ALWAYS EXIT AFTER A REDIRECT!
			}
		} else {
			$_SESSION['flashdata'] = $_SERVER['PHP_SELF'];
			// redirect to login page
			header('Location: http://localhost/tc2510/login.php');
			exit(); // ALWAYS EXIT AFTER A REDIRECT!
		}
	}
	// does user have permission to be here?
	if (!$user->is_authorized($pagesecurity)) {
		// set error message
		$_SESSION['flashmessage'] = 'You do not have permission to view this page.';
		// set return url
		$_SESSION['flashdata'] = $_SERVER['PHP_SELF'];
		// redirect to login page
		header('Location: http://localhost/'.REDIRECT_UNAUTHORIZED);
		exit(); // ALWAYS EXIT AFTER A REDIRECT!
	}
}
// is login data present

// is user authenticated


