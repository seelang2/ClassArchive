<?php
/*
	functions.php - general function library

*/

function db_connect($dbname, $dbuser, $dbpasswd, $dbhost = 'localhost') {
	$db = array();
	if (!$db[] = @mysql_connect($dbhost, $dbuser, $dbpasswd)) return false;
	
	if (!$db[] = @mysql_select_db($dbname)) return false;
	
	return $db;
}

function redirect($url) {
	header('Location: ' . $url);
	exit;
}

function dump($arr) {
	return '<pre>' . print_r($arr, true) . '</pre>';
}

function escape($string) {
	return mysql_real_escape_string($string);
}

function getScriptName() {
	preg_match('/\b[a-zA-Z0-9.-_]*$/', $_SERVER['PHP_SELF'], $scriptname);
	return $scriptname[0];
}

?>