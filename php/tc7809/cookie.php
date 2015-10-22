<?php


function pr($data) {
	return '<pre>' . print_r($data, true) . '</pre>';
}

echo pr($_COOKIE);

if (!empty($_COOKIE['myCookie'])) 
	$myCookie = $_COOKIE['myCookie'];
else
	$myCookie = 1;
	
$myCookie++;

echo '<p>My Cookie is ' . $myCookie . '</p>';

setCookie('myCookie', $myCookie);


