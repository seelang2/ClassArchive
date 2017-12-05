<!DOCTYPE html>
<?php

?>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'Page Title'; ?></title>
</head>
<body>

<?php 

echo '<p>This space for rent.</p>';

echo "\n";

print('<p>This will work as well.</p>');

$someValue = 'This space for rent.';

echo '<p>';
echo $someValue;
echo '</p>';

echo '<p>' . $someValue . '</p>';
echo "<p>$someValue</p>";
echo "<p>{$someValue}adfgdfsg</p>";

$sideA = ' 10';
$sideB = 3;

$area = $sideA * $sideB;
$perimeter = $sideA + $sideB + $sideA + $sideB;

echo "<p>The area is {$area} and the perimeter is {$perimeter}.</p>";


$weekdays = array('Sun','Mon','Tue');

echo "<p>The second element is {$weekdays[1]}.</p>";

echo '<p>There are ' . count($weekdays) . ' elements in $weekdays.</p>';

$weekdays[] = 'Wed';

echo '<p>There are ' . count($weekdays) . ' elements in $weekdays.</p>';


$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
);

echo '<p>Monday\'s pill is ' . $pillbox['Mon'] . '</p>';

$today = 'Mon';

echo '<p>Today\'s pill is ' . $pillbox[$today] . '</p>';

$pillbox[] = 'rainbow';

echo '<pre>' . print_r($pillbox, true) . '</pre>';


foreach ($weekdays as $dayname) {
	echo "<p>{$dayname}</p>";
}

foreach ($pillbox as $day => $pill) {
	echo "<p>{$day}'s pill is {$pill}</p>";
}







?>

</body>
</html>