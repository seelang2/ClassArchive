<!doctype html>
<html>
<head>
	<title>Page Title <?php echo 'Dynamic Title'; ?></title>
</head>
<body>

<h1>This is a simple HTML page.</h1>

<p>This is a paragraph.</p>

<p>This is <br />another paragraph.</p>



<?php

// line comment. Anything after the slashes are ignored.
/*  Block comment. Anything between the comment tags are ignored.
	Even if multiple lines are inside the comment 'block'.
*/

// Display today's date like this: Wednesday, August 15th, 2018
$today = date('l, F jS, Y');

echo '<p>Today is '; echo $today; echo '</p>';

echo "\n"; // new line special character

echo '<p>This isn\'t is some sample content.</p>';

echo $name; // produces a warning message because $name has not been assigned

$sideA = 'hamburger';
$sideB = 6;

$area = $sideA * $sideB;

// use concatenation to combine strings together
echo '<p>The area is ' . $area . '</p>';

// define a basic numeric array
$weekdays = ['Sun','Mon','Tue','Wed'];

echo '<p>The third day is ' . $weekdays[2] . '.</p>';

array_push($weekdays, 'Thu','Fri','Sat'); // adds new elements to the end of the array

$weekdays[1] = 'Bob'; // element values may be reassigned

// using associative arrays
$pillbox = [
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
];

echo '<p>Today\'s pill is ' . $pillbox['Wed'] . '.</p>';

$day = date('D');
echo '<p>Today\'s pill is ' . $pillbox[$day] . '.</p>';

echo '<p>';
foreach ($weekdays as $day) {
	echo $day . '<br />';
}
echo '</p>';

echo '<p>';
foreach ($pillbox as $day => $pill) {
	echo $day . ' - ' . $pill . '<br />';
}
echo '</p>';





?>


</body>
</html>