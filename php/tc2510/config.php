<?php
// basic config file
session_cache_expire(20);
session_start(); // start my sessions

@define('DEFAULT_LOGIN_REDIRECT', '/tc2510/open.php');
@define('REDIRECT_UNAUTHORIZED', '/tc2510/unauthorized.php');

// database settings
@define('DB_HOST','localhost');
@define('DB_NAME','tc2510');
@define('DB_USER','root');
@define('DB_PASSWD','xampp');

// load class files
require_once('user.php');

// initialize database connection object
try {
	$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWD);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$user = new User($dbh);

if (!empty($_SESSION['flashmessage'])) {
	$flashmessage = $_SESSION['flashmessage'];
	unset($_SESSION['flashmessage']); // clear element for next use
}
if (!empty($_SESSION['flashdata'])) {
	$flashdata = $_SESSION['flashdata'];
	unset($_SESSION['flashdata']); // clear element for next use
}

if (!empty($_SESSION['debug'])) {
	$debug = $_SESSION['debug'];
	unset($_SESSION['debug']); // clear element for next use
}
//$_SESSION['debug'] .= 'User is not authorized<br>';

//include modules
require_once('security.php');
