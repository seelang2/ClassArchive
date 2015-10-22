<?php
/*
	tkt-config.php - basic application configuration
*/

// database access parameters
define('DB_HOST','localhost');
define('DB_NAME','demo1');
define('DB_USER','root');
define('DB_PASSWD','portable');

define('TEMPLATE_HEADER', 'demo4-header.php');
define('TEMPLATE_FOOTER', 'demo4-footer.php');


require_once "functions.php";


$me = $_SERVER['PHP_SELF'];

if (!$dbcnx = db_connect(DB_HOST, DB_NAME, DB_USER, DB_PASSWD)) exit("<p>Error connectiong to or selecting database.</p>");

?>