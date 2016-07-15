<?php
// set the language to use
$lang = 'JP';

// define arrays for weekday and month labels
$weekdays = array(
	'EN' => array(
		'Sunday',
		'Monday',
		'Tuesday',
		'Wednesday',
		'Thursday',
		'Friday',
		'Saturday'
	),
	'JP' => array(
		'日曜日',
		'月曜日',
		'火曜日',
		'水曜日',
		'木曜日',
		'金曜日',
		'土曜日'
	)
);

// ex: $weekdays['EN'][3]

$months = array(
	'EN' => array(
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
	),
	'JP' => array(
		'１月',
		'２月',
		'３月',
		'４月',
		'５月',
		'６月',
		'７月',
		'８月',
		'９月',
		'１０月',
		'１１月',
		'１２月'
	)
);

// get array values for today's date
$dayNum = date('w');
$monthNum = date('n') - 1; // date('n') returns 1-12

// output message
echo '<p>' . 
		$weekdays[$lang][$dayNum] . ', ' .
		date('j') . ' ' .
		$months[$lang][$monthNum] . ' ' .
		date('Y') .
	 '</p>';



