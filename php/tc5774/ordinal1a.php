<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
</head>
<body>

<?php


for ($number = 0; $number < 301; $number++) {
	// find the last digit of the number using the modulo
	$lastDigit = $number % 10;
	// find the last two numbers
	$n = round((($number / 100) - floor($number / 100)) * 100);
	
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

	echo '<span>The number and ordinal is ' . $number . $ordinal . 
		 ' n = ' . $n . ' last digit is ' . $lastDigit . '.</span><br />';
} // for $number
?>

</body>
</html>