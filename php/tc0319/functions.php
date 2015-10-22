<?php
// functions.php - function library

function db_connect($hostname, $dbname, $dbuser, $dbpassword)
{
	$dbcnx = @mysql_connect($hostname, $dbuser, $dbpassword);
	
	if (!$dbcnx) return false;
	
	$dbh = @mysql_select_db($dbname);
	
	if (!$dbh) return false;

	return $dbh;
}

function escape($data)
{
	return mysql_real_escape_string($data);
}


?>