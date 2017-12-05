<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo 'This is Example 1'; ?></title>
</head>

<body>

<?php
/* Examples */
echo '<p>This space for rent.</p>';
echo "\r\n"; // use a carriage return (\r) with the new line (\n) for windows and in html email
echo '<p>Here is another line.</p>';

$someVariable = 'Some content here';

echo "<p>$someVariable</p>";
echo '<p>' . $someVariable . '<p>';

$weekdays = array('Sun', 'Mon', 'Tue', 'Wed');

echo $weekdays[1];
$weekdays[2] = 'TUE';

$weekdays[] = 'Thu';

$weekdays[21] = 'Bob';

echo '<pre>';
print_r($weekdays);
echo '</pre>';

$pillbox = array('Sun' => 'Red',
				 'Mon' => 'none',
				 'Tue' => 'Green',
				 'Wed' => 'Purple',
				 'Thu' => 'White',
				 'Fri' => 'Blue',
				 'Sat' => 'Orange');

$pillbox['Bob'] = 'none';

echo '<pre>';
print_r($pillbox);
echo '</pre>';

$a = 3;
$b = 'hamster';
$c = $a * $b;

echo '<p>' . $a . ' and ' . $b . ' and ' . $c . '</p>';




?>


</body>
</html>