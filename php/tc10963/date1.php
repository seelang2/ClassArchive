<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'My page'; ?></title>

	<style type="text/css">
	</style>

</head>
<body>

<?php

$weekdays = [
	'EN' => [
			'Sunday',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday'
		],
	'JP' => [
			'日曜日',
			'月曜日',
			'火曜日',
			'水曜日',
			'木曜日',
			'金曜日',
			'土曜日'
		]
];


$lang = 'JP';

echo '<p>' . $weekdays[$lang][date('w')] . '</p>';




?>

</body>
</html>