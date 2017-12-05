<?php

// remember leading and trailing slashes
@define('BASE_FS_PATH','/tc8517/app/'); 

// get request url from server var
$requestURL = $_SERVER['REDIRECT_URL'];

$pattern = '/'.preg_quote(BASE_FS_PATH, '/').'/';

// strip out base path
$requestURL = preg_replace($pattern, '', $requestURL);

// strip out any trailing slashes
$requestURL = preg_replace('/\/$/', '', $requestURL);

echo '<p>'.$requestURL.'</p>';

// convert request to an array
$request = explode('/', $requestURL);

echo '<pre>'.print_r($request,true).'</pre>';




