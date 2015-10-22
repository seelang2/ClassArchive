<?php
/*
config.php - Sample config file
*/

$me = $_SERVER['PHP_SELF'];
$fullme = 'http://' . $_SERVER['HTTP_HOST'] . $me;

@define('SITE_URL', 'http://216.180.243.58/~tc8401/');
@define('DEFAULT_PAGE', SITE_URL . 'mainpage.php');

include_once ("functions.php");

session_start();
$dbcnx = db_connect('tc8401_classdb','tc8401_dbuser','simple');

//include_once("security.php");
?>