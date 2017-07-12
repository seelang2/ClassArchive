<?php

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'My page'; ?></title>

	<style type="text/css">
	</style>

</head>
<body>

<?php
// Anything inside the PHP tags MUST be valid PHP

// line comment. 
/*
block comment
*/

echo '<p>This space for rent.</p>';

$someValue = 'Some value.';

echo '<p>';
echo $someValue;
echo '</p>';

echo "<p>$someValue</p>"; // variable interpolation/substitution
echo "<p>{$someValue}dfghdfghg</p>"; // curly braces can isolate the variable

echo '<p>' . $someValue . '</p>'; // concatenation

$a = 1;
$a++; // shorthand for $a = $a + 1;

$a = 1; 
echo '<p>' . $a++ . '</p>'; // 1
echo '<p>' . $a . '</p>'; // 2

$a = 1; 
echo '<p>' . ++$a . '</p>'; // 2
echo '<p>' . $a . '</p>'; // 2

$a--; // shorthand for $a = $a - 1

$a += 7; // shorthand for $a = $a + 7;
// same for -=, *=, /=, %=

$name = 'John';
$name .= ' Doe'; // $name = $name . ' Doe';


$sideA = 3;
$sideB = '10.234';

$area = $sideA * $sideB;
echo '<p>The area is ' . $area . '.</p>';

//$weekdays = array('Sunday', 'Monday');
$weekdays = ['Monday', 'Tuesday']; // shorthand

echo '<p>' . $weekdays[1] . '</p>'; // Tuesday (arrays use zero-based indexes)

$weekdays[] = 'Wednesday'; // adds value to the end of the array

array_push($weekdays, 'Thursday', 'Friday', 'Saturday');

array_unshift($weekdays, 'Sunday');

echo '<p>The weekdays array has ' . count($weekdays) . ' elements.</p>';

echo '<pre>' . print_r($weekdays, true) . '</pre>';

$firstDay = array_shift($weekdays); // get the first element of the array

echo '<p>' . $firstDay . '</p>';

echo '<pre>' . print_r($weekdays, true) . '</pre>';

$lastDay = array_pop($weekdays); // get the last element of the array

echo '<p>' . $lastDay . '</p>';

echo '<pre>' . print_r($weekdays, true) . '</pre>';


// Associative arrays
$pillbox = [
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue', 
	'Thu' => 'orange',
	'Fri' => 'blue',
	'Sat' => 'green'
];

echo '<pre>' . print_r($pillbox, true) . '</pre>';

// DON'T use array_push/pop/shift/unshift with associative arrays
//array_push($pillbox, 'Bob'); 
$pillbox['Bob'] = 'technicolor';

echo '<pre>' . print_r($pillbox, true) . '</pre>';

echo '<p>Monday\'s pill is ' . $pillbox['Mon'] . '.</p>';

$today = 'Mon';

echo "<p>Today's pill is " . $pillbox[$today] . '.</p>';


?>

</body>
</html>