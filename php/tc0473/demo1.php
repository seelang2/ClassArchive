<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php

echo "<p>Hello World!</p><p>It's okay to do this, but \"not this\"</p>";

$name = "John Doe";

echo '<p>';
echo $name;
echo '</p>';

echo '<p>' . $name . '</p>';
echo '<p>$name</p>';
echo "<p>$name</p>";

$a = $a + 1;
$a++;

$b = $b + 5;
$b += 5;

$name = "Jane";
$name .= " Doe";


$days = array(
	'Sunday',
	'Monday',
	'Tuesday',
	5
);

echo $day[0];

$days = array(
	'Sun' => 'Red pills',
	'Mon' => 'Blue pill',
	'Tue' => 'purple diamond'
);

echo $days['Mon'];

$key = 'Tue'; echo $days[$key];

?>
</body>
</html>
