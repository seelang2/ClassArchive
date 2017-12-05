<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'Example1.php'; ?></title>
</head>

<body>

<?php

echo '<h1>This space for rent!</h1>';

$myVar = 'This is a simple paragraph.';

echo '<p>';
echo $myVar;
echo '</p>';
echo "\n";
echo '<p>' . $myVar . '</p>';
echo "\n";
echo '<p>$myVar</p>';
echo "\n";
echo "<p>$myVar</p>";
echo "\n";
$distance = 35;

/*
	Block comment. 
	Any lines between the markers gets ignored.
*/

// \n - unix, \r\n - windows

echo "<p>The distance is $distancemi.</p>" . "\n"; // this is a line comment. anything after the slashes is ignored.

echo '<p>The distance is ' . $distance . 'mi.</p>' . "\n";

echo "<p>The distance is {$distance}mi.</p>\n";

$sideA = 15;
$sideB = 'hamster';

$area = $sideA * $sideB;

echo '<p>The area is ' . $area . '</p>';

$months = array('Jan','Feb','Mar','Apr','May');

echo '<p>' . $months[1] . '</p>';

$months[5] = 'Jun';

$months[] = 'Jul';
$months[] = 'Aug';

echo '<p>There are ' . count($months) . ' elements in the months array.</p>';

array_push($months, 'Sep','Oct','Nov','Dec');

echo '<p>There are now ' . count($months) . ' elements in the months array.</p>';

$pillbox = array('Mon' => 'white',
				 'Tue' => 'none',
				 'Wed' => 'Purple',
				 'Thu' => 'none',
				 'Fri' => 'red',
				 'Sat' => 'green',
				 'Sun' => 'orange');


echo '<p>Wednesday we take the ' . $pillbox['Wed'] . ' pill!</p>';

$pillbox['Bob'] = 'august';

echo '<pre>' . print_r($pillbox, true) . '</pre>';


foreach($months as $value) {
	echo '<p>' . $value . '</p>';
}


echo '<div><table><tbody>' . "\n";

foreach($months as $day => $pilltype) {
	echo '<tr><td>'.$day.'</td><td>'.$pilltype.'</td></tr>' . "\n";
}

echo '</tbody></table></div>' . "\n";





?>


</body>
</html>
