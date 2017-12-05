<?php

// basic loops

echo '<p>';

for ($c = 0; $c < 10; $c++) {
	echo $c;
}

echo '</p>';

echo '<p>';

$c = 0;
while ($c < 10) {
	echo $c++;
}

echo '</p>';

$list = array('A', 'B', 'C', 'D', 'E'); // $list[2]
$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
); // $pillbox['Tue']

echo '<p>';

foreach($list as $value) {
	echo $value . ',';
}

echo '</p>';

echo '<p>';

foreach($pillbox as $key => $value) {
	echo $key . ' = ' . $value;
}

echo '</p>';



if ( 1 == 1 ) {
	
} else {

}

// alt if syntax
if ( 1 == 1 ):
	// true block
else:
	// false block
endif;


$door = 1;

if ( $door == 1 ) {
	// do stuff
} else if ( $door == 2 ) {
	// door 2 stuff
} else {
	// last option
}



switch( $door ) {
	case 1: 
		// do stuff
	break;
	
	case 2:
		// do other stuff
		
	case 3:
		// do more stuff
	break;
	
	default:
		// if no other matches do this
	break;
}

$age = 7;

switch ( true ) {
	case $age < 5:
		// no school for you! *snap*
	break;
	
	case $age > 4 && $age < 13:
		// grade school
	break;
	
	case $age > 12 && $age < 18:
		// high school
	break;
	
	case $age > 17:
		// adult ed
	break;
	
	default:
		// ??? get a job then
	break;
}

$a = 10;

function foo() {
	$a = 5;
}

function square(&$val) {
	$val = $val * $val;
	return $val;
}

echo '<p>' . $a . '</p>';

echo '<p>' . square($a) . '</p>';

echo '<p>' . $a . '</p>';






