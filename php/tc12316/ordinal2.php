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

echo '<p>234'.getOrdinal(234).'</p>';
echo '<p>3453'.getOrdinal(3453).'</p>';
echo '<p>2321'.getOrdinal(2321).'</p>';
echo '<p>4627'.getOrdinal(4627).'</p>';
echo '<p>45'.getOrdinal(45).'</p>';
echo '<p>1233'.getOrdinal(1233).'</p>';
echo '<p>23563'.getOrdinal(23563).'</p>';

