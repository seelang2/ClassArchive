<?php
echo '<!doctype html>';
echo '<html lang="en">';
echo '<head>';
echo '	<meta charset="UTF-8">';
echo '	<title>Document</title>';
echo '</head>';
echo '<body>';


function greeting() {
	echo '<p>Hello!</p>';
}

greeting(); // executes function

function betterGreeting() {
	return 'Hello!'; // terminate function with optional value
}

echo '<h1>' . strtoupper(betterGreeting()) . '</h1>';



echo '</body>';
echo '</html>';	