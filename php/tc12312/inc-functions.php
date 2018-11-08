<?php
/**
 * Functions
 */

// Redirect to new URL
function redirect($URL, $params = null) {
	header('Location: ' . $URL . '?' . $params);
	exit(); // always terminate script after a header redirect
}

function system_log($message) {
	$message = date('Y-m-d') . ' - ' . $message . "\n";
	error_log($message, 3, LOGFILE);
}

// outputs JSON to user agent. $data is an array containing
// output schema properties
function output($data) {
	header('Content-type: application/json');
	echo json_encode($data);
	exit();
}

