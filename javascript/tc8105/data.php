<?php

// Enable CORS access in API
header('Access-Control-Allow-Origin: *');

// Note that IE < 10 doesn't support CORS and so JSONP is required instead.


header('Content-Type: application/json');

echo '{"firstname":"John", "lastname":"Doe", "age":32}';
