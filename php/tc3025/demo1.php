<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'Demo 1 - ' . date('l, F jS, Y', (time() - 86400) ); ?></title>
</head>

<body>

<?php
/*
	This is a multi-line or block comment.
	Anything inside the comment delimiters is ignored.
*/

// this is a line comment example.
echo '<p>This space for rent.</p>'; // This is a standard output statement.
echo 'Just the content without markup.';

$some_Value = 367;
echo '<p>The value I set is ' . $some_Value . '.</p>';

$fullName = 'John Doe';
echo '<p>Welcome, ' . $fullName . '!</p>';

$length = 5;
$width = 'hamster';
$area = $length * $width;
echo '<p>The area is ' . $area . '</p>';

$months = array('Jan','Feb','Mar','Apr','May');

echo '<p>The third month is ' . $months[2] . '!</p>';

$months[5] = 'Jun';

$months[] = 'Jul';

$pillbox = array(
				 'Mon' => 'white',
				 'Tue' => 'none',
				 'Wed' => 'purple',
				 'Thu' => 'orange',
				 'Fri' => 'blue',
				 'Sat' => 'green'
				 );

echo "<p>The pill for Friday is " . $pillbox['Fri'] . '!</p>' . "\r\n"; // \r\n is windows newline

$pillbox['Sun'] = 'red';

echo "<p>The area is {$area}cm</p>";
echo "\n"; // "\n" is a new line special character
echo "\t<p>The pill for Friday is {$pillbox['Fri']}!</p>"; // \t is a tab character

echo 'This isn\'t a lot of fun.';

echo '<p>';
// example FOR loop
for ($c = 0; $c < 10; $c++) {
	echo $c . ' ';
}

echo '</p>';


echo '<p>';
// example WHILE loop
$c = 0;
while ($c < 10) {
	echo $c . ' ';
	$c++;
}

echo '</p>';


echo '<p>';
// example FOREACH loop 1
foreach ($months as $month ) {
	echo $month . ' ';
}
echo '</p>';

echo '<p>';
// example FOREACH loop 2
foreach ($pillbox as $day => $pillcolor) {
	echo "The pill for $day is $pillcolor<br />";
}
echo '</p>';


?>









</body>
</html>