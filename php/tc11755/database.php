<?php


// connect to database server
// select database

try {
	$db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWORD);
} catch(PDOException $error) {
	echo '<p>Database error. No soup for you! *snap*</p>';
}

