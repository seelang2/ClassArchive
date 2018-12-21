<?php



// Connect to database server
// Select database to use
try {
    $db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    exit('Connection failed: ' . $e->getMessage());
}

