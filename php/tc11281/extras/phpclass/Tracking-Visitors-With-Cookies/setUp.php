<?php 
	$cookies = array('visits','entryPage','entryDateTime','cameFrom');
	foreach ( $cookies as $value ) {
		//set cookie to an expiration with a time in the past to delete a cookie
		setcookie ($value,"", time() - 3600);
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Clear Cookies</title>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>The cookies used in this exercise have been cleared.</h1>
</body>
</html>
