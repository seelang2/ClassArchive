<?php

// calculate ordinal of a number

$number = 12354132;

$lastDigit = $number % 10;
$last2Digits = $number % 100;

switch (true) {
	case $lastDigit == 1 && $last2Digits != 11:
		$ordinal = 'st';
	break;
	case $lastDigit == 2 && $last2Digits != 12:
		$ordinal = 'nd';
	break;
	case $lastDigit == 3 && $last2Digits != 13:
		$ordinal = 'rd';
	break;
	default:
		$ordinal = 'th';
	break;
}


echo '<p>'.$number.$ordinal.'</p>';

