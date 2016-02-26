<?php

function dump($array) {
	return '<pre>'.print_r($array,true).'</pre>';
}

echo '<h1>$_GET:</h1>'.dump($_GET);
echo '<h1>$_POST:</h1>'.dump($_POST);
echo '<h1>$_SERVER:</h1>'.dump($_SERVER);
echo '<h1>$_COOKIE:</h1>'.dump($_COOKIE);
echo '<h1>$_SESSION:</h1>'.dump($_SESSION);





?>