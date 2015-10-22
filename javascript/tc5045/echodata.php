<?php
/******
 * echodata.php
 * Author: Chris Langtiw chris@sitebabble.com www.sitebabble.com
 *
 * Takes the query string and packages it into a Javascript callback function
 * passing the string parameters as a JSON object.
 *
 * Required parameters:
 * 		callback	- the name of the function to wrap the data in
 **/
 
// add delay to simulate latency
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 10);

$jsOutput = '';
$callback = empty($_GET['callback']) ? NULL: $_GET['callback'];
if ($callback == NULL) exit('Error');

$jsOutput .= $callback . '({';

$c = 0;
foreach($_GET as $param => $value) {
	if ($param == 'callback') continue; // skip over callback parameter
	$jsOutput .= 
		($c++ > 0 ? ',':'') .
		'"' . $param . '":"' . $value . '"';
}

$jsOutput .= '});';

header('Content-Type: application/javascript'); // 
echo $jsOutput;
?>