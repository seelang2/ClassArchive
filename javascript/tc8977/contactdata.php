<?php

// JSONP support
// if callback is supplied wrap data inside a javascript function call
if (!empty($_GET['callback'])) {
	header('Content-Type: text/javascript');
	echo $_GET['callback'] . '(';
}

?>[{"firstname":"John", "lastname":"Doe", "age":43},{"firstname":"Patrick", "lastname":"Frank", "age":23},{"firstname":"Alice", "lastname":"Jones", "age":56},{"firstname":"James", "lastname":"Peters", "age":23},{"firstname":"Mary", "lastname":"Winston", "age":34},{"firstname":"Betty", "lastname":"Cooper", "age":53},{"firstname":"Mark", "lastname":"Bane", "age":27},{"firstname":"Alex", "lastname":"King", "age":31},{"firstname":"Jane", "lastname":"Smith", "age":41}]<?php
// JSONP support
if (!empty($_GET['callback'])) {
	echo ');';
}
?>