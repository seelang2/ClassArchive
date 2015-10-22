<?php

$demoNumber = 1;

$pageTitle = 'TC Class 2514 Demo ' . $demoNumber;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle . ' ' . date('l, F jS, Y G:ia'); ?></title>
</head>

<body>

<?php 

echo '<h1>Welcome to Demo 1!</h1>';

$a = 3;
$b = 'This is not a valid number!';
$c = $a + $b;

$someVal = false;

echo '<p>C is ' . $c . '</p>';
echo '<p>Some value is ' . $someVal . '</p>';

echo "<p>The value of C is $c </p>";

echo 'Don\'t try this at home.';


$weekdays = array('Sun','Mon','Tue','Wed','Thu');

echo '<p>The third element in weekdays is ' . $weekdays[2] . '</p>';

echo '<p>There are ' . count($weekdays) . ' elements in weekdays.</p>';

$weekdays[] = 'Fri';

$pillbox = array('Sun' => 'white',
				 'Mon' => 'none',
				 'Tue' => 'orange',
				 'Wed' => 'purple',
				 'Thu' => 'green',
				 'Fri' => 'red'
				 );

$pillbox['Sat'] = 'blue';


?>


</body>
</html>