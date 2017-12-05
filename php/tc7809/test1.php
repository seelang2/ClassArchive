<?php

$time_start = microtime(true); // returns timestamp in (float)milliseconds

for ($c = 0; $c < 100000; $c++) {
	echo "<p>$c</p>";
	// or
	echo '<p>' . $c . '</p>'; // concatenation is faster than interpolation
}


$time_stop = microtime(true); // returns timestamp in (float)milliseconds

echo '<p>Total time: '. (($time_stop - $time_start)*1000) . 'ms</p>';
