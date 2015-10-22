<?php
/******
 * callback.php - cross-domain script api example
 * @version 1.0 2 SEP 2011 C. Langtiw chris@sitebabble.com www.sitebabble.com
 *
 * This script takes a required parameter, callback, and generates a javascript
 * function call to <callback> passing back the other query string parameters
 * as an object literal parameter to the function.
 *
 * Ex: 
 *		callback.php?callback=test&prop1=val1&prop2=val2&prop3=val3
 *
 * Produces the output 
 *		test({"prop1":"val1","prop2":"val2","prop3":"val3"});
 *
 * Placing callback.php inside the src attribute of a <SCRIPT> tag will result in
 * the function test being executed. This technique is used to perform ajax api
 * calls to a non-originating domain, which is disallowed by XMLHttpRequest.
 *
 */

if (empty($_GET['callback'])) exit('false'); else $callback = $_GET['callback'];

$outputObj = $callback . '({'; // start of output object literal
$c = 0;
foreach($_GET as $name => $value) {
	if ($name != 'callback')
		$outputObj .= 
			($c++ < 1? '': ',') . '"' . $name . '":"' . $value . '"';
}
$outputObj .= '});';

echo $outputObj;

?>