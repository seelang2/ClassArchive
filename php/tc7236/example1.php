<?php

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'Sample Page. ' . date('m-d-Y'); ?></title>
	
	<style type="text/css"></style>
</head>
<body>

<?php

echo '<p>This space for rent.</p>';

$someValue = 'This space for rent.';

echo '<p>';
echo $someValue;
echo '</p>';
echo "\r\n";

echo '<p>' . $someValue . '</p>' . "\n";

echo "<p>$someValue</p>\n";

$sideA = '10.73412';
$sideB = 7;

$area = $sideA * $sideB;
/*
	PHP is loosely typed, but can be force cast by putting (type)
	in front of the variable.
*/

echo '<p>The area is ' . (string)$area . '.</p>'; // casts variable into string


$weekdays = array('Sun', 'Mon', 'Tue', 'Wed');

$weekdays[4] = 'Thu';
$weekdays[33] = 'Sat';


echo '<p>The third day is ' . $weekdays[22] . '</p>';

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'blue',
	'Sat' => 'green'
);


echo "<p>Tuesday's pill is " . $pillbox['Tue'] . '.</p>';

$weekdays['Mon'] = 'none';
$weekdays['Bob'] = 'technicolor';

$weekdays[] = 'Fri';


print_r($weekdays);
echo '<br />';

echo json_encode($pillbox);
echo '<br />';

echo json_encode($weekdays);
echo '<br />';


echo json_encode(array('A','B','C','D'));
?>


</body>
</html>	