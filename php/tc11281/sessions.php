<?php
function dumpvar($data) {
	return '<pre>'.print_r($data, true).'</pre>';
}

session_start(); // initialize session

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php


if (empty($_SESSION['data'])) $_SESSION['data'] = 'This space for rent.';


echo dumpvar($_SESSION);

?>


</body>
</html>