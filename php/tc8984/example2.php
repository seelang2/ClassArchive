<!doctype html>
<html>
<head>
	<!-- The head section contains information about the document, but is not the content. -->
	<meta charset="UTF-8" />
	<title>Page title</title>

</head>
<body>
<!-- 
	The body section contains the actual content of the document to be rendered.
-->

<?php
/*
	All the PHP content on the page must be contained within opening and closing 
	PHP tags like this.
*/

$text = 'This space for rent.';

$x = 'Don\'t do this.'; // Escape quotes with a backslash
$x = "don't do this"; // Or simply nest quote types like this 

echo '<h1>'; 
echo strtoupper($text); 
echo '</h1>'; 

echo '<h1>'; 
echo '$text'; 
echo '</h1>'; 

echo '<h1>'; 
echo "$text"; 
echo '</h1>'; 

echo '<h1>' . $text . '</h1>';

echo "<h1>{$text}dfgljdf</h1>";

$sideA = 3;
$sideB = '10';

echo '<p>The area is ' . ($sideA * $sideB) . '.</p>';

/* 
	The $$ is used to use a variable as a variable name.
*/
$name = 'text';
echo '<h1>' . $$name . '</h1>';

define('SITE_NAME','localhost'); // defines constant SITE_NAME
echo '<h1>' . SITE_NAME . '</h1>';

// basic numerical array
$days = array('Sun','Mon','Tue'); // index starts at 0
echo '<h1>' . $days[1] . '</h1>';
$days[] = 'Wed'; // appends a single new value to the end of the array

array_push($days, 'Thu', 'Fri', 'Sat'); // appends one or more elements

echo '<pre>' . print_r($days, true) . '</pre>';

// associative arrays using text key names
$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
);

echo '<p>Tuesday\'s pill is ' . $pillbox['Tue'] . '</p>';
$pillbox['Bob'] = 'technicolor';
echo '<pre>' . print_r($pillbox, true) . '</pre>';


?>


</body>
</html>