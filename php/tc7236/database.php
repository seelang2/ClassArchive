<?php
/*
	database.php - database connectivity
*/


// connect to DB server
try {
	$dbh = new PDO('mysql:dbname=tc7236;host=localhost','root','xampp');
} catch (PDOException $e) {
	// don't leave this blank - always handle the error somehow
	
	exit('<p>Error:</p> There was an error: '.$e->getMessage()); // terminate script
	
}

