<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php
// these loops all do the same thing

for ($c = 0; $c < 10; $c++) {
	echo $c;
}

echo '<br />';

$i = 10;
while ($i < 10) {
	echo $i;
	$i++;
}

echo '<br />';

$x = 10;
do {
	echo $x;
	++$x;
} while ($x < 10);

echo '<br />';

$weekdays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat','Bob'];

foreach ($weekdays as $value) {
	echo '<p>' . $value . '</p>';
	if ($value == 'Thu') break; // terminate loop
} 

foreach ($weekdays as $key => $value) {
	if ($key % 2 != 0) continue; // skip ahead to next iteration
	echo '<p>' . $key .' => '. $value . '</p>';
} 



?>

</body>
</html>