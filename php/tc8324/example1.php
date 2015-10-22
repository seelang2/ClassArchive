<?php

// variables are case sensitive, start with a $, and are alphanumeric
// plus - _

$output = 'Some stuff to display here.';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'My Page' ?></title>
	<style type="text/css">
	</style>
</head>
<body>

<?php
// This block isn't seen in the client output

echo '<p>This is \'somewhat\' dynamic content.</p>';

echo '<h3>' . $output . '</h3>';

$sideA = 'fluffyhamster';
$sideB = 3;

$area = $sideA * $sideB;
$perimeter = $sideA + $sideB + $sideA + $sideB;

echo '<p>The area is ' . $area . ' and the perimeter is ' . $perimeter . '.</p>';

$weekdays = array('Sunday', 'Monday', 'Tuesday');

echo '<p>' . $weekdays[1] . '</p>';

echo '<p>There are currently ' . count($weekdays) . ' weekdays.</p>';

$weekdays[] = 'Wednesday';
array_push($weekdays, 'Thursday', 'Friday', 'Saturday');

echo '<p>There are currently ' . count($weekdays) . ' weekdays.</p>';

/*
Note that here we have to manually add in the numeric key indexes
to the associative array to be able to access the values both
with key names and index numbers.
*/
$pillbox = array(
	'Sunday' => 'white',
	'0' => 'white',
	'Monday' => 'white',
	'1' => 'white',
	'Tuesday' => 'none',
	'2' => 'none',
	'Wednesday' => 'blue',
	'Thursday' => 'orange',
	'4' => 'orange',
	'Friday' => 'red',
	'5' => 'red',
	'Saturday' => 'green',
	'6' => 'green'
);

echo "<p>Wednesday's pill is " . $pillbox['Wednesday'] . ", Alice.</p>";

$pillbox['Bob'] = 'technicolor';


?>

<p>This space for rent.</p>

<?php 

echo '<p>Today is ' . date('w, F jS, Y') . '.</p>' . 
	 '<p>Don\'t forget to take the ' . $pillbox[date('w')] . ' pill today.</p>';

// internationalization example
$weekdays_jp = array(
	'nichiyoubi',
	'getsuyoubi',
	'kayoubi',
	'suiyoubi',
	'mokuyoubi',
	'kinyoubi',
	'douyoubi'	
);
	 
echo '<p>ima wa ' . $weekdays_jp[date('w')] . ' desu.</p>'; 


// multilingual example
$lang = 'JP';

$weekdays_ml = array();
$weekdays_ml['EN'] = array('Sunday','Monday','Tuesday','Wednesday');
$weekdays_ml['JP'] = array('nichiyoubi','getsuyoubi','kayoubi','suiyoubi');

echo '<p>' . $weekdays_ml[$lang][date('w')] . '</p>';
?>


</body>
</html>