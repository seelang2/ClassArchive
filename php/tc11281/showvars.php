<?php
session_start();

function dumpvar($data) {
	return '<pre>'.print_r($data, true).'</pre>';
}

echo '<p>This page is ' . basename($_SERVER['PHP_SELF']) . '</p>';

echo '<h1>$_POST:</h1>';
echo dumpvar($_POST);

echo '<h1>$_GET:</h1>';
echo dumpvar($_GET);

echo '<h1>$_REQUEST:</h1>';
echo dumpvar($_REQUEST);

echo '<h1>$_COOKIE:</h1>';
echo dumpvar($_COOKIE);

echo '<h1>$_SESSION:</h1>';
echo dumpvar($_SESSION);

echo '<h1>$_FILES:</h1>';
echo dumpvar($_FILES);

echo '<h1>$_SERVER:</h1>';
echo dumpvar($_SERVER);

echo '<h1>$_ENV:</h1>';
echo dumpvar($_ENV);




