<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php

echo '<p>Hello World!</p>';

$var1 = "This Space For Rent";

echo "<p>$var1</p>";

echo '<p>Let\'s ' . 'do this!</p>';


$weekdays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri');

echo $weekdays[0] . '<br />';
echo $weekdays[1] . '<br />';
echo $weekdays[2] . '<br />';
echo $weekdays[3] . '<br />';
echo $weekdays[4] . '<br />';

$week2 = array(
			'Mon' => 'Day 1', 
			'Tue' => 'Day 2', 
			'Wed' => 'Day 3', 
			'Thu' => 'Day 4', 
			'Fri' => 'Day 5'
);

echo $week2['Mon'] . '<br />';
echo $week2['Tue'] . '<br />';
echo $week2['Wed'] . '<br />';
echo $week2['Thu'] . '<br />';
echo $week2['Fri'] . '<br />';


echo "<hr>";

foreach ($weekdays as $day) {
	echo "<p>$day</p>";
}


foreach ($week2 as $key => $value) {
	echo "<p>Keyname: $key => Value: $value</p>";
}

?>




</body>
</html>
