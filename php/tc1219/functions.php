<?php
/*
	functions.php - general function library
*/

function escape($string) {
	return mysql_real_escape_string($string);
} // escape

function db_connect($dbname, $dbuser, $dbpasswd, $dbhostname = 'localhost') {
	$db = array();
	if (!$db[] = @mysql_connect($dbhostname, $dbuser, $dbpasswd)) return false;
	if (!$db[] = @mysql_select_db($dbname)) return false;
	return $db;
};



?>