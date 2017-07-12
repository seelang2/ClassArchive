<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

$door = 2;

if ($door == 1) {
	// doStuff
}

if ($door == 1) {
	// do stuff
} else {
	// do this instead
}


if ( $door == 1 ) { 
	// do more stuff 
	echo '<p>Door is 1.</p>';
} elseif ($door == 2) {
	// otherwise do this instead
	echo '<p>Door is 2.</p>';
} elseif ($door == 3) {
	// otherwise do this instead
	echo '<p>Door is 3.</p>';
} else {
	// then it's gonna do this instead
	echo '<p>Door is something else.</p>';
}

switch ($door) {
	default:
		// if all else fails do this
	break;

	case 1:
		// do stuff
		echo '<p>Case 1 stuff</p>';
	break; // terminate case

	case 2:
		// do stuff
		echo '<p>Case 2 stuff</p>';
		// this break intentionally left blank.

	case 3: case 4: case 5:
		// do stuff
		echo '<p>Case 3 stuff</p>';
	break; // terminate case

} // switch

// alternate version of switch statemnt
switch (true) {
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
		// adult/higher ed
	break;

	default:
		// get a job you bum
	break;
}


?>
	
</body>
</html>