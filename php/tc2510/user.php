<?php

class User {
	var $userid = NULL;
	var $permissions = NULL;
	var $dbObj = NULL;
	
	function __construct(&$dbObj) {
		$this->dbObj =& $dbObj;
		
		if (!empty($_SESSION['User'])) {
			$this->userid = $_SESSION['User']['userid'];
			$this->permissions = $_SESSION['User']['permissions'];
		}
	}
	
	function __destruct() {
	}
	
	function is_authorized($target) {
		if ($this->permissions >= $target)
			return true;
		else
			return false;
		
	} // is_authorized
	
	function authenticate($login, $password) {
		$query = "SELECT * FROM users WHERE " .
				 "login = " . $this->dbObj->quote($login) .
				 "AND password = " . $this->dbObj->quote($password);
	
		$_SESSION['lastquery'] = $query;
		if (!$result = $this->dbObj->query($query)) {
			// query error
			return false;
		}
		if (!$user = $result->fetch()) {
			// no user matching that login and password combo
			return false;
		}
		$_SESSION['userdata'] = $user;
		// store user credentials
		$this->userid = $user['id'];
		$this->permissions = $user['permissions'];
		// store user info into session - doesn't work in destructor
		$_SESSION['User'] = array();
		$_SESSION['User']['userid'] = $this->userid;
		$_SESSION['User']['permissions'] = $this->permissions;
		return true;
	} // authenticate
	
	function logged_in() {
		if (empty($this->userid))
			return false;
		else
			return true;
	} // logged_in
	
	function login() {
		
		
	} // login
	
	function logout() {
		$this->userid = NULL;
		$this->permissions = NULL;
		// Unset all of the session variables.
		$_SESSION = array();
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		
		// Finally, destroy the session.
		session_destroy();
	} // logout
	
} // class

