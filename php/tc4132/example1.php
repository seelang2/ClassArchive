<?php


?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'TC Class 4132 | Today is ' . date('d-m-Y'); ?></title>
</head>

<body>

<?php

echo '<h1>Greetings!</h1>';

$someValue = 'This space for rent.';

echo '<p>' . $someValue . '</p>';

echo "<p>$someValue</p>";

$weekdays = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu');

echo '<p>' . $weekdays[1] . '</p>';

echo '<p>There are ' . count($weekdays) . ' elements in the array.</p>';
// line comment
/*
	block comment
*/



$pillbox = array('Sun' => 'white',
				 'Mon' => 'none',
				 'Tue' => 'orange',
				 'Wed' => 'purple',
				 'Thu' => 'orange',
				 'Fri' => 'green',
				 'Sat' => 'red'
				);
				
echo '<p>Tuesday\'s pill is ' . $pillbox['Tue'] . '</p>';

echo "<p>Today's pill is " . $pillbox[date('D')] . '</p>';

echo "<p>Today's pill is " . $pillbox[$weekdays[date('w')]] . '</p>';





?>








</body>
</html>