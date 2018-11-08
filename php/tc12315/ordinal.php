<?php
// determine the correct ordinal for any given number

$number = 94967291;

// get the last digit of the number and save in a variable
$lastDigit = $number % 10;

// get the last 2 digits of the number and save it a variable
$last2Digits = $number % 100;

/*
// if the number ends in 1 and not 11 the ordinal is 'st'
if ($lastDigit == 1 && $last2Digits != 11) {
	$ordinal = 'st';
// if the number ends in 2 and not 12 the ordinal is 'nd'
} else if ($lastDigit == 2 && $last2Digits != 12) {
	$ordinal = 'nd';
// if the number ends in 3 and not 13 the ordinal is 'rd'
} else if ($lastDigit == 3 && $last2Digits != 13) {
	$ordinal = 'nd';
// for anything else the ordinal is 'th'
} else {
	$ordinal = 'th';
}
*/

switch(true) {
	// if the number ends in 1 and not 11 the ordinal is 'st'
	case $lastDigit == 1 && $last2Digits != 11:
		$ordinal = 'st';
	break;
	// if the number ends in 1 and not 11 the ordinal is 'nd'
	case $lastDigit == 2 && $last2Digits != 12:
		$ordinal = 'nd';
	break;
	// if the number ends in 1 and not 11 the ordinal is 'rd'
	case $lastDigit == 3 && $last2Digits != 13:
		$ordinal = 'rd';
	break;
	// for anything else the ordinal is 'th'
	default:
		$ordinal = 'th';
	break;
}

// display the ordinal with the number

echo '<p>' . $number . $ordinal . '</p>';


?>