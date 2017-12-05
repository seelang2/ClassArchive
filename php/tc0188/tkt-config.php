<?php
/*
	tkt-config.php - basic application configuration
*/

// database access parameters
define('DB_HOST','localhost');
define('DB_NAME','demo1');
define('DB_USER','root');
define('DB_PASSWD','portable');

// template configuration
define('TEMPLATE_HEADER', 'tkt-header.php');
define('TEMPLATE_FOOTER', 'tkt-footer.php');

// site configuration
define('SITE_URL', 'http://localhost');
define('DEFAULT_PAGE', '/tkt-main.php');
define('LOGIN_PAGE', '/tkt-login.php');

// status values
$tkt_status = array(
					"Open",
					"Awaiting Response",
					"In Process",
					"On Hold",
					"Closed"
);

// other common system-wide variables
$me = $_SERVER['PHP_SELF'];

// turn on sessions
session_start();

// load libraries and modules
require_once "functions.php";
if (!$dbcnx = db_connect(DB_HOST, DB_NAME, DB_USER, DB_PASSWD)) exit("<p>Error connecting to or selecting database.</p>");
require_once "inc-security.php";

$statusmsg = '';
if (isset($_SESSION['STATUSMSG']) && $_SESSION['STATUSMSG'] != '') {
	$statusmsg = $_SESSION['STATUSMSG'];
	$_SESSION['STATUSMSG'] = '';
}

?>