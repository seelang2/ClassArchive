<?php 
/*
	Block comments can span multiple lines
*/

$pageTitle = 'My Page'; // variable assignment

define('MY_DOMAIN','http://localhost/tc5774/'); // constant declaration

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<meta charset="UTF-8" />
	
</head>
<body>

<h1>Welcome!</h1>
<p>This is a sample paragraph.</p>

<?php

echo '<p>This space for rent.</p>' . "\n";

echo '<p>';
echo date('d/m/Y');
echo '</p>';

$someText = 'Another line for rent.';

echo '<p>' . 
	 $someText . 
	 '</p>';

echo "<p>{$someText}extratextgoeshere</p>\n";

echo "<p>" . MY_DOMAIN . "</p>";

//echo 'Don't do this.';
echo "Don't do this.";
echo 'Don\'t do this.';

$sideA = '10';
$sideB = 3;

echo '<p>The area is ' . $sideA * $sideB . '.</p>';

$weekdays = array('Sun', 'Mon', 'Tue'); // numeric array

echo '<p>The second day is ' . $weekdays[1] . '.</p>';

//$weekdays[0] = 'Bob'; // direct assignment of element 0 to a new value

$weekdays[] = 'Wed'; // append new value to end of the array

array_push($weekdays, 'Thu', 'Fri', 'Sat');

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'purple',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
);

echo '<p>Friday\'s pill is ' . $pillbox['Fri'] . '.</p>';

$dayname = 'Tue';
echo '<p>Tuesday\'s pill is ' . $pillbox[$dayname] . '.</p>';


echo '<p>Today\'s pill is ' . $pillbox[date('D')] . '.</p>';

echo '<p>Today\'s pill is ' . $pillbox[$weekdays[date('w')]] . '.</p>';


?>


</body>
</html>