<?php 

function output($output) {
	echo '<p>'. $output .'</p>';
}

$o = 'output';

// variables can substitute function names
$o('test');

output($o);

output("This {$o}sdfsdf is kind of redundant.");
output('This $o is kind of redundant.');

$z = 'o';

output($$z); // variable variable names. Yeah, I know...


// then the magic happens...

// do stuff here...





?>