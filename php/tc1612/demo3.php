<?php
$start = microtime(true);

$output = '';
for ($c = 0; $c < 2000000; $c++) {
	$output .= $c . "\n";	
}

//echo $output;

$end = microtime(true);
$elapsed = $end - $start;
echo '<p>Start timestamp: ' . $start . 
	 '<br />End time: ' . $end . '<br />' . 
	 'Run time: ' . $elapsed . ' seconds.</p>';

?>