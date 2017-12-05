<?php

function output($data) {
	echo '<p>' . $data . '</p>';
}

function foo() {
	global $c; // import global variable into function scope
	$c = $c * 100;
	return $c;
}

$c = 50;

output(foo());
output($c);



