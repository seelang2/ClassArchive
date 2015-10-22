<?php

include('vardump.php');

/*
function pr($data) {
	return '<pre>' . print_r($data, true) . '</pre>';
}

*/

echo '<p>Original Request line: '.$_SERVER['REQUEST_URI'].'</p>';

// the preamble to remove from the URI
$baseDir = '/tc7809/';

// regular expressions are enclosed in slashes so the pattern must be enclosed
// inside them. However, our path also contains slashes, so we use preg_quote to
// escape out the inner slashes, which is what the delimiter option does.
$pattern = '/'.preg_quote($baseDir, '/').'/';

$request = preg_replace($pattern, '', $_SERVER['REQUEST_URI']);

echo '<p>Stripped Request line: '.$request.'</p>';

$requestArray = explode('/', $request);

echo '<p>Request Params:</p>';
echo pr($requestArray);


// building a basic query based on request
$query = 'SELECT * ';

// get first parameter
$param = array_shift($requestArray);
// first parameter is always a collection
$query .= 'FROM ' . $param;

if (!empty($requestArray)) {
	// get next parameter
	$param = array_shift($requestArray);
	// second parameter is an identifier
	$query .= ' WHERE id = ' . $param;
}

// view query
echo '<p>Query: ' . $query . '</p>';








