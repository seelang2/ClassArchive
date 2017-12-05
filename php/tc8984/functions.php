<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page title</title>

</head>
<body>

<?php

function doStuff() {
	
	$c = 100; // function scope is separate from global scope

	echo $c;
}

function doStuff2() {
	global $c; // import the global value $c into function scope
	$c = 100;

	echo $c;
}

// note that PHP does a pass-by-copy of the value of the token $c
function doStuff3($c) {
	$c = 100; // the local $c is affected but not the original 
	echo '<p>' . $c . '</p>';
}

/*
	the & causes PHP to do a pass-by-reference - instead of copying the
	value of the original token, a reference to the original token is 
	passed instead. Changing the value in the function WILL affect the
	original token's value
*/
function doStuff4(&$c) {
	$c = 100; // the local $c is affected but not the original 
	echo $c;
}

// default values for parameters can be defined
function doStuff5($c = 42, $a = 10) {
	return $c * $a;
}



$c = 10;

echo '<p>' . $c . '</p>';
dostuff3($c);
echo '<p>' . $c . '</p>';

echo '<p>' . $c . '</p>';
dostuff4($c);
echo '<p>' . $c . '</p>';

// the return value 
echo '<p>' . dostuff5($c) . '</p>';

$x = doStuff5(5);
echo '<p>' . $x . '</p>';


?>

</body>
</html>