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

/*
	Form data validation
	Use "innocent until proven guilty" approach: Assume data is valid, and write
	tests to check for invalid data

*/

$formIsValid = true; // assume form is valid
$errorMessages = ''; // container for error messages

// test form fields

// firstname can't be blank
if (empty($_GET['firstname'])) {
	// found an exception
	$formIsValid = false; // mark form as invalid
	$errorMessages .= '<br />First name cannot be blank.';
}

// firstname can only contain letters, spaces, and hyphens
if (preg_match('/^[a-zA-Z\s\-]+$/', $_GET['firstname']) === 0) {
	$formIsValid = false; // mark form as invalid
	$errorMessages .= '<br />First name can only contain letters, spaces and hyphens.';
}

// enter more validation rules ...

// is the form still valid?
if ($formIsValid) {
	// do processing
	echo '<pre>' . print_r($_GET, true) . '</pre>'; // dump contents of $_GET

	echo '<p>Firstname: ' . $_GET['firstname'] . '</p>';
	echo '<p>Lastname: ' . $_GET['lastname'] . '</p>';
	echo '<p>Email: ' . $_GET['email'] . '</p>';

	// for each category
	if (!empty($_GET['category'])) {
		echo '<p><b>Categories</b></p>';
		echo '<ul>';
		foreach($_GET['category'] as $category) {
			echo '<li>' . $category . '</li>'; // echo it
		}
		echo '</ul>';
	}

} else {
	// display error messages
	echo '<p>Form broken:<br />' . 
		 $errorMessages .
		 '<br />Go back and fix your mess.</p>';

}

?>

</body>
</html>