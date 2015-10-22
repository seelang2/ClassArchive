<?php

?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'My Page'; ?></title>
</head>

<body>

<?php

echo '<p>This space for rent.</p>';

echo '<p>Today is ' . date('l, F jS, Y g:ia') . '.</p>'; // concatenate the values into a single string

$myVar = 'Some text string here.';

/* Variables are generic boxes to contain values */
echo '<p>' . $myVar . '</p>';

$firstName = 'John';
$lastName = 'Doe';

echo '<p>Contact name: ' . $firstName . ' ' . $lastName . '</p>';

$sideA = 10;
$sideB = 'fluffy hamster';

$area = $sideA * $sideB;
echo '<p>The area is ' . $area . '</p>';

$weekdays = array('Sun','Mon','Tue','Wed');

echo '<p>' . $weekdays[0] . '</p>';

$weekdays[] = 'Thu';

echo '<p>There are ' . count($weekdays) . ' elements in the array.</p>';

$pillbox = array('Sun' => 'white',				 
				 'Mon' => 'orange',
				 'Tue' => 'none',
				 'Wed' => 'purple',
				 'Thu' => 'red',
				 'Fri' => 'blue',
				 'Sat' => 'green');

echo '<p>Thursday\'s pill is ' . $pillbox['Thu'] . '.</p>';

$pillbox['Bob'] = 'rainbow';

echo '<p>Today\'s pill is ' . $pillbox[date('D')] . '.</p>';

echo '<p>Today\'s pill is ' . $pillbox[$weekdays[date('w')]] . '.</p>';






?>




</body>
</html>