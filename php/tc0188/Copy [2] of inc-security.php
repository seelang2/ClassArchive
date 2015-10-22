<?php

if ($me == LOGIN_PAGE) return; // no need for a security check on the login page

// check whether this page came from the login form
if (isset($_POST['fromlogin']) && $_POST['fromlogin'] == 1) {
	// get login form vars
	if (isset($_POST['email']) && $_POST['email'] != '') $email = $_POST['email'];
	if (isset($_POST['password']) && $_POST['password'] != '') $password = $_POST['password'];
	
	// check login against db
	$query = "SELECT id, name, permissions FROM users WHERE email = '$email' AND password = '$password'";
	
	$result = mysql_query($query);
	
	if (mysql_num_rows($result) == 1) {
		// if good, set session vars with hash & id
		$row = @mysql_fetch_array($result);
		
		$_SESSION['UID'] = $row['id'];
		$_SESSION['HASH'] = md5($row['id'] . $password);
	
	} else {
		// if not good, set status message in session and send back to login
		$_SESSION['statusmsg'] = "Error: Username and/or password is incorrect.";
		$_SESSION['redir'] = $me;
		redirect(SITE_URL . LOGIN_PAGE);
	}

} else {
	// check for hash session var
	if (isset($_SESSION['UID']) && $_SESSION['UID'] != '' && isset($_SESSION['HASH']) && $_SESSION['HASH'] != '') {
		// check hash against db
		$id = $_SESSION['UID'];
		$hash = $_SESSION['HASH'];
		
		$query = "SELECT id, name, password, permissions FROM users WHERE id = '$id'";
		
		$result = @mysql_query($query);
		
		if (@mysql_num_rows($result) == 1) {

			$row = @mysql_fetch_array($result);

			// if hash checks ok AND permission is >= page perm (if any)
			if ($hash == md5($row['id'] . $row['password'])) {
				if ($row['permissions'] >= $page_permission) {
					// user is valid, let them go
				} else {
					$_SESSION['statusmsg'] = "Error: You have insufficient privileges to view that page. $query";
					$_SESSION['redir'] = $me;
					redirect(SITE_URL . DEFAULT_PAGE);
				}
				
			} else {
				$_SESSION['statusmsg'] = "Error: Invalid username and/or password. $query";
				$_SESSION['redir'] = $me;
				redirect(SITE_URL . LOGIN_PAGE);
			}
			
		} else {
			$_SESSION['statusmsg'] = "Error: Invalid username and/or password. $query";
			$_SESSION['redir'] = $me;
			redirect(SITE_URL . LOGIN_PAGE);
		}
		
	} else {
		// if no hash (user not logged in) then send to login
		$_SESSION['redir'] = $me;
		redirect(SITE_URL . LOGIN_PAGE);
	}

}

?>