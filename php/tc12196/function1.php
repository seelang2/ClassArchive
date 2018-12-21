<?php

function foo($thing) {
	$thing = 'something else';
	echo '<p>'. $thing .'</p>';
}

function bar(&$thing) {
	$thing = 'something else';
	echo '<p>'. $thing .'</p>';
}

$c = "stuff";

echo '<p>' . $c . '</p>';
foo($c);
echo '<p>' . $c . '</p>';

echo '<p>' . $c . '</p>';
bar($c);
echo '<p>' . $c . '</p>';


