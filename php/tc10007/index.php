<?php
require_once('init.php');

/**
 * View Routing system
 * Checks whether the logged in user has access to the controller/actions requested
 * then loads the appropriate include template
 */

// does user have access to resource(page)?
if ($controller != 'dashboard') {
	
	//echo "<p>Searching for $controller->$action in:</p>";
	//echo "<pre>".print_r($ACL[$controller][$_SESSION['user']['type']],true)."</pre>";

	// check to see if the action requested for the given controller is accessible to the user type
	if ( !in_array($action, $ACL[$controller][$_SESSION['user']['type']]) ) {
		// access forbidden, redirect
		header('Location: '.NOACCESS_PAGE);
		exit();
	}
}


require('header.php');

/**
 * request 'router'
 * loads the view include template into main content area
 */
if ($controller == 'dashboard')
	include('dashboard.php');
else
	include($controller . '.' . $action . '.php');

require('footer.php');


?>
