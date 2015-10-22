<?php

// app parameters
define('DB_NAME','tc8027');
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','xampp');

define('DB_ERROR_LOG','sql_error.log');

// database init
try {
	$dbh = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.'',
					DB_USER,
					DB_PASSWORD);

} catch (PDOException $e) {
	// log error message to file
	$errmsg = 'Database Error: '.$e->getMessage() . "\n";
	error_log($errmsg,3,DB_ERROR_LOG);
		
	exit('{"status":0,"statusmessage":"Error connecting to database"}');
}

