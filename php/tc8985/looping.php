<?php

echo '<p>';

// basic for loop
for ($c = 0; $c < 10; $c++) {
	echo $c;
}

echo '</p>'; echo '<p>';

$list = array ('a','b','c','d','e','f','g','h');

// basic foreach
foreach ($list as $value) {
	echo $value . ' ';
}

echo '</p>'; echo '<p>';

// alternate foreach
foreach ($list as $key => $value) {
	echo $key . ' = ' . $value . ' ';
}

echo '</p>'; echo '<p>';

// basic while loop
$x = 10;
while ($x < 10) {
	echo $x;
	$x++;
}

echo '</p>'; echo '<p>';

// do... while loop variation
$x = 10;
do {
	echo $x;
	$x++;
} while ($x < 10);

echo '</p>';




?>