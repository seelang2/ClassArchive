<?php
/*
	functions.php - general function library
*/

function db_connect($user, $password, $dbname, $host = 'localhost')
{
	if (!$dbcnx = mysql_connect($host, $user, $password)) return false;
	
	if (!$db = mysql_select_db($dbname)) return false;
	
	return $db;

}

function escape($val)
{
	return mysql_real_escape_string($val);
}




?>