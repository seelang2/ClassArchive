<?php

// initialize the application
require_once('init.php');

// determine base path of system
$base_path = dirname($_SERVER['PHP_SELF']) . DS;
// store the path for later use
Config::set('base_path', $base_path);
// remove the base path from the request
$request_path = str_replace($base_path, '', $_SERVER['REQUEST_URI']);

// strip off query string if it's set
if (!empty($_SERVER['QUERY_STRING'])) {
	$request_path = str_replace('?'.$_SERVER['QUERY_STRING'], 
								'', 
								$request_path);
}

// split request into parts and store in array
$request_array = explode(DS, $request_path);

$controller = array_shift($request_array);
$controllerName = $controller . 'Controller';
$controllerMethod = array_shift($request_array);

// Auth::check() checks whether the visitor has permission to
// access the page or not. It returns true if access is granted
// and redirects the visitor to a different request if not
if (Auth::check($controller, $controllerMethod)) {
	// Passed authorization check, so let them through

	// instantiate controller passing database object
	$controller = new $controllerName($db);
	// call controller method and pass leftover parameter (pulling it out of the array in the process)
	$controller->$controllerMethod(array_shift($request_array));

} // if Auth::check()

// END index.php