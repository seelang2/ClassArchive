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

<div class="day<?php if ($today == 'Sun') echo ' today'; ?>">
	<h2>Sunday</h2>
	<p><?php echo $pillbox['Sun'] ?></p>
</div>

<div class="day<?php if ($today == 'Mon') echo ' today'; ?>">
	<h2>Monday</h2>
	<p><?php echo $pillbox['Mon'] ?></p>
</div>

<div class="day<?php if ($today == 'Tue') echo ' today'; ?>">
	<h2>Tuesday</h2>
	<p><?php echo $pillbox['Tue'] ?></p>
</div>

<div class="day<?php if ($today == 'Wed') echo ' today'; ?>">
	<h2>Wednesday</h2>
	<p><?php echo $pillbox['Wed'] ?></p>
</div>

<div class="day<?php if ($today == 'Thu') echo ' today'; ?>">
	<h2>Thursday</h2>
	<p><?php echo $pillbox['Thu'] ?></p>
</div>

<div class="day<?php if ($today == 'Fri') echo ' today'; ?>">
	<h2>Friday</h2>
	<p><?php echo $pillbox['Fri'] ?></p>
</div>

<div class="day<?php if ($today == 'Sat') echo ' today'; ?>">
	<h2>Saturday</h2>
	<p><?php echo $pillbox['Sat'] ?></p>
</div>

</body>
</html>