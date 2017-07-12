<?php 
//if the form has been submitted
if (isset($_POST['submit'])) {
	
	//set expected fields
	$expected = array('id','firstName','lastName','email','publications','comments','subscribe');
	
	//set required fields
	$required = array(
		'firstName' => 'You must enter a first name.',
		'lastName' => 'You must enter a last name.',
		'email' => 'You must enter an email.'
	);
	
	//initialize errors array
	$errors = array();
	
	//define sanitize function
	function sanitizeInput($myInput) {
		$myInput = trim($myInput);
		$myInput = strip_tags($myInput);
		//$myInput = filter_var($myInput,FILTER_SANITIZE_STRING);
		//$myInput = htmlentities($myInput, ENT_QUOTES, 'UTF-8');
		return $myInput;
	}
	
	//loop through all expected fields
	foreach ($expected as $value) {
		
		//make sure all expected fields have at least a blank value. This will take care of un-returned radios and checkboxes
		if ( !isset($_POST["$value"]) ) {
			$_POST["$value"] = array();
		}
		
		//sanitize all my inputs and assign to variable of the same name
		if ( is_array($_POST["$value"]) ) {
			//initialize array
			${$value} = array();
			foreach ($_POST["$value"] as $subValue) {
				${$value}[] = sanitizeInput($subValue);
			}
		}
		else {
			${$value} = sanitizeInput($_POST["$value"]);
		}
	}
		
	//make sure each required element is not empty.
	foreach ($required as $key => $value) {
		if (empty(${$key}))  {
			$errors[$key] = $value;
		}
	}
				
			
	//do some more error checking
	
		//make sure email is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "That email is not valid.";
		}
	
	//check to see if there were errors
	if (empty($errors)) {
		
		//update user in database
		require_once('updateUser.php');
		
		//display thank you page
		require_once('userList.php');
	}
	else {
		//display error page
		require_once('form-error.php');
	}
	
}

?>