<?php

function output($data) {
	echo '<p>' . $data . '</p>';
}

function foo($c) {
	$c = $c * 100;
	return $c;
}

$c = 50;

output(foo(10));
output($c);



