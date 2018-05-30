<?php
/**
 *
 *
 */
class Auth {
	
	/*
		Store reference to database object and params for check()
		We -could- pass them directly when we call check(), but this
		is in keeping with putting our Auth configuration statements
		in one spot 
	*/
	private static $db = null;
	/*
		For ease of use I'm gonna store all the db params in an array
		using the following keys:
			loginPOST 			- $_POST key containing login value
			loginField 			- database column containing login value
			passwordPOST 		- $_POST key containing password value
			passwordField 	- database column containing password value
			loginTable 			- database table name
	*/
	private static $dbParams = [];

	/*
		ACL is an associative array where the keys correspond to
		the controller.method and the value of the element is the
		minimum permission level.

		Note that the entries should be added using Auth::addACLEntry()
		instead of hardcoded here for better reusability.

		ex:
		[
			'controller.method' => 1
		]
	*/
	private static $acl = [];

	/*
		Store auth-related request paths instead of 
		relying on hardcoded values in the functions
	*/
	private static $loginURL = null;
	private static $logoutURL = null;
	private static $forbiddenURL = null;

	/*
		Also need to consider the default behavior - allow or deny access
		by default if a request path is not in the ACL table. 
	*/
	private static $defaultAccess = 'allow'; // allow | deny
	
	/*
		setter to set default access behavior
	*/
	static function setDefaultAccess($access) {
		Auth::$defaultAccess = strtolower($access) == 'allow' ? 'allow' : 'deny';
	} // setDefaultAccess

	/*
		setter to add entries to ACL
	*/
	static function addACLEntry($path, $permission) {
		Auth::$acl[$path] = $permission;
	} // addACLEntry

	/*
		logoin url setter
	*/
	static function setLoginURL($path) {
		Auth::$loginURL = $path;
	} // setLoginURL

	/*
		logout url setter
	*/
	static function setLogoutURL($path) {
		Auth::$logoutURL = $path;
	} // setLogoutURL

	/*
		forbidden url setter
	*/
	static function setForbiddenURL($path) {
		Auth::$forbiddenURL = $path;
	} // setLogoutURL

	/*
		setter for database stuff
	*/
	static function setDB(&$db, $dbParams) {
		Auth::$db = $db;
		Auth::$dbParams = $dbParams;
		// TODO possible parameter checking
	}

	/*
		Checks whether request is authorized or not
	*/
	static function check($controllerName, $controllerMethod) {
		// we can bypass the routine for the login and logout requests
		// as both should be accessible
		if ($controllerName . DS . $controllerMethod == Auth::$loginURL) {
			return true;
		}

		if ($controllerName . DS . $controllerMethod == Auth::$logoutURL) {
			Auth::logout();
		}

		$key = $controllerName .'.'. $controllerMethod;

		// is the request secured?

		// first check whether request is 'on the list'
		if ( !array_key_exists($key, Auth::$acl) ) {
			// request is not in ACL table, so check default behavior
			if ( Auth::$defaultAccess == 'allow' ) {
				// by default request is not secured - let them through
				return true;
			}
		} // if on list

		// request is secured, on to next step

		// is user logged in?
		if ( empty($_SESSION['user']) ) {
			// user is not logged in

			// is login data present?
			if ( empty($_POST[Auth::$dbParams['loginPOST']]) || 
				   empty($_POST[Auth::$dbParams['passwordPOST']]) ) {
				// no login data, redirect to login page
				Auth::redirectToLogin($_SERVER['REQUEST_URI']);
			}

			// login data IS present
			// are user user credentials correct?
			// check database for username and password

			// pull names into variables for readability and sanitization where necessary
			$login = Auth::$db->quote($_POST[Auth::$dbParams['loginPOST']]);
			$password = Auth::$db->quote($_POST[Auth::$dbParams['passwordPOST']]);
			$table = Auth::$dbParams['loginTable'];
			$loginField = Auth::$dbParams['loginField'];
			$passwordField = Auth::$dbParams['passwordField'];

			// TODO can  isolate result fields as well to fully decouple Auth from db 
			$query = "SELECT id, name, permission FROM $table WHERE $loginField = $login AND $passwordField = $password LIMIT 1";

			$result = Auth::$db->query($query);
			// is there a query error or no rows found?
			if ( !$result || $result->rowCount() < 1 ) {
				// user credentials invalid - set error message and send to login page
				Flash::set('retrylogin'); 
				Auth::redirectToLogin($_SERVER['REQUEST_URI']);
			}

			// credentials ok, indicate user is logged in by storing user data in session
			$_SESSION['user'] = $result->fetch(PDO::FETCH_ASSOC);

		} // if user is logged in

		// user is (now) logged in
		// does user have appropriate permission?
		if ( $_SESSION['user']['permission'] >= Auth::$acl[$key] ) {
			// user has permission to proceed - let them through
			return true;
		}
		// user doesn't have permission to access request
		// send to 'access forbidden' page
		Auth::redirectToForbidden();

	} // check

	/*
		Redirects user agent to login page
		Also optionally passes original request as a GET query string parameter if passed
	*/
	static function redirectToLogin($uri = null) {
		// if the login URL is not set, throw an Exception (error) to stop app
		// we throw an error because this is something that needs to be coded into our app
		if ( empty(Auth::$loginURL) ) {
			throw new Exception('Auth::loginURL is not set. Unable to redirect to login URL.');
		}

		$location = BASE_PATH . Auth::$loginURL;
		if ( !empty($uri) ) $location .= '?uri='.urlencode($uri);

		header('Location: ' . $location);
		exit(); // ALWAYS call exit() after a header redirect
	} // redirectToLogin

	/*
		Logs user out of system
		Clears the user data and redirects them to the login page
	*/
	static function logout() {
		// assign session array to new empty array
		// NEVER use unset($_SESSION) as this renders $_SESSION unusable for the current request
		$_SESSION = [];
		session_destroy(); // also destroy session data on server
		session_regenerate_id(); // and create a brand new session id for extra measure
		Auth::redirectToLogin(); // send user to login page
	} // logout

	/*
		Redirects user agent to 'no access' page defined in $forbiddenURL
		If the url is not defined, display the default server 'Forbidden' status page
	*/
	static function redirectToForbidden() {

		if ( empty(Auth::$forbiddenURL) ) {
			// let's do a redirect to the default HTTP 403 (Forbidden) server page
			header("HTTP/1.1 403 Forbidden" );
			exit(); // ALWAYS call exit() after a header redirect
		}

		$location = BASE_PATH . Auth::$forbiddenURL;
		header('Location: ' . $location);
		exit(); // ALWAYS call exit() after a header redirect
	} // redirectToLogin

	/*
		Simple method to test if user is logged in
	*/
	static function isLoggedIn() {
		return !empty($_SESSION['user']);
	}

} // Auth

