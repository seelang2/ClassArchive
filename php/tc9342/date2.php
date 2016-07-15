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
		'nichiyoubi',
		'gatsuyoubi',
		'kayoubi',
		'suiyoubi',
		'mokuyoubi',
		'kinyoubi',
		'doyoubi'
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
		'ichigatsu',
		'nigatsu',
		'sangatsu',
		'yongatsu',
		'gogatsu',
		'rokugatsu',
		'nanagatsu',
		'hachigatsu',
		'kugatsu',
		'jugatsu',
		'juichigatsu',
		'junigatsu'
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



