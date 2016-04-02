<?php

function doStuff() {
	// do stuff
	echo '<p>Message</p>';
}

doStuff();

function doOtherStuff() {
	return 'Message';
}

echo '<p>' . doOtherStuff() . '</p>';

function doMoreStuff($message = 'default message') {
	return '<p>' . $message . '</p>';
}

echo '<p>' . doMoreStuff() . '</p>';

echo '<p>' . doMoreStuff('This space for rent.') . '</p>';

function foo($a, $b = 0) {
	$c = $a * $b; // $c is inside function scope
	return $c;
}

$c = 10; // global scope
echo '<p>' . $c . '</p>';
echo '<p>' . foo(10, 5) . '</p>';
echo '<p>' . $c . '</p>'; // $c is unchanged

// pass by value example
function bar($a) {
	$a = $a * $a;
	return $a;
}

$c = 10; // global scope
echo '<p>' . $c . '</p>';
echo '<p>' . bar($c) . '</p>'; // value of $c is copied to $a
echo '<p>' . $c . '</p>'; // $c is unchanged


// pass by reference example
function bar2(&$a) { // & means reference to ORIGINAL var
	$a = $a * $a;
	return $a;
}

$c = 10; // global scope
echo '<p>' . $c . '</p>';
echo '<p>' . bar2($c) . '</p>'; 
echo '<p>' . $c . '</p>'; // $c is changed


?>