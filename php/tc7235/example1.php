<?php

// line comment
/* block comment */


?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	<style type="text/css">
	</style>
	
</head>
<body>

<?php

$someVar = 'This space for rent.';

$sideA = 7;
$sideB = '10';

$area = $sideA * $sideB;

echo '<p>' . $someVar . '</p>';
print '<p>The area of sideA and sideB is ' . $area . '</p>';

echo "<p>{$someVar}, again.</p>";

$weekdays = array('Sun','Mon','Tue','Wed','Thu');

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'n/a',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
); 

$today = 3;

echo '<p>Today is '. $weekdays[$today] . 
	 ' and the pill for today is ' . $pillbox[$weekdays[$today]] . '.</p>';
	 








?>

</body>
</html>