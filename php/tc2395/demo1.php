<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'Demo 1 - TC Class 2395'; ?></title>
</head>
<body>

<?php

echo '<p>This space for rent.</p>';

?>

<h1>Welcome!</h1>

<?php

echo "<p>Now I'm back in PHP mode!</p>";
echo "\n";
echo '<p>I could\'ve done this instead.</p>';

echo '<p>Welcome, ' . "\n" . 'John Doe!</p>';

$some_value = 13;

echo '<p>' . $some_value . '</p>';

echo "<p>The value is $some_value </p>";

$pi = 3.14159276;

$diameter = 25;

$circumference = $pi * $diameter;

echo '<p>The circle with diameter ' . $diameter . ' has a circumference of ' . $circumference . '</p>';

echo $fluffyHamster;

$a = 10;
$b = '20';
$c = $a + (int)$b;

echo '<p>' . $c . '</p>'; 

$days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

echo '<p>' . $days[3] . '</p>'; 

$days[] = 'Sun';

$days[1] = 'Another value';


$pillbox = array(
				 'Sun' => 'orange',
				 'Mon' => 'Nothing',
				 'Tue' => 'Green',
				 'Wed' => 'Purple',
				 'Thu' => 'Nothing',
				 'Fri' => 'Red',
				 'Sat' => 'White'
				 );


echo '<p>' . $pillbox['Wed'] . '</p>'; 

$pillbox['Bob'] = 'rainbow';

// iterate through values only
foreach ($pillbox as $value) {
	echo '<p>' . $value . '</p>' . "\n";
}

// iterate through both keys and values
foreach ($pillbox as $key => $value) {
	echo '<p>' . $key . ' = ' . $value . '</p>' . "\n";
}


?>








</body>
</html>