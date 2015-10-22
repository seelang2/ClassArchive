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

function old_redirect($target) {
/*
	echo "<p>Redirecting to $target</p>";
*/
	header("Location: $target");
	exit;
}


function redirect($target, $from = '', $message = '') {
	if ($from != '') $_SESSION['redir'] = $from;
	if ($message != '') $_SESSION['STATUSMSG'] = $message;

//	echo "<p>Redirecting to $target from $more<br />$message<br />I am $me</p>";

	header("Location: $target");
	exit;
}

/*
	Escapes potentially harmful entries for SQL queries
	Works regardless of Magic Quotes setting
*/
function escape($str)
{
	return mysql_real_escape_string(stripslashes($str));				
}








function arrdump($array) {
	echo "<pre>" . print_r($array, true) . "</pre>";
}

function showenv() {
	echo '$_GET:<br />' . arrdump($_GET);
	echo '$_POST:<br />' . arrdump($_POST);
	echo '$_SESSION:<br />' . arrdump($_SESSION);
	echo '$_COOKIE:<br />' . arrdump($_COOKIE);
	echo '$_SERVER:<br />' . arrdump($_SERVER);
	echo '$_ENV:<br />' . arrdump($_ENV);
}
?>