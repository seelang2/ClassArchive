<?php
/*
	functions.php - General function library
*/

// wrapper function for escape
function escape($string) {
	return mysql_real_escape_string($string);
}

// debug function version 1
function array_dump($array) {
	return '<pre>' . print_r($array, true) . '</pre>';
}
// to use: echo array_dump($_POST);

// debug function version 2
function array_view($array) {
	$output = '<p>Array Contents:<br />' . "\n";
	
	foreach($array as $key => $value) {
		$output .= $key . ' => ' . $value . "\n";
	}
	
	$output .= '</p>' . "\n";
	
	return $output;
}





?>