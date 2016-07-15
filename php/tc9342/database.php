<?php

// connect to db server and select database
try {
	// create an instance of the PDO class
	$db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,
				  DB_USER,
				  DB_PASSWD);

} catch (PDOException $e) {
    // terminate if there was a database error
    exit( 'Connection failed: ' . $e->getMessage() );
}


