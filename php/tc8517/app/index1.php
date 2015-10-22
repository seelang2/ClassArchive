<?php

echo '<pre>'.print_r($_SERVER, true).'</pre>';

// remember leading and trailing slashes
@define('BASE_FS_PATH','/tc8517/app/'); 

// get request url from server var
$requestURL = $_SERVER['REDIRECT_URL'];

$pattern = '/'.preg_quote(BASE_FS_PATH, '/').'/';
//echo '<p>'.$pattern.'</p>';

// strip out base path
$requestURL = preg_replace($pattern, '', $requestURL);

echo '<p>'.$requestURL.'</p>';

// strip out any trailing slashes
$requestURL = preg_replace('/\/$/', '', $requestURL);

echo '<p>'.$requestURL.'</p>';




