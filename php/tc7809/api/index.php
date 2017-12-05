<?php
// single point of entry for our web service
require_once('init.php');

// parse request URI into array of path segments
$pattern = '/'.preg_quote(API_BASE_PATH, '/').'/';
//$request = preg_replace($pattern, '', $_SERVER['REQUEST_URI']);
$request = preg_replace($pattern, '', $_SERVER['REDIRECT_URL']);
$requestArray = explode('/', $request);

//echo pr($schema);

//echo pr($requestArray);

/*
  use pattern-matching approach
  In this approach we will determine the pattern the request implements
  and then apply the appropriate query to the request pattern.
  Note that there are two types of queries possible in patterns CIC and CC,
  depending on whether the tables are related via a link table or not.

*/
// determine pattern - C, CI, CIC, CC
$pattern = '';
// loop through request array
$count = count($requestArray);
for($c = 0; $c < $count; $c++) {
	// is it a collection or an identifier?
	if (array_key_exists($requestArray[$c], $schema)) {
		$pattern .= 'C';
	} else {
		$pattern .= 'I';
	}
}

//echo '<p>Request pattern: ' . $pattern . '</p>';

// take action depending on request method_exists
switch($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		require('inc_get.php');
	break;

	case 'POST':
		require('inc_post.php');
	break;

	case 'PUT':
		require('inc_put.php');
	break;

	case 'DELETE':
		require('inc_delete.php');
	break;

	default:
		require('inc_put.php');
	break;

} // switch REQUEST_METHOD






