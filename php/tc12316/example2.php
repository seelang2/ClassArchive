<?php
// line comment - anything past slashes is ignored

/*
	block comments can span multiple lines
 */

// display the current date
// example: Today is Wednesday, October 10th, 2018
// using the date() function

/*
echo '<p>Today is ';
echo date('l, F jS, Y');
echo '.</p>';
*/

@define('SOME_CONSTANT', 'A value');

echo '<p>'.SOME_CONSTANT.'</p>';

// same thing using concatenation
echo '<p>Today is ' . date('l, F jS, Y') . '.</p>';

$fullName = 'John Doe';

echo '<p>Hello, ' . $fullName . '.</p>';


$a = 1;
echo $a . '<br />';
echo $a++ . '<br />';
echo $a . '<br />';

$a = 1;
echo $a . '<br />';
echo ++$a . '<br />';
echo $a . '<br />';


$weekdays = array('Sun', 'Mon', 'Tue'); // old 'long' form
$weekdays = ['Sun', 'Mon', 'Tue']; // new 'short' form

echo '<p>'. $weekdays[1] .'</p>';

$contact = [
	'firstname' => 'John',
	'lastname' => 'Doe',
	'age' => 32
];

echo '<p>'. $contact['firstname'] .' '. $contact['lastname'] .'</p>';

// basic branching: IF
$door = 7;
if ($door == 1) { // note == comparison operator vs assignment
	// do stuff
}

/*
 in PHP falsy values
	false,
	0
	''
	null
*/

// comparison operators: == != === !== > < >= <= && (and) || (or)
/*

3 == 3 		T
3 == '3' 	T
3 === '3' 	F

*/

// either/or
if ($door == 3) {
	// do stuff for door 3
} else {
	// otherwise do this stuff instead
}

// multiple choice
if ($door == 1) {
	// do stuff for door 1
} else if ($door == 2) {
	// do stuff for door 2
} else if ($door == 3) {
	// do stuff for door 3
} else {
	// catch all for everything else
}

// multiple choice using SWITCH
switch($door) {
	default:
	case 1: // colon instead of semicolon
		// do stuff
	break;

	case 2:
		// do other stuff

	case 3: case 4: case 5:
		// do more stuff
	break;

}

// alternate form of switch
switch(true) {
	case $age < 5: 
		// no school for you! *snap*
	break;
	case $age > 4 && $age < 13:
		// elementary school
		echo 'elementary';
	break;
	case $age == 15: // be careful with overlapping cases
		echo 'exception';
	break;
	case $age > 12 && $age < 18:
		// high school
		echo 'high';
	break;
	case $age > 17:
		// adult/higher ed
		echo 'adult/higher';
	break;
	default:
		// error or exception (get a job)
	break;
}

// looping

for($c = 0; $c < 10; $c++) {
	echo $c;
}

$c = 0;
while ($c < 10) {
	echo $c;
	$c++;
}

// functions
function doStuff() {
	echo '<h1>Hello</h1>';
}

doStuff();

function doStuffBetter() {
	return 'Hello';
}

echo '<p>'. doStuffBetter() .'</p>';

include('function_lib.php');

echo '<p>1233'.getOrdinal(1233).'</p>';

function foo() {
	$c = 100;
	echo '<p>'.$c.'</p>';
}

$c = 10;
echo '<p>'.$c.'</p>';
foo();
echo '<p>'.$c.'</p>';


?>