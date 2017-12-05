<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
</head>
<body>

<?php

function getOrdinal($number) {
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
	return $ordinal;
} // getOrdinal


for ($c = 0; $c < 301; $c++) {

	echo '<span>The number and ordinal is ' . $c . getOrdinal($c) . '.</span><br />';
	
} // for $number
?>

</body>
</html>