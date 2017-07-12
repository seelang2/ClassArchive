<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

$sideA = 20;
$sideB = 6;

echo '<p>The area is ' . $sideA * $sideB . '.</p>';

$sideA = '20';
$sideB = 6;

echo '<p>The area is ' . $sideA * $sideB . '.</p>';

$a = 1;
$a++; // $a = $a + 1;
echo '<p>' . $a . '</p>';

$b = 1;
echo '<p>' . $b++ . '</p>';
echo '<p>' . $b . '</p>';

/*
The above is equivalent to: 
echo $b;
$b++;
echo $b;
*/

$b = 1;
echo '<p>' . ++$b . '</p>';
echo '<p>' . $b . '</p>';

/*
The above is equivalent to: 
$b++;
echo $b;
echo $b;
*/


?>

</body>
</html>