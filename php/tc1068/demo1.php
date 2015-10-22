<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo 'Demo 1: PHP Basics'; ?></title>
</head>
<body>
<?php

echo '<p>Hello Site Visitor!</p>';

$number = 7;
$number = $number + 234324;

echo "<p>Current value of number is: $number </p>";

$today = date('m-d-Y');

echo '<p>Today is ' . $today . '</p>';

$pillbox = array('orange', 'red', 'purple', 'blue', 'green');

echo "<p>Wednesday's pill is " . $pillbox[2] . '</p>';

$pillbox[] = 'white';

$better_pillbox = array(
						'Monday' => 'white',
						'Tuesday' => 'red',
						'Wednesday' => 'purple',
						'newarray' => $pillbox // $better_pillbox['newarray'][2]
						);

echo '<p>The pill for Monday is ' . $better_pillbox['Monday'] . '</p>';

echo '<p>';
for($c = 1; $c < 11; $c++) {
	echo $c . ' ';
}
echo '</p>';


echo '<p>';
$c = 1;
while($c < 11) {
	echo $c . ' ';
	$c++;
}
echo '</p>';




?>
</body>
</html>
