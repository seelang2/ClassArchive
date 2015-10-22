<?php
/*
	lib_functions.php - Function Library
*/

function escape($value) {
	return mysql_real_escape_string($value);
}

function db_connect($db_name, $db_user, $db_password, $db_hostname = 'localhost') {
	if (!$dbcnx = mysql_connect($db_hostname, $db_user, $db_password)) return false;
	if (!$dbh = mysql_select_db($db_name)) return false;
	return $dbh;
}

@define('VALIDATE_NOTBLANK', 1);

function validate($item, $rule) {
	switch($rule)
	{
		case 1:
			// check for non-blank
			if (isset($item) && $item != '') {
				return true;
			} else {
				return false;
			}
			
		break;
	
	}
	return false;
}


?>