<?php
/***
 * init.php - application startup
 */


// load configuration info
require_once(APP_PATH.'config.php');

// load core libraries
require_once(APP_PATH.'core.php');

// ... any other files to initialize the app go here


// Routing component

// parse request for Router

// get request url from server var
$requestURL = $_SERVER['REDIRECT_URL'];

$pattern = '/'.preg_quote(BASE_FS_PATH, '/').'/';

// strip out base path
$requestURL = preg_replace($pattern, '', $requestURL);

// strip out any trailing slashes
$requestURL = preg_replace('/\/$/', '', $requestURL);

echo '<p>'.$requestURL.'</p>';

// convert request to an array
$request = explode('/', $requestURL);

echo '<pre>'.print_r($request,true).'</pre>';



// get the controller name from the request array
$controllerName = array_shift($request) . 'Controller';

// create an instance of the required controller class
$controller = new $controllerName();

// get the action name from the request array
$actionName = array_shift($request);

// call the controller action method and pass in request params
$controller->$actionName($request);




