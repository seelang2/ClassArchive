<?php

// initialize session
session_start();

//echo '<pre>'.print_r($_SERVER, true).'</pre>';

if (!isset($_SESSION['testval'])) {
	$_SESSION['testval'] = 0;
} else {
	$_SESSION['testval']++;
}


echo '<pre>'.print_r($_SESSION, true).'</pre>';

