<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>

<h1>Welcome!</h1>

<?php

$timeZoneOffset = 60 * 60 * 2;

?>

<p>Today is <?php echo date('l, F j, Y g:i a', time() - $timeZoneOffset); ?>!</p>

<?php

echo "<p>Now displaying {$timeZoneOffset}PST<p>\n";

echo '<p>I said "this" - don\'t do this</p>' . "\n";

echo '<p>Value of $timeZoneOffset: ' . $timeZoneOffset . '</p>';

$week = array(
	'Mon' => 'Blue',
	'Tue' => 'Red'
);

echo "<p>Monday's value is {$week['Mon']}</p>";
echo '<p>Tuesday\'s value is ' . $week['Tue'] . '</p>';

$a = 0;

$a += 5;

echo "<p>$a</p>";

$text = 'Hello';
$text .= ' World!';
echo "<p>$text</p>";


//while loop
$c = 1;
while ($c < 11) {
	echo "$c ";
	$c++;
}

echo "<br /><br />";

//for loop
for ($c = 1; $c < 11; $c++) {
	echo "$c ";
}

?>

</body>
</html>
