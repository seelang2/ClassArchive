<?php

function doStuff() {
	global $c; // imports $c into the current scope
	$c = 100;
	echo '<p>'. $c .'</p>'; // 100

}

$c = 10;

echo '<p>'. $c .'</p>'; // 10

doStuff();

echo '<p>'. $c .'</p>'; // 100

