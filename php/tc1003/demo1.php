<h1>Demo 1</h1>

<?php

echo "<p>This space for rent</p>";

$somevar = 'A string';

$a = 3;

echo "<p>Var a = $a</p>";

echo '<p>Var a = ' . (string)$a . '</p>';

$b = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri');

echo $b[4];

$b[] = 'Sat';

$c = array('Mon' => 'blue', 'Tue' => 'red', 'Wed' => 'purple');

echo '<p>' . $c['Wed'] . '</p>';

$c['Thu'] = 'orange';

// line comment

/* block comment */

echo '<p>Number of elements in array b: ' . count($b) . '</p>';

if ($a < 3) {

} else {

}

switch ($a)
{
	case 3:
		// do stuff
		
	break;
	
	case 6:
	
	case 7:
		// do more stuff
	break;
	default:
	
	break;
}

switch(true)
{
	case $a < 5:
		// preschool
	break;
	
	case $a >= 5 && $a < 12:
		// elementary school
	break;
	
	case $a >= 12 && $a < 17:
		// high school
	break;
	
	default:
		// college or other
	break;
}

$count = count($b);
for ($x = 0; $x < $count; $x++) {
	echo '<p>' . $b[$x] . '</p>';
}

$x = 0;
while ($x < $count) {
	echo '<p>' . $b[$x] . '</p>';
	echo "<p>{$d[$x]}</p>";
	$x++;
}

foreach ($c as $key => $value) {
	echo '<p>Value of ' . $key . ' is ' . $value . '</p>';
}

reset($c);

while ($value = each($c)) {
	echo '<p>Value of ' . $value[0] . ' is ' . $value[1] . '</p>';
}

reset ($c);

?>


