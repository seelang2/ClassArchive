<?php
/*
	config.php - configuration file
*/

@define('DB_USER', 'root');
@define('DB_PASSWORD', 'portable');
@define('DB_NAME', 'tc646');



////////////// DO NOT EDIT BELOW THIS LINE /////////////////////

$me = $_SERVER['PHP_SELF'];

require_once ('lib_functions.php');


if (!$dbh = db_connect(DB_NAME, DB_USER, DB_PASSWORD)) die('Error connecting to database or server.');



?>