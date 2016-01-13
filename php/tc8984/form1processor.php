<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page title</title>

</head>
<body>

<?php

echo '<pre>' . print_r($_GET, true) . '</pre>';

echo '<p>Welcome, ' . $_GET['firstname'] . ' ' . $_GET['lastname'] . '!</p>';

?>


</body>
</html>