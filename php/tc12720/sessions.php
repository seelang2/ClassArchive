<?php

// initialize sessions for use
session_start();

echo '<h2>$_COOKIE:</h2>';
echo '<pre>'.print_r($_COOKIE,true).'</pre>';

echo '<h2>$_SESSION:</h2>';
echo '<pre>'.print_r($_SESSION,true).'</pre>';

// empty() is true if value is falsy - including empty string and 0
if (!isset($_SESSION['data'])) {
	$_SESSION['data'] = 0;
} else {
	$_SESSION['data'] = $_SESSION['data'] + 1;
}

echo '<p>'.$_SESSION['data'].'</p>';

// delete session
if (!empty($_GET['reset'])) {
	$_SESSION = []; // DO NOT use unset($_SESSION)!
	session_regenerate_id(true); // create new session identifier
	session_destroy(); // destroys current session
}
