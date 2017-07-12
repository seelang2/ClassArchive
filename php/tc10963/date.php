<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'My page'; ?></title>

	<style type="text/css">
	</style>

</head>
<body>

<p>Today is <?php echo date('l, F jS, Y'); ?>.</p>

<?php

echo '<p>Today is ' . date('l, F jS, Y') . '.</p>';
/*
$weekdays = [
	'Sunday',
	'Monday',
	'Tuesday',
	'Wednesday',
	'Thursday',
	'Friday',
	'Saturday'
];
*/

$weekdays = [
	'日曜日 (nichiyoubi)',
	'月曜日 (getsuyoubi)',
	'火曜日 (kayoubi)',
	'水曜日 (suiyoubi)',
	'木曜日 (mokuyoubi)',
	'金曜日 (kinyoubi)',
	'土曜日 (doyoubi)'
];

echo '<p>ima wa ' . $weekdays[date('w')] . ' desu.</p>';

$months = [
	'1月 (ichigatsu)',
	'2月 (nigatsu)',
	'3月 (sangatsu)',
	'4月 (shigatsu)',
	'5月 (gogatsu)',
	'6月 (rokugatsu)',
	'7月 (shichigatsu)',
	'8月 (yogatsu)',
	'9月 (kugatsu)',
	'10月 (juugatsu)',
	'11月 (juuichigatsu)',
	'12月 (juunigatsu)'	
];

echo '<p>kore wa ' . $months[date('n') - 1] . ' desu.</p>';

echo '<p>ima wa ' . 
		$weekdays[date('w')] . ', ' . 
		$months[date('n') - 1] . ' ' . 
		date('jS') . ', ' . 
		date('Y') . '.</p>';



?>

</body>
</html>