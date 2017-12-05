<?php
/*
	Takes query string parameters (get or post) and puts in json wrapper
	
	Query string parameters
	src			get | post
	callback	If specified will put json in a script function call wrapper to callback
	
*/
if (empty($_GET)) exit('error');

if (strtoupper($_GET['src']) == 'POST') 
	$srcArray = $_POST;
else
	$srcArray = $_GET;

// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 200000) * 3);


$output = '{';
$c = 0;
foreach ($srcArray as $key => $value) {
	if ($key == 'src' || $key == 'callback') continue;
	$output .= ($c > 0? ',':'').'"'.$key.'":"'.$value.'"';
	$c++;
}
$output .= '}';

if (!empty($_GET['callback']))
	echo ''.$_GET['callback'].'(';

echo $output;

if (!empty($_GET['callback']))
	echo ');';

?>