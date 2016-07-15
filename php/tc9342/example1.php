<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	</style>
</head>
<body>

<?php

echo '<p>This space for rent.</p>';

$someVar = "This space isn't for rent.";

echo '<p>' . $someVar . '</p>';

$sideA = '10';
$sideB = 7;

echo '<p>The area is ' . ($sideA * $sideB) . '.</p>';

$days = array('Monday', 'Tuesday');

echo '<p>' . $days[0] . '</p>';

$today = 1;
echo '<p>' . $days[$today] . '</p>';

// add items to the end of an array
array_push($days, 'Wednesday', 'Thursday', 'Friday');

echo '<p>There are ' . count($days) . ' days.</p>';

$pillbox = array(
	'Sunday' => 'white',
	'Monday' => 'white',
	'Tuesday' => 'none',
	'Wednesday' => 'blue',
	'Thursday' => 'orange',
	'Friday' => 'red',
	'Saturday' => 'green'
);

echo '<p>Today\'s pill is ' . $pillbox['Wednesday'] . '.</p>';

//$today = date('');

echo '<p>Today is ' . date('l, F jS, Y') . '.</p>';

?>


</body>
</html>