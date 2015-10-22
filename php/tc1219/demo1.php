<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo 'Demo 1'; ?></title>
</head>
<body>

<?php

echo "Hello World!";

$somevar = 'John' . ' ' . 'Doe';

echo '<p>' . $somevar . '</p>' . "\n";

echo "<p>$somevar</p>";

$pillbox = array('Sun', 'Mon', 'Tue', 'Wed', 57, 'Blue', $somevar);

$pillbox[] = 'something';

echo '<p>'. $pillbox[3] . '</p>';

$better_pillbox = array(
	'Mon' => 'white',
	'Tue' => 'Orange',
	'Wed' => 'Purple',
	'Thu' => 'Red',
	'Fri' => 'Green'
);
// line comment
/* 
	Multi line comment
*/
echo $better_pillbox['Wed'];

$a = array();
// $a[] = 'value';
$a['keyname'] = 'something';

@define('SOME_CONSTANT', 'This space for rent');

echo '<p>' . SOME_CONSTANT . '</p>';

echo '<p>' . date('Y-m-d') . '</p>';



?>






<p>Copyright <?php echo date('Y'); ?> Training Connection. Some rights reserved.</p>

</body>
</html>
