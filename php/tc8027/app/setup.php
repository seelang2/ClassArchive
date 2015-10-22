<?php

// common app initialization
require_once('config.php');


$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);

// initialize database connection

try {
	$dbh = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.'',
					DB_USER,
					DB_PASSWORD);

} catch (PDOException $e) {
	// log error message to file
	$errmsg = 'Database Error: '.$e->getMessage() . "\n";
	error_log($errmsg,3,DB_ERROR_LOG);
		
	exit('<p>Database error. No soup for you! *snap*</p>');
}

