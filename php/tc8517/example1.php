<?php

$c = 7;

// values are normally copied into the function scope
// (pass by value)
function foo($value) {
	$value = 100;
	
	echo '<p>'.$value.'</p>';
}

echo '<p>$c: '.$c.'</p>';
foo($c);
echo '<p>$c: '.$c.'</p>'; // original value stays intact


// '&' means to pass a reference to the original object's memory location
// (pass by reference)
function bar(&$value) {
	$value = 100; // $value points to same memory location as $c
	
	echo '<p>'.$value.'</p>';
}

echo '<p>$c: '.$c.'</p>';
bar($c);
echo '<p>$c: '.$c.'</p>'; // original value is changed






