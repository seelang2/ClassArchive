<?php
/**
 *
 *
 */

// initialize the application
require_once('inc_init.php');

// determine base path of system and define as constant
@define('BASE_PATH', dirname($_SERVER['PHP_SELF']) . DS);


// remove the base path from the request
$request_path = str_replace(BASE_PATH, '', $_SERVER['REQUEST_URI']);

// strip off query string if it's set
if (!empty($_SERVER['QUERY_STRING'])) {
	$request_path = str_replace('?'.$_SERVER['QUERY_STRING'], 
								'', 
								$request_path);
}

// split request into parts and store in array
$request_array = explode(DS, $request_path);

$controllerName = array_shift($request_array);
$controller = $controllerName . 'Controller';
$controllerMethod = array_shift($request_array);

// Auth::check() checks whether the visitor has permission to
// access the page or not. It returns true if access is granted
// and redirects the visitor to a different request if not
if (Auth::check($controllerName, $controllerMethod)) {
	// Passed authorization check, so let them through

	// instantiate controller passing database object
	$controller = new $controller($db, $controllerName, $controllerMethod);
	// call controller method and pass leftover parameter (pulling it out of the array in the process)
	$controller->$controllerMethod(array_shift($request_array));

} // if Auth::check()

// END index.php