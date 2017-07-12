<?php

$pillbox = [
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue', 
	'Thu' => 'orange',
	'Fri' => 'blue',
	'Sat' => 'green'
];

$today = date('D'); // retrieve the current day of the week and store in variable

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Pillbox Demo</title>

	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
	}

	.day {
		width: 400px;
		border: 1px solid #7a7a7a;
		margin-bottom: 1em;
		padding: 0;
	}

	.day h2 {
		background: #000099;
		color: #ffffff;
		margin: 0;
		padding: 0.75em 1em;
	}

	.day p {
	}

	.today {
		color: #ff0000;
	}

	</style>
<body>

<?php

// loop through pillbox data
foreach($pillbox as $day => $pill) {

	echo '<div class="day';
	if ($today == $day) echo ' today';
	echo '">';
	echo '<h2>';

	switch(true) {
		case $day == 'Sun':
			echo 'Sunday';
		break;
		case $day == 'Mon':
			echo 'Monday';
		break;
		case $day == 'Tue':
			echo 'Tuesday';
		break;
		case $day == 'Wed':
			echo 'Wednesday';
		break;
		case $day == 'Thu':
			echo 'Thursday';
		break;
		case $day == 'Fri':
			echo 'Friday';
		break;
		case $day == 'Sat':
			echo 'Saturday';
		break;
	} // switch

	echo '</h2>';
	echo '<p>' . $pill . '</p>';
	echo '</div>';

}




?>

</body>
</html>