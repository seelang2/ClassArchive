<?php
/* 
	functions.php - general function library
*/



function db_connect($dbhostname, $dbname, $dbuser, $dbpassword) {

	$dbcnx = @mysql_connect($dbhostname, $dbuser, $dbpassword);

	if (!dbcnx) { 
		return false;
	}
	
	if (!@mysql_select_db($dbname)) {
		return false;
	}
	
	return $dbcnx;
}



?>