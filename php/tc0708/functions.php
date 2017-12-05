<?php
/*
	functions.php - function library

*/


function db_connect($dbname, $dbuser, $dbpasswd, $dbhost = 'localhost') {

	if (!$dbcnx = mysql_connect($dbhost, $dbuser, $dbpasswd)) {
		return false;
	}
	
	if (!$dbh = mysql_select_db($dbname)) {
		return false;
	}
	
	return $dbh;

}

function escape($string) {
	return mysql_real_escape_string($string);
}




?>