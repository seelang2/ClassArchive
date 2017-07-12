<?php

require('function_lib.php'); // load function library

// validate form
/*
Simplest approach is 'innocent until proven guilty'
Assume data is valid then test for exceptions to flag
*/

$formIsValid = true; // Innocent, I say
$formErrors = []; // array to hold validation errors

// get form data
//$name = $_POST['name']; <-- could get errors

if (empty($_POST['name'])) {
	$name = '';
} else {
	$name = $_POST['name'];
}

// use a ternary operator to 'simplify' the code a bit
$email = empty($_POST['email']) ? '' : $_POST['email'];

$publications = empty($_POST['publications']) ? [] : $_POST['publications'];


// has nothing to do with this example, but I'm leaving it here as 
// another example of using ternary operators
// echo '<p>The door is '. ($isDoorOpen ? 'open' : 'closed') .'</p>';

// validate data

// field can't be blank (required)
if (empty($name)) {
	// found an exception. Mark form as invalid and note error
	$formIsValid = false; // invalidate form
	$formErrors[] = "Name can't be blank";
}

// field can't be blank (required)
if (empty($email)) {
	// found an exception. Mark form as invalid and note error
	$formIsValid = false; // invalidate form
	$formErrors[] = "Email can't be blank";
}

// check email format
if (!preg_match("/^[A-Z0-9._-]+@[A-Z0-9.-]+\.[A-Z0-9.-]+$/i", $email)) {
	$formIsValid = false; // invalidate form
	$formErrors[] = "Email must be a valid format";
}

/*
Some other tests:
Minimum length of 4 chars: if (strlen($field) < 4)
Length between 4 and 12 chars: if (strlen($field) < 4 && strlen($field) > 12)
Is a number: if (is_numeric($field)) 

*/

// additional form processing (sanitizing, etc.)
$name = sanitize($name);
$email = sanitize($email);
$publications = sanitize(implode(', ', $publications));

// check form
if ($formIsValid) {
	// complete processing
	// display confirmation page form-confirm.html
	include('form-confirm.html');
} else {
	// display errors (if any) form-error.php
	include('form-error.php');
}


// no closing PHP tag at the end of the file deliberately