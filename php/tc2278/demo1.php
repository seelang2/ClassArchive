<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php

echo '<p>Hello World!</p>';
echo "\n";
echo '<p>Don\'t do this at home.</p>';

?>

<h2>Some static content here.</h2>

<?php

echo "<p>And now we're back in code again.</p>" . "\n" . '<p>Another line for effect.</p>';

$some_value = '10:00';

echo '<p>' . ($some_value . 'happy') . '</p>';

echo "<p>The time is {$some_value}pm now.</p>";

$days = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu');

echo '<p>' . $days[2] . '</p>';

$days[] = 'Fri';

?>

<p>The day is <?php echo $days['0']; ?>.</p>

<?php

$pillbox = array(
				 'Sun' => 'white',
				 'Mon' => 'orange',
				 'Tue' => 'none',
				 'Wed' => 'purple',
				 'Thu' => 'red',
				 'Fri' => 'none',
				 'Sat' => 'green'
				 );

echo '<p>' . $pillbox['Tue'] . '</p>';

$pillbox['NewDay'] = 'yellow';

$empty = array();


if ($a == 1) {
	echo 'true';
	echo 'more stuff';
	// and so on
}


// for loop
echo '<p>';
for ($c = 0; $c < 10; $c++) {
	echo $c;
	echo '<br />';
	echo "\n";
}
/*
*/
echo '</p>';
?>




</body>
</html>