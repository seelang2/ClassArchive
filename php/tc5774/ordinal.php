<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
</head>
<body>

<?php

$number = 2042;

// find the last digit of the number using the modulo
$lastDigit = $number % 10;

// find the last two numbers
$n = $number / 100; 	// divide number by 100
//echo "<p>N is $n</p>";
$n = $n - floor($n); 	// subtract integer portion from number
//echo "<p>N is $n</p>";
$n = $n * 100; 			// multiply by 100
//echo "<p>N is $n</p>";

//echo "<p>Meanwhile, the last digit is $lastDigit</p>";

switch(true) {
	case $lastDigit == 1 && $n != 11:
		$ordinal = 'st';
	break;
	
	case $lastDigit == 2 && $n != 12:
		$ordinal = 'nd';
	break;
	
	case $lastDigit == 3 && $n != 13:
		$ordinal = 'rd';
	break;
	
	default:
		$ordinal = 'th';
	break;
	
}

echo '<p>The number and ordinal is ' . $number . $ordinal . '.</p>';

?>

</body>
</html>