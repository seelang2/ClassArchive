<?php

$list = array('A', 'B', 'C', 'D');

$list[] = 'E';

echo '<p>' . $list[1] . '</p>';

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
);

echo '<p>' . $pillbox['Wed'] . '</p>';

$pillbox['Bob'] = 'technicolor';

// define and use constant
define('YOUR_STUFF_HERE','yadda^3');
echo '<p>' . YOUR_STUFF_HERE . '</p>';




