<?php
/***
 * User function library. Put reusable code here and include
 * in your projects.
 **/

function dumpvar($data) {
	return '<pre>'.print_r($data, true).'</pre>';
}

// NEVER trust user input. Always sanitize before using it
function sanitize($input) {
	$output = trim($input); // get rid of whitespace characters
	//$output = htmlentities($output, ENT_QUOTES, 'UTF-8');
	$output = strip_tags($output);
	return $output;
}



