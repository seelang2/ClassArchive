<?php

echo '<h1>$_COOKIE:</h1>' . '<pre>' . print_r($_COOKIE, true) . '</pre>';

if (isset($_GET['reset'])) {
	echo '<p>Resetting cookie...</p>';
	// delete cookie
	setcookie('testcookie',null,1);
	
	// note that deleting the cookie does NOT remove the cookie value from
	// the $_COOKIE array
	
} else {

	if (!isset($_COOKIE['testcookie'])) {
		echo '<p>Initializing cookie</p>';
		setcookie('testcookie',0);

	} else {
		
		echo '<p>Updating cookie to ' . ($_COOKIE['testcookie'] + 1) . '</p>';
		setcookie('testcookie', $_COOKIE['testcookie'] + 1);
		
	}

}