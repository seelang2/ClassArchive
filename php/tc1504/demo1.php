<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php ?></title>
</head>
<body>

<?php

// line comment
/*
	block comment
*/

echo '<p>This space for rent.</p>';
echo "\r\n";
print '<p>This will also output to the browser.</p>';

$value = 'Anything I' . ' want.';

echo $value;

$value = 345.934;

echo $value;

$sum = $value + 3 + '4';

echo '<p>' . $sum . '</p>';
echo "<p>" . $sum . "</p>";
echo "<p>$sum</p>";


$pillbox = array('Mon', 'Tue', 'Wed');
echo '<p>' . $pillbox[2] . '</p>';

$pillbox[] = 'Thu';

$better_pillbox = array(
						'Mon' => 'white',
						'Tue' => 'orange',
						'Wed' => 'purple diamond',
						'Thu' => 'green',
						'Fri' => 'red'
						);

echo $better_pillbox['Mon'];
$day = 'Wed';

echo '<p>' . $better_pillbox[$day] . '</p>';


$better_pillbox['Sat'] = 'blue';

echo '<p>Today is ' . date('l, F jS, Y g:ia') . '</p>';
echo '<p>Yesterday was ' . date('l, F jS, Y g:ia', time() - (60*60*24)) . '</p>';







?>

</body>
</html>