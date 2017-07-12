<?php
/**
 * Application initialization file
 */

// load/define config settings
// define database connection constants
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tc11281');

// load app modules, classes, etc.


// other bootstrap code


// connect to MySQL database server
// the @ just suppresses any warning output 
$db = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($db->connect_error) {
    exit('<p>Database error.</p>');
}


