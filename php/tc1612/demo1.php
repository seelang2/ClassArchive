<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php   ?></title>
</head>
<body>

<?php



echo '<p>This space for rent</p>';
echo "\n";
echo "<p>Another line</p>\n";

$someVar = '$My Name';

echo "<p>Welcome {$someVar}pm</p>" . "\n" . '<p>My name is:' . $someVar . '</p>' . "\n";

// enumerated
$pillbox = array('Mon', 'Tue', 'Wed', 3, $someVar);

echo '<p>' . $pillbox[2] . '</p>';

$pillbox[] = 'next';

$pillbox[5] = 'Another value';

echo '<pre>' . print_r($pillbox, true) . '</pre>';

$newVar = $pillbox[5];

// associative arrav example
$betterPillbox = array(
					   'Sun' => 'red/blue',
					   'Mon' => 'white',
					   'Tue' => 'orange',
					   'Wed' => 'purple',
					   'Thu' => 'green'
					  );
$Wednesday = 'Wed';

echo $betterPillbox[$Wednesday];




?>


</body>
</html>