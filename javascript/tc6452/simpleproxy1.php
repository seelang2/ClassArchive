<?php
/*
 * Simple proxy service, jsonp enabled
 *
 */

 
// base domain URI
$baseURI = 'https://data.usajobs.gov/api/jobs';

$requestURI = $baseURI . '?' . $_SERVER['QUERY_STRING'];

//echo $requestURI;

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $requestURI);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// grab URL and pass it to the browser
$response = curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

// bail if the curl request failed
if ($response == false) exit('Error in curl request.');

// check to see if a callback parameter is specified
if (!empty($_GET['callback'])) {
	header('Content-Type: text/javascript');
	echo $_GET['callback'] . '(';
} else {
	header('Content-Type: application/json');
}

echo $response;

if (!empty($_GET['callback'])) echo ');';





