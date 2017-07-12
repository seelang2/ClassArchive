<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
	}
	</style>
</head>
<body>

<?php

echo '<pre>' . print_r($_GET, true) . '</pre>'; // dump contents of $_GET

echo '<p>Firstname: ' . $_GET['firstname'] . '</p>';
echo '<p>Lastname: ' . $_GET['lastname'] . '</p>';
echo '<p>Email: ' . $_GET['email'] . '</p>';
echo '<p><b>Categories</b></p>';

// for each category
echo '<ul>';
foreach($_GET['category'] as $category) {
	echo '<li>' . $category . '</li>'; // echo it
}
echo '</ul>';

?>

</body>
</html>