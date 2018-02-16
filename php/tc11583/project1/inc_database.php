<?php


// use PDO to get database connection
$db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, 
			  DB_USER, 
			  DB_PASSWORD);

