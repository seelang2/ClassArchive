<?php
/*
	functions.php - general function library
*/

// wrapper function for escape mechanism
function escape($string) {
	return mysql_escape_string($string);
}


?>