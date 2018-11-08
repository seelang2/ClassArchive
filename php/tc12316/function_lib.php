<?php

// calculate ordinal of a number
function getOrdinal($number) {
	$lastDigit = $number % 10;
	$last2Digits = $number % 100;

	switch (true) {
		case $lastDigit == 1 && $last2Digits != 11:
			return 'st';
		break;
		case $lastDigit == 2 && $last2Digits != 12:
			return 'nd';
		break;
		case $lastDigit == 3 && $last2Digits != 13:
			return 'rd';
		break;
		default:
			return 'th';
		break;
	}
} // getOrdinal
