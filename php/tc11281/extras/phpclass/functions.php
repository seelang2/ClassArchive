<?php 


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo 'Document copyright &copy ' . date('Y'); ?></title>
</head>
<body>

<?php

function greeting() {
	echo '<p>Hello!</p>';
}

greeting(); // executes function

function betterGreeting() {
	return 'Hello!'; // terminate function with optional value
}

echo '<h1>' . strtoupper(betterGreeting()) . '</h1>';

function square($a) {
	$s = $a * $a;
	return $s;
}

echo '<p>The square is ' . square(5) . '</p>';

function area($a, $b = 10) {
	return $a * $b;
}

echo '<p>The area is ' . area(5) . '</p>';

// function scope is separate from global scope
// arguments (parameters) are copied into the function scope
// pass by copy
function foo($a) {
	$a = 100;
	return $a;
}

$a = 10;

echo "<p>The value of a is $a</p>";
echo '<p>The value of the returned a is ' . foo($a) . '</p>';
echo "<p>The value of a is $a</p>";

// pass by reference
// putting the & in front of the argument makes it a reference
// to the original value rather than a copy
function bar(&$a) {
	$a = 100;
	return $a;
}

$a = 10;

echo "<p>The value of a is $a</p>";
echo '<p>The value of the returned a is ' . bar($a) . '</p>';
echo "<p>The value of a is $a</p>";



?>

</body>
</html>