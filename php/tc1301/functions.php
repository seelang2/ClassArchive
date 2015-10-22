<?php
/*
	functions.php - general function library
*/

function escape($string) {
	return mysql_real_escape_string($string);
}

function db_connect($db_name, $db_user, $db_password, $db_server = 'localhost') {
	if (!$dbcnx = @mysql_connect($db_server, $db_user, $db_password)) return false;
	if (!$dbh = @mysql_select_db($db_name)) return false;
	return $dbh;
}




?>