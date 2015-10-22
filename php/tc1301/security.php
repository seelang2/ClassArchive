<?php
/*
	security.php - simple authentication system
*/

if (!empty($_GET['logout'])) {
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	$_SESSION['statusmsg'] = 'You have been logged out.';

	// redirect to login page
	header('Location: http://localhost/login.php');
	exit();
}

if ($page_secured) {
	if (empty($_SESSION['userid'])) {
		// user not logged on
		if (!empty($_POST['login']) && !empty($_POST['password'])) {
			// login form submitted - validate data
			
			$query = "SELECT id, firstname FROM contacts " .
					 "WHERE login = '" . escape($_POST['login']) . "' " .
					 "AND password = '" . escape($_POST['password']) . "' " .
					 "AND type = '1' LIMIT 1";
					 
			$result = @mysql_query($query);
			if (!$result || mysql_num_rows($result) != 1) {
				// login is invalid
				$_SESSION['statusmsg'] = 'Invalid login or password.';
				
				// redirect to login page
				header('Location: http://localhost/login.php');
				exit();
			} else {
				// login validated, store it
				$row = mysql_fetch_array($result);
				$_SESSION['userid'] = $row['id'];
				$_SESSION['username'] = $row['firstname'];
			}
		} else {
			// user not logged in and no login form submitted - redirect to login page
			header('Location: http://localhost/login.php');
			exit();
		} // if empty POST
	
	} // if empty userid
} // if page_secured




?>