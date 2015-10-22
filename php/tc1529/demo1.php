<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php ?></title>
</head>
<body>

<?php
/*
	Multi-line comment
*/
// line comment. 

// send output
echo '<p>Whatever</p>';

echo "\n" . '<p>Today is ' . date('m-d-Y') . '</p>';

echo '<p>You can\'t do this!</p>';
echo "<p>We could've done this instead.</p>";

// echo '<table border="0" cellpadding="3" cellspacing="0">';
// echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";

$myVariable = 3;

echo '<p>' . $myVariable . '</p>';

$a = 2;
$b = '5.25';
$c = $a + (float)$b;
echo '<p>' . $c . '</p>';

echo "<p>The value of a is {$a}text </p>"; // the braces {} are scope operators

$week = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri');

echo $week[2];

$week[] = 'Sat';
$week[] = 'Sun';

$week[1] = 'Tuesday';


// associative arrays
$pillbox = array(
				 'Sun' => 'white',
				 'Mon' => 'blue',
				 'Tue' => 'red',
				 'Wed' => 'purple',
				 'Thu' => 'orange'
				 };

echo $pillbox['Tue'];

$pillbox['Sat'] = 'technicolor';

echo '<p>The number of elements in the pillbox is ' . count($pillbox) . '</p>';

$_

?>


</body>
</html>