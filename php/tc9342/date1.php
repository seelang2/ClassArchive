<?php

// define arrays for weekday and month labels
$weekdays = array(
	'Sunday',
	'Monday',
	'Tuesday',
	'Wednesday',
	'Thursday',
	'Friday',
	'Saturday'
);

$months = array(
	'January',
	'February',
	'March',
	'April',
	'May',
	'June',
	'July',
	'August',
	'September',
	'October',
	'November',
	'December'
);

// get array values for today's date
$dayNum = date('w');
$monthNum = date('n') - 1; // date('n') returns 1-12

// output message
echo '<p>' . 
		$weekdays[$dayNum] . ', ' .
		date('j') . ' ' .
		$months[$monthNum] . ' ' .
		date('Y') .
	 '</p>';



