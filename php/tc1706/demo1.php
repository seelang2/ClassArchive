<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'MyTitle!'; ?></title>
</head>
<body>

<?php

echo "<p>This space \"is\" for rent</p>";
echo "\r\n";
print '<p>Another paragraph.</p>';

$today = time();

echo '<p>Today is ' . date('l, F jS, Y g:ia', $today) . '.</p>';

$lastWeek = $today - (60 * 60 * 24 * 7);

echo '<p>Last week was ' . date('l, F jS, Y g:ia', $lastWeek) . '.</p>';

echo '<p>Last week\'s timestamp was ' . $lastWeek . '</p>';

?>

<hr />

<?php

@define('SOME_CONSTANT', 'This space for rent');

echo '<p>' . SOME_CONSTANT . '</p>';

$name = 'John Doe';

echo "<p>Welcome {$name}san to the page!</p>";


$week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri');

echo $week[3];

$week[5] = 'FRI';
$week[] = 'Sat';


$pillbox = array(
				 'Mon' => $week,
				 'Tue' => 'orange',
				 'Wed' => 'purple',
				 'Thu' => 'blue',
				 'Fri' => NULL,
				 'Sat' => 'blue/red',
				 'Sun' => NULL
				 );

echo $pillbox['Wed'];

$pillbox['Newday'] = 'Whatever';

echo $pillbox['Mon'][2];



?>










</body>
</html>