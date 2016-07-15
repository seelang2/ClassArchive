<?php

if (empty($_COOKIE['mycookie'])) {
	// set new cookie
	setcookie('mycookie', 1);
} else {
	// update the cookie
	setcookie('mycookie', $_COOKIE['mycookie'] + 1);
}

if (!empty($_GET['resetcookie'])) {
	// remove the cookie
	setcookie('mycookie', '', 1);
}

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	</style>
</head>
<body>

<?php

echo '<pre>'.print_r($_COOKIE,true).'</pre>';

?>

</body>
</html>