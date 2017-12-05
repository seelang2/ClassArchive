<?php

session_start(); // initialize sessions for use

if (isset($_GET['reset'])) {
	echo '<p>Resetting session...</p>';

	//unset($_SESSION); // <= DO NOT DO THIS!
	
	// unset($_SESSION['testdata']) // either unset a specific element in the array
	$_SESSION = array(); // or reassign the existing $_SESSION as an empty array
	
	session_regenerate_id(); // creates a brand new session id;
	setcookie('PHPSESSID',null,1); // and/or delete the session cookie
}



echo '<h1>$_SESSION:</h1>' . '<pre>' . print_r($_SESSION, true) . '</pre>';
echo '<h1>$_COOKIE:</h1>' . '<pre>' . print_r($_COOKIE, true) . '</pre>';

if (isset($_SESSION['testdata'])) {
	
	echo '<p>Updating session data to '. (++$_SESSION['testdata']) .'</p>';
	
} else {
	
	echo '<p>Initializing session data</p>';
	$_SESSION['testdata'] = 100;
}

echo '<h1>$_SESSION:</h1>' . '<pre>' . print_r($_SESSION, true) . '</pre>';
