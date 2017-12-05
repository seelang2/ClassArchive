<?php
/*
 * Simple proxy service
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

echo ($response != false? $response: '<p>No response from curl request.</p>');


