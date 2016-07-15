<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
		color: #333333;
		font-size: 100%;
	}

	form {
		width: 600px;
		padding: 1px 30px;
	}

	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	form label span,
	form label input {
		display: inline-block;
	}

	form > label span {
		width: 225px;
	}

	</style>
</head>
<body>

<?php
// is there form data present?
if (empty($_POST)) {
	// no form data, display blank form
?>
	<!-- form is in the if block, 
	so only displays if condition is true -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label>
			<span>Enter some text:</span>
			<input type="text" name="field1" />
		</label>
		<label>
			<span>Enter at least 6 characters:</span>
			<input type="text" name="field2" />
		</label>
		<div><input type="submit" /></div>
	</form>
<?php
} else {

	// validation process: "guilty until proven innocent"
	$isFormValid = true; // assume form is valid
	$validationMessages = ''; 

	// Rule: field can't be blank
	if (empty($_POST['field1'])) {
		// exception to rule found! Flag form as invalid
		$isFormValid = false;
		$validationMessages .= '<br />Field 1 cannot be empty.';
	}

	// Rule: field must be at least 6 characters
	if (strlen($_POST['field2']) < 6) {
		// exception to rule found! Flag form as invalid
		$isFormValid = false;
		$validationMessages .= '<br />Field 2 must be at least 6 characters.';
	}

	// add more rules as needed...

	// before processing, test if data is still valid
	if (!$isFormValid) {
		// validation error(s). display feedback
		echo '<p>One or more errors have been found: <br />'.
		$validationMessages . '<br />'.
		'Please go back and correct the errors and try again.</p>';
		exit();
	}
	// now process data
	// remember to sanitize, etc.
	// ...

}

?>

</body>
</html>