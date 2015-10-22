<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'Demo1.php Sample Document. ' . date('l, F jS, Y g:ia'); ?></title>
</head>

<body>


<?php

echo '<p>Hello World!</p>';

$name = 'John Doe';

echo '<p>Hello, ' . $name . '!</p>';


$a = 5;
$b = 'Ham sandwich';

$sum = $a + $b;

echo '<p>The sum is: ' . $sum . '<p>';


$days = array('Sun','Mon',4,'Wed',$sum,'Fri');

echo '<p>Day 3 is ' . $days[2] . '</p>';

$days[] = 'Sat';

$days[3] = 'Bob';


$pillbox = array(
				 'Sun' => 'white',
				 'Mon' => 'none',
				 'Tue' => 'orange',
				 'Wed' => 'purple',
				 'Thu' => 'red',
				 'Fri' => 'blue',
				 'Sat' => 'green'
				 );

$today = 'Wed';

// echo "\n";

// echo "\r\n";

/*
block comment
*/
echo "\n" . '<p>Today\'s pill is ' . $pillbox[date('D')] . "!<p>";

echo "\n<p>The \$euro value of today is {$today}st.</p>";


foreach ($days as $value) {
	echo '<p>This day has a value of ' . $value . '</p>';
}


foreach ($pillbox as $key => $value) {
	echo '<p>Day ' . $key . ' has a value of ' . $value . '</p>';
}



?>













</body>
</html>