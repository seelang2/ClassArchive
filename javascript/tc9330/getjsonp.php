<?php

$file = empty($_GET['file']) ? '' : $_GET['file'];
$callback = empty($_GET['callback']) ? '' : $_GET['callback'];

if (empty($file)) exit();

// add CORS policy
header('Access-Control-Allow-Origin: *');

if (!empty($callback)) {
	header('Content-Type: text/javascript');
	echo $callback . '(';
}

echo file_get_contents($file);

if (!empty($callback)) echo ');';
