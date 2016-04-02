<?php
// init.php - app startup

// load configuration data
require('config.php');
require('inc_lib.php');

// connect to database
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASSWD);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit(); // terminates script
}



?>