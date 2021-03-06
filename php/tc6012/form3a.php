<!DOCTYPE html>
<html>
<head>
	<title>Data Entry Form</title>
	<meta charset="UTF-8" />
	
	<style type="text/css">
	body { 
		font-family: Verdana, Arial, sans-serif;
		font-size: 85%;
		color: #000;
	}
	
	form label {
		display: block;
		margin-bottom: 0.5em;
	}
	
	label span, label input {
		display: inline-block;
	}
	
	label span {
		width: 125px;
		text-align: right;
		margin-right: 1em;
	}
	
	label span:after {
		content: ':';
	}
	</style>
</head>
<body>

<?php
	// is form data present?
	if (empty($_POST['processform'])) { 
		// display blank form
		?>
		<h1>Step 1: Data Entry</h1>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<input type="hidden" name="processform" value="1" />
			<label>
				<span>First Name</span>
				<input name="firstname" type="text" />
			</label>
			<label>
				<span>Enter at least 4 characters</span>
				<input name="field2" type="text" />
			</label>
			<label>
				<span>Enter less than 10 characters</span>
				<input name="field3" type="text" />
			</label>
			<label>
				<span>Enter between 4 and 10 characters</span>
				<input name="field4" type="text" />
			</label>
			<label>
				<span>Enter a number</span>
				<input name="field5" type="text" />
			</label>
			<label>
				<span>Email Address</span>
				<input name="email" type="text" />
			</label>
			<div><input type="submit" value="Continue" />
		</form>

		<?php
	} else {
		// process form data
		
		// validate form data using "innocent until proven guilty" approach
		$formIsValid = true;
		$formErrors = Array(); // array to hold field validation errors
		
		// for each form field...
		foreach($_POST as $fieldName => $fieldValue) {
			// test field for rule exception(s)
			switch($fieldName) { 
				case 'firstname':
					// field can't be empty
					if (empty($fieldValue)) { // if exception is found...
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'First Name cannot be empty'; // handle data error
					}
					// field has maximum of 10 chars
					if (strlen($fieldValue) > 10) { // if exception is found...
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'First Name must be less than 11 chars';
					}
				break;
				case 'field2':
					// field has minimum of 4 chars
					if (strlen($fieldValue) < 4) { // if exception is found...
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'Field must have at least 4 chars';
					}
				break;
				case 'field3':
					// field has maximum of 10 chars
					if (strlen($fieldValue) > 10) { // if exception is found...
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'Field must be less than 11 chars';
					}
				break;
				case 'field4':
					// field between 4 and 10 chars
					if (strlen($fieldValue) < 4 || strlen($fieldValue) > 10 ) { 
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'Field must be between 4 and 10 chars';
					}
				break;
				case 'field5':
					/*
					// field can't be empty
					if (empty($fieldValue)) { // if exception is found...
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'Field cannot be empty'; // handle data error
					}
					*/
					// field is a number
					if (!is_numeric($fieldValue)) { 
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'Field must be a number';
					}
				break;
				case 'email':
					// field is email format
					$pattern = '/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i';
					if (preg_match($pattern, $fieldValue) != 1) { 
						$formIsValid = false; // mark form invalid
						$formErrors[] = 'Field must be an email address';
					}
				break;
			} // switch $fieldName
		} // foreach $_POST
		
		// if form is valid...
		if ($formIsValid) {
			// continue processing
			echo '<p>Yay! The form is valid! Now to continue processing...</p>';
			
		} else { // else..
			// display feedback on validation errors
			echo '<p>The following form errors were found:</p>';
			// loop through form errors and display them
			foreach($formErrors as $errorMessage) {
				echo '<p>' . $errorMessage . '</p>';
			}
		} // if form is valid
		
	} // if form data present
	

?>


</body>
</html>