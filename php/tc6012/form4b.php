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
	
	.error {
		border: 2px solid #f00;
		color: #f00;
		background: #FFC9C9;
	}
	
	label span.error { width: auto; }
	</style>
</head>
<body>

<?php
// get the action parameter from URI query string
if (empty($_GET['action'])) { 
	$action = 'SHOWFORM'; 
} else { 
	$action = strtoupper($_GET['action']); 
}

switch($action) {
	case 'PROCESS': // process form data
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
						$formErrors[$fieldName] = 'First Name cannot be empty';
					}
				break;
				case 'field2':
					// field has minimum of 4 chars
					if (strlen($fieldValue) < 4) { // if exception is found...
						$formIsValid = false; // mark form invalid
						$formErrors[$fieldName] = 'Field must have at least 4 chars';
					}
				break;
				case 'field3':
					// field has maximum of 10 chars
					if (strlen($fieldValue) > 10) { // if exception is found...
						$formIsValid = false; // mark form invalid
						$formErrors[$fieldName] = 'Field must be less than 11 chars';
					}
				break;
				case 'field4':
					// field between 4 and 10 chars
					if (strlen($fieldValue) < 4 || strlen($fieldValue) > 10 ) { 
						$formIsValid = false; // mark form invalid
						$formErrors[$fieldName] = 'Field must be between 4 and 10 chars';
					}
				break;
				case 'field5':
					// field is a number
					if (!is_numeric($fieldValue)) { 
						$formIsValid = false; // mark form invalid
						$formErrors[$fieldName] = 'Field must be a number';
					}
				break;
				case 'email':
					// field is email format
					$pattern = '/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i';
					if (preg_match($pattern, $fieldValue) != 1) { 
						$formIsValid = false; // mark form invalid
						$formErrors[$fieldName] = 'Field must be an email address';
					}
				break;
			} // switch $fieldName
		} // foreach $_POST
	
		// if form is valid...
		if ($formIsValid) {
			// continue processing
			echo '<p>Yay! The form is valid! Now to continue processing...</p>';
			
			break; // done processing, terminate case
		} // if form is valid
	
	// if the form is invalid we continue into the next case to display the form
	// break statement intentionally omitted
	
	case 'SHOWFORM':
	default:
		// display blank form
		?>
		<h1>Step 1: Data Entry</h1>
		
		<?php
		if (!empty($formErrors)) { 
			// if there are form errors, display message
			echo '<div class="error">';
			echo '<p>There were errors in the form fields.</p>';			
			echo '</div>';
		}
		?>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process" method="post">
			<label>
				<span>First Name</span>
				<input name="firstname" type="text" />
				<?php
				if (!empty($formErrors['firstname'])) {
					echo '<span class="error">' .
						 $formErrors['firstname'] .
						 '</span>';
				}
				?>
			</label>
			<label>
				<span>Enter at least 4 characters</span>
				<input name="field2" type="text" />
				<?php
				if (!empty($formErrors['field2'])) {
					echo '<span class="error">' .
						 $formErrors['field2'] .
						 '</span>';
				}
				?>
			</label>
			<label>
				<span>Enter less than 10 characters</span>
				<input name="field3" type="text" />
				<?php
				if (!empty($formErrors['field3'])) {
					echo '<span class="error">' .
						 $formErrors['field3'] .
						 '</span>';
				}
				?>
			</label>
			<label>
				<span>Enter between 4 and 10 characters</span>
				<input name="field4" type="text" />
				<?php
				if (!empty($formErrors['field4'])) {
					echo '<span class="error">' .
						 $formErrors['field4'] .
						 '</span>';
				}
				?>
			</label>
			<label>
				<span>Enter a number</span>
				<input name="field5" type="text" />
				<?php
				if (!empty($formErrors['field5'])) {
					echo '<span class="error">' .
						 $formErrors['field5'] .
						 '</span>';
				}
				?>
			</label>
			<label>
				<span>Email Address</span>
				<input name="email" type="text" />
				<?php
				if (!empty($formErrors['email'])) {
					echo '<span class="error">' .
						 $formErrors['email'] .
						 '</span>';
				}
				?>
			</label>
			<div><input type="submit" value="Continue" />
		</form>

		<?php
	break;
} // switch action
	

?>


</body>
</html>