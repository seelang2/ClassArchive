<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php

echo '<p>This space for rent.</p>';

$someVar = 'Another line of text.';

$sideA = 3;
$sideB = 'dfgfdsg';

$area = $sideA * $sideB;

echo '<p>The area is ' . $area . '</p>';

echo "<p>{$someVar}sdgsdg</p>";

$weekdays = array('Sun','Mon','Tue');

echo $weekdays[1];

$weekdays[] = 'Wed';

array_push($weekdays, 'Thu','Fri','Sat');

$pillbox = array('Mon' => 'white', 'Tue' => 'none', 'Wed' => 'blue');

echo "<p>Today's pill is {$pillbox['Mon']}.</p>";

$pillbox['Thu'] = 'orange';




?>


</body>
</html>