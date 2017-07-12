<?php 
	function sanitizeInput($myInput) {
		$myInput = trim($myInput);
		$myInput = strip_tags($myInput);
		return $myInput;
	}

	//set errors array to empty
	$errors = array();
	
	//set all form values to variables and sanitize input
	$name = sanitizeInput($_POST['name']);
	$email = sanitizeInput($_POST['email']);
	
	//if they did not check a publications checkbox, set value to blank. if they did, implode it and sanitize
	if ( isset($_POST['publications']) ) {
		$publications = sanitizeInput( implode(', ',$_POST['publications']) );
	}
	else {
		$publications = '';
	}
		
	//if name is blank, set error
	if ( $name  == ''  ) {
		$errors[] = "You must enter a name.";
	}
	
	//if email is blank, set error
	if ( $email == ''  ) {
		$errors[] = "You must enter an email.";
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			//if email is not valid, set error
			$errors[] = "That email is not valid.";		
	}
	
	//if there are no errors
	if ( empty($errors) ) {
		
		//send email
		require_once('form-send-email.php');
		
		//display confirmation page
		require_once('form-confirm.html');
	}
	//if there WERE errors
	else {
		//display the errors
		require_once('form-error.php');
	}
	
?>