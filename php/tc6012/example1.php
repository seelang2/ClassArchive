<?php
	// stuff to do before rendering page
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo 'Page Title.'; ?></title>
	<meta charset="UTF-8" />
</head>
<body>

<h1>Welcome!</h1>
<?php
	echo '<p>This space for rent.</p>';
	echo "\n";
	echo '<p>Today is ';
	echo date('l, F jS, Y');
	echo '.</p>' . "\n";
	
	$someValue = 'Some text.';
	
	echo '<p>' . $someValue . '</p>' . "\n";
	
	
	$sideA = 3;
	$sideB = 'fluffyhamster';
	
	$area = $sideA * $sideB;
	echo '<p>The area is ' . $area . '.</p>' . "\n";
	echo "<p>The area is $area.</p>" . "\n";
	
	$weekdays = Array('Sun', 'Mon', 'Tue');
	
	echo '<p>The second weekday is ' . $weekdays[1] . '.</p>' . "\n";
	
	$pillbox = array(
		'Sun' => 'white',
		'Mon' => 'pink',
		'Tue' => 'none',
		'Wed' => 'blue',
		'Thu' => 'orange',
		'Fri' => 'red',
		'Sat' => 'green'
	);
	
	echo "<p>Friday's pill is " . $pillbox['Fri'] . ".</p>" . "\n";
	
	echo "<p>Friday's pill is {$pillbox['Fri']}.</p>" . "\n";

	echo "<p>Today's pill is" . $pillbox[date('D')] . ".</p>\n";
?>

</body>
</html>