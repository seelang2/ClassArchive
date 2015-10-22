<?php
/*
	functions.php - function library
*/


function escape($string) {
	return mysql_real_escape_string($string);
}

function redirect($loc) {
	header('Location: '.$loc);
	exit(); // ALWAYS CALL EXIT AFTER HEADER REDIRECT!!
}

