<?php
require('inc_init.php');

@define('URL_DS','/');

// strip base path and query string from URI to get request params
$basePath = dirname($_SERVER['PHP_SELF']) . URL_DS;
@define('BASE_PATH',$basePath);

$request = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$request = str_replace('?'.$_SERVER['QUERY_STRING'], '', $request);

// split request into array
$requestArray = explode(URL_DS, $request);

// extract parameters from request array
$controller = array_shift($requestArray);
$action = array_shift($requestArray);
$id = array_shift($requestArray);

//echo "<p>Controller: $controller Method: $action ID: $id </p>";

if (class_exists($controller)) {
	// create an instance of controller
	$controllerInstance = new $controller($db, $controller, $action);
	
	if (method_exists($controllerInstance, $action)) {
		// call the controller method and pass in the id parameter
		$controllerInstance->$action($id);

	} else {
		// method doesn't exist - redirect to 404 page
		header("Location: {$basePath}404.php");
	}

} else {
	// class doesn't exist - redirect to 404 page
	header("Location: {$basePath}404.php");
}
	
