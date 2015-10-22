<?php

function output($data) {
	echo '<p>' . $data . '</p>';
}

// the & means pass a reference to the original token $c
function foo(&$c) {
	$c = $c * 100;
	return $c;
}

$c = 50;

// now the value is pass by reference and the original object is changed
output(foo($c)); // 5000
output($c); // 5000



