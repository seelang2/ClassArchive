<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'Title here'; ?></title>
</head>

<body>

<?php

$someVar = 'A value';

echo "<p>$someVar.</p>" . "\n";
echo '<p>$someVar.</p>' . "\n";
echo "<p>{$someVar}dfhsdfh.</p>" . "\n";
echo '<p>' . $someVar . '.</p>';

echo 'sdfsdf5' * 5;

$days = array('Sun','Mon','Tue');

echo '<p>' . $days[2] . '</p>';

$days[] = 'Wed';

array_push($days, 'Thu','Fri','Sat');

echo '<p>There are ' . count($days) . ' elements in the array.</p>';

echo '<p>The last day was ' . array_pop($days) . '.</p>';

echo '<p>There are now ' . count($days) . ' elements in the array.</p>';

echo '<p>The first day was ' . array_shift($days) . '.</p>';

array_unshift($days, 'Bob');

//print_r($days);


echo '<pre>' . print_r($days, true) . '</pre>';

$pillbox = array('Sun' => 'white',
				 'Mon' => 'yellow',
				 'Tue' => 'none',
				 'Wed' => 'purple',
				 'Thu' => 'orange',
				 'Fri' => 'red',
				 'Sat' => 'green'
				 );

echo '<p>Wednesday\'s pill is ' . $pillbox['Wed'] . '</p>';

$pillbox['Bob'] = 'rainbow';


echo '<pre>' . print_r($pillbox, true) . '</pre>';

array_push($pillbox, 'What?');

echo '<pre>' . print_r($pillbox, true) . '</pre>';

if (1 AND 1) echo 'true';

echo '<pre>' . print_r($_SERVER, true) . '</pre>';


?>
</body>
</html>