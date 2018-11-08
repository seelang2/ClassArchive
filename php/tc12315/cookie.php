<?php

// cookie delete mechanism
if (!empty($_GET['delete'])) {
	setCookie('testcookie','', 1); // expires one second after the Epoch
} else {


if (!empty($_COOKIE['testcookie'])) 
	$cookieValue = $_COOKIE['testcookie'];
else
	$cookieValue = 0;

$cookieValue++;

echo '<p>CookieValue: '.$cookieValue.'</p>';

setCookie('testcookie', $cookieValue);

}

echo '<pre>'.print_r($_COOKIE,true).'</pre>';



