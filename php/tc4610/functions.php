<?php
/****
 * functions.php - basic function library
 **/

function escape($string) {
	return mysql_real_escape_string($string);
}

// checks whether a string is blank or not
function is_blank($string) {
	if(empty($string))
		return false;
	else
		return true;
}

function between($string, $min, $max) {
	if (strlen($string) < $min || strlen($string) > $max)
		return false;
	else
		return true;
}

function db_connect($host, $user, $pass) {
	return @mysql_connect($host, $user, $pass);
}
