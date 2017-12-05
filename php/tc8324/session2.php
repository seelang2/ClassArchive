<?php

// initialize session
session_start();

//echo '<pre>'.print_r($_SERVER, true).'</pre>';

if (!isset($_SESSION['log'])) {
	// initialize log array with this first visit timestamp
	$_SESSION['log'] = array($_SERVER['REQUEST_TIME']);
} else {
	// push this visit's timestamp onto array
	array_push($_SESSION['log'], $_SERVER['REQUEST_TIME']);
}


echo '<pre>'.print_r($_SESSION, true).'</pre>';

