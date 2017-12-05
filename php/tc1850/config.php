<?php
/*
	config.php - basic config file
*/

// connect to database server
$dbcnx = @mysql_connect('localhost', 'root', 'xampp');

if (!$dbcnx) exit('Error connecting to database server.');

// select database
$dbh = @mysql_select_db('tc1850');

if (!$dbh) exit('Error selecting database.');





?>