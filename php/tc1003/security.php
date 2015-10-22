<?php
/*
	security.php
*/

$current_page = $_SERVER['PHP_SELF'];

if (!empty($_GET['logout'])) {
	// clear session data
	unset($_SESSION['user_id']);
	unset($_SESSION['username']);
	unset($_SESSION['permission']);
	
	$_SESSION['statusmsg'] = 'You have been logged out.';
	redirect(BASE_URL . LOGIN_PAGE);
	exit;
}


// check to see if this is login.php
if ($current_page == '/login.php') {
	// is there form data present?
	if (isset($_POST['butSubmit'])) {
		// check form against user data
		$query = "SELECT * FROM users WHERE email = '" . mysql_real_escape_string($_POST['email']) . 
				 "' AND password = '" . sha1(mysql_real_escape_string($_POST['password']) . SECURITY_SALT) . "' LIMIT 1";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// user not found, display error message
			$statusmsg = 'The user id or password is incorrect.';
		} else {
			// user found, redirect to default page
			$user = @mysql_fetch_array($result);
			
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['firstname'] . ' ' . $user['lastname'];
			$_SESSION['permission'] = $user['permission'];
			
			redirect(BASE_URL . AUTH_REDIRECT);
			exit;
		}
	} 
} else {
	// lookup page permission
	$query = "SELECT perm_level FROM acos WHERE pagename = '$current_page' LIMIT 1";
	$result = @mysql_query($query);
	if (!$result) {
		// query error
		echo 'Insert default error message here (no soup for you)<br />' . $query;
	} else {
		// check if page exists in aco table
		if (mysql_num_rows($result) > 0) {
			// get page info
			$page = @mysql_fetch_array($result);
			
			// check if user is logged in
			if (empty($_SESSION['user_id'])) {
				// user not logged in, redirect to login page
				redirect(BASE_URL . LOGIN_PAGE);
				exit;
			} else {
				// user logged in, get permission level
				$query = 'SELECT * FROM users WHERE id = \'' . $_SESSION['user_id'] . '\' LIMIT 1';
				$result = @mysql_query($query);
				if (!$result || mysql_num_rows($result) != 1) {
					// Invalid session information, clear session info, set status msg and redirect to login page
					unset($_SESSION['user_id']);
					$_SESSION['statusmsg'] = 'The requested user could not be found.';
					redirect(BASE_URL . LOGIN_PAGE);
					exit;
				} else {
					// user located, compare user permission to page permission
					$user = @mysql_fetch_array($result);
					if ($user['permission'] < $page['perm_level']) {
						// not authorized to view page
						redirect(BASE_URL . NOAUTH_REDIRECT);
						exit;
					}
				}
			}
		}
	}
}

?>