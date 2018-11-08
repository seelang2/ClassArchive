<?php

session_start(); // initializes sessions

if (!empty($_GET['delete'])) {
	session_destroy(); // destroys session data
	$_SESSION = []; // NEVER do unset($_SESSION)
	session_regenerate_id(); // create new session id

}

if (empty($_SESSION['testsession'])) {
	$_SESSION['testsession'] = 0;
}

$_SESSION['testsession']++;

echo '<pre>'.print_r($_SESSION,true).'</pre>';

