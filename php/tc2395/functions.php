<?php
/*
	functions.php - basic library
*/

function escape($string) {
	return mysql_real_escape_string($string);	
}

