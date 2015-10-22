<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'Example 1'; ?></title>
</head>

<body>
<!-- Regular HTML comment. Won't work in PHP. -->

<?php
// Line comment. 
/*
	Block comment for multiline use.
*/
echo '<p>This is my first PHP statement. FEAR ME!</p>' . "\r\n";

echo "<p>I'm so happy right now!</p>\n";

echo "<p style=\"font-weight:bold\">Now what do I do?</p>\n";

date_default_timezone_set('America/Chicago');

$today = date('Y');

echo '<p>Copyright &copy;' . $today . ' TC Class 3454. Some Rights Reserved.</p>' . "\n";

$sideA = 'fluffyhamster';
$sideB = 15;
$area = $sideA * $sideB;

echo '<p>The area of the object is ' . $area . '</p>';


$weekdays = array('Sun','Mon','Tue','Wed','Thu','Fri');

echo '<p>Today is ' . $weekdays[3] . '.</p>';

$weekdays[] = 'Sat'; // adding element 6 to array
$weekdays[1] = 'Bob'; // I never liked Mondays anyway

$pillbox = array(
		 		 'Mon' => 'N/A',
		 		 'Tue' => array('green','white','black'),
		 		 'Wed' => 'purple',
		 		 'Thu' => 'blue',
		 		 'Fri' => 'red',
		 		 'Sat' => 'green',
		 		 'Sun' => 'pink'
				);

echo '<p>Today we are going with the ' . $pillbox['Tue'][0] . ' pill. Rock on.</p>';

$pillbox['Chrisday'] = 'N/A'; // Yay me!

unset($pillbox['Mon']); // delete element

$pillbox[0] = 'Newday';

print_r($weekdays);

echo '<pre>' . print_r($pillbox, true) . '</pre>';


/*
echo '<p>Copyright &copy;';
echo date('Y');
echo ' TC Class 3454. Some Rights Reserved.</p>';
*/
?>


</body>
</html>
