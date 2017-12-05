<?php
/*
	config.php
*/

@define('DBNAME', 'tc1003');
@define('DBUSER', 'root');
@define('DBPASSWD', 'portable');

@define('BASE_URL', 'http://localhost');
@define('SECURITY_SALT','kj34tjfgjb3ubveubWERGEW%G');

@define('LOGIN_PAGE', '/login.php');
@define('AUTH_REDIRECT','/main.php');
@define('NOAUTH_REDIRECT','/noaccess.php');

////////// END USER CONFIGURATION ////////////

session_start();

if (!empty($_SESSION['statusmsg'])) {
	$statusmsg = $_SESSION['statusmsg'];
	unset($_SESSION['statusmsg']);
} else {
	$statusmsg = '';
}

require_once('functions.php');


if (!$db = db_connect(DBNAME, DBUSER, DBPASSWD)) exit('Error connecting to database or server');

$permissionTypes = array (
	'Please select',
	'Basic User',
	'Manager',
	'Sysadmin'
);

@define('BASIC_USER', 1);
@define('MANAGER', 2);
@define('SYSADMIN', 3);

require_once('security.php');



?>