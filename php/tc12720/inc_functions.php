<?php
/**
 * Functions library
 */

/**
 * Break down a DATETIME string into its components
 * Returns array with keys corresonding to date() string format
 */
function parseDateTime($dateString) {
	$output = []; // create array to hold pieces
	// split DATETIME into date and time
	$dateTime = explode(' ', $dateString);
	// split date into pieces
	$d = explode('-', $dateTime[0]);
	$output['Y'] = $d[0];
	$output['m'] = $d[1];
	$output['d'] = $d[2];
	// now split time
	$t = explode(':', $dateTime[1]);
	$output['H'] = $t[0];
	$output['i'] = $t[1];
	$output['s'] = $t[2];

	return $output;
}

function dump($array) {
	echo '<pre>'.print_r($array,true).'</pre>';
}


