<?php
/*
	startup.php - basic initialization file
*/

require_once('config.php');
require_once('functions.php');

// connect to db server
$dbcnx = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$dbcnx) exit('Error connecting to database server.');

// select db
$dbh = @mysql_select_db(DB_NAME);

if (!$dbh) exit('Error selecting database.');




?>