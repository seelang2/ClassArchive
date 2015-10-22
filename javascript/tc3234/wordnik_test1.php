<?php

$API_KEY = "84094f6d00c00763e3c330f3bba01bf228c60603274c77ba2";

$REST_BASE_URL = "http://api.wordnik.com/api/word.xml/";


if (empty($_GET['param'])) {
	echo 'Error';
	exit();
}

$REST_URL = $REST_BASE_URL . $_GET['param'];

// initialize cURL session

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $REST_URL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('api_key:'.$API_KEY));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($ch);

if (!$data) {
	echo 'Error';
} else {
	header("Content-Type: text/xml");
	echo $data;
}

curl_close($ch);

?>