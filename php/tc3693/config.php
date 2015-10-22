<?php
/*
	config.php - simple config and setup file
*/


// connect to database server
$dbLink = @mysql_connect('localhost','root','xampp');
if (!$dbLink) exit('Error connecting to database server.');

// select database
$db = @mysql_select_db('tc3693');
if (!$db) exit('Error selecting database.');



?>