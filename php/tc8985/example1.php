<?php

$message = 'This space for rent.';

?>
<doctype html>
<html>
<head>
	<title><?php echo 'Dynamic Title'; ?></title>

</head>
<body>

<?php

echo '<p>';
echo $message;
echo '</p>';

echo '<p>' . $message . '</p>';

echo "<p>{$message}sgdsfg</p>";

// echo '<p>Don't do this.</p>';
echo '<p>This\'ll work, though.</p>';
echo "<p>This'll work as well.</p>";

$sideA = '10';
$sideB = 3;

echo '<p>The area is ' . $sideA * $sideB . '.</p>';

$weekdays = array('Sun', 'Mon', 'Tue');

echo '<p>' . $weekdays[1] . '</p>';

$weekdays[] = 'Wed';

echo '<pre>'.print_r($weekdays, true).'</pre>';

array_push($weekdays, 'Thu', 'Fri', 'Sat');

echo '<pre>'.print_r($weekdays, true).'</pre>';

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
);

echo '<pre>'.print_r($pillbox, true).'</pre>';

$pillbox['Bob'] = 'technicolor';

echo '<pre>'.print_r($pillbox, true).'</pre>';

//echo "<p>{$pillbox[0]}</p>"; // undefined offset

$pillbox[0] = 'yellow';

echo '<pre>'.print_r($pillbox, true).'</pre>';

echo "<p>{$pillbox[0]}</p>";

$pillbox[] = 'purple';

echo '<pre>'.print_r($pillbox, true).'</pre>';

echo "<p>Today's pill is {$pillbox[$weekdays[date('w')]]}.</p>";

?>

<body>
</html>