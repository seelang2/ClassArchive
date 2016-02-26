<?php

$door = 3;

// conditional branching - if 

if ( $door == 1 ) {
	// do stuff
	echo 'Door 1';
} 

// either/or branching - if ... else

if ( $door == 1) {
	// door 1 stuff
} else {
	// not door 1 stuff
}

// multiple choice - chained if/else statements

if ( $door == 1 ) {
	// door 1 stuff
} else if ( $door == 2 ) {
	// door 2 stuff
} else {
	// any other doors
}

// multiple choice - switch (version 1)

switch( $door ) {
	case 1:
		// do stuff
	break;

	default:
	case 2:
		// do other stuff

	case 3: case 4: case 5: case 6:
		// do more stuff
	break;
}

// multiple choice - switch (version 2)
$age = 7;

switch ( true ) {
	case $age < 5:
		// no school for you! *snap*
	break;
	case $age > 4 && $age < 13:
		// elementary school
	break;
	case $age > 12 && $age < 18:
		// high school
	break;
	case $age > 17:
		// adult/continuing ed
	break;
	default:
		// get a job you bum
	break; 
}










?>