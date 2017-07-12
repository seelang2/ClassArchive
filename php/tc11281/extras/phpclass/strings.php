<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
<?php

$a = 'Andy';
$b = 'Betty';

echo strcmp($b, $a);

echo '<p>'.strtoupper($a).'</p>';
echo '<p>'.strtolower($b).'</p>';

echo '<p>'. strpos('This space for rent', 'sppace') .'</p>';

$names = 'Chris, Kris, Jeff, Bob, Alex, Linda, Sally';

// remove extra spaces
$names = str_replace(' ', '', $names);

// splits string into array of separate values
$result = explode(',', $names);

echo '<pre>'.print_r($result,true).'</pre>';

$names2 = implode('/', $result);

echo '<p>' . $names2 . '</p>';


?>

</body>
</html>