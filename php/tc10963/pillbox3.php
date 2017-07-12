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

// create labels for weekdays
$dayLabels = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

$today = date('w'); // retrieve the current day of the week and store in variable
$pillIndex = date('D'); // get day matching pillbox index - Sun, Mon, Tue...

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
$count = count($dayLabels); // count the elements in the array ONCE
for ($c = 0; $c < $count; $c++) {

	echo '<div class="day';
	if ($today == $c) echo ' today';
	echo '">';
	echo '<h2>';
	echo $dayLabels[$c];
	echo '</h2>';
	echo '<p>' . $pillbox[$pillIndex] . '</p>'; // $pillbox['Tue']
	echo '</div>';

}




?>

</body>
</html>