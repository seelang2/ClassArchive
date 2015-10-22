<?php

function output($data) {
	echo '<p>' . $data . '</p>';
}

function foo($c) {
	$c = $c * 100;
	return $c;
}

$c = 50;

// values in PHP are pass by copy by default
// the original token is unchanged
output(foo($c)); // 5000
output($c); // 50



