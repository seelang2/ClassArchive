<?php
/*
	contact.php - simplified contact API example
	
	Request format:
	
	/action/params
	
	Where:
	action	= save, list, get, delete
	params	= record id (used with save, get and delete
	
	Status object: { "status": statusCode, "message": statusMessage, "data": data }
	
	Where:
	status	= 0 (error), 1 (success)
	message	= Status description 
	data	= additional data
	
*/

require('init.php');

// parse request

$baseURI = '/tc7236/contact.php/'; // define base portion of URI

// strip baseURI from request
$request = str_replace($baseURI, '', $_SERVER['REQUEST_URI']);

$requestArray = explode('/', $request);

/*
echo '<pre>'.print_r($requestArray, true).'</pre>';

echo array_shift($requestArray);
echo '<br />';
echo '<pre>'.print_r($requestArray, true).'</pre>';

echo array_shift($requestArray);
echo '<br />';
echo '<pre>'.print_r($requestArray, true).'</pre>';
*/

// 'route' action to appropriate code
switch(strtolower(array_shift($requestArray))) {
	case 'list':
		// build query
		$query = 'SELECT id, firstname, lastname, email FROM contacts';
		
		// send query to server
		$results = $dbh->query($query);
		
		// check server result
		if ($results === false) {
			// query error
			echo '{"status":0, "message":"Query error"}';
			break; // terminate case
		}
		
		// process results
		// fetch entire result set and output as JSON
		echo json_encode($results->fetchAll(PDO::FETCH_ASSOC));
	
	break; // list
	
	case 'get':
		// get params (second parameter in request) from request array
		$id = array_shift($requestArray);
		
		if (empty($id)) {
			// no id to process
			echo '{"status":0, "message":"No ID specified"}';
			break; // terminate case
		}
		
		$id = $dbh->quote($id); // sanitize id
		
		// build query
		$query = "SELECT id, firstname, lastname, email FROM contacts WHERE id = {$id}";
		
		// send query to server
		$results = $dbh->query($query);
		
		// check server result
		if ($results === false) {
			// query error
			echo '{"status":0, "message":"Query error"}';
			break; // terminate case
		}
		
		// process results
		// fetch entire result set and output as JSON
		echo json_encode($results->fetch(PDO::FETCH_ASSOC));
	
	
	break; // get
	
	case 'delete':
		// get params (second parameter in request) from request array
		$id = array_shift($requestArray);
		
		if (empty($id)) {
			// no id to process
			echo '{"status":0, "message":"No ID specified"}';
			break; // terminate case
		}
		
		$id = $dbh->quote($id); // sanitize id
		
		$query = "DELETE FROM contacts WHERE id = {$id} ";
		
		// send query to server
		$result = $dbh->exec($query);
		
		// check server result
		if ($result == 0) {
			// no rows affected - some kind of error
			echo '{"status":0, "message":"Query error"}';
			break;
		}
		
		// success
		echo '{"status":1, "message":"Record deleted"}';
	
	
	break; // delete
	
	case 'save':
		if (empty($_POST)) {
			echo '{"status":0, "message":"No data to save"}';
			break;
		}
		
		// RULE 1: NEVER TRUST USER DATA!
		
		// data validation - 'innocent until guilty' approach
		$isFormValid = true; // start by assuming form is valid
		$validationErrors = array();
		
		// rules then look for exceptions
				
		// firstname should not be blank
		if (empty($_POST['firstname'])) {
			// exception found! first, invalidate form
			$isFormValid = false;
			// now add the error to a list of error messages
			$validationErrors['firstname'] = 'First name cannot be blank.';
		}
		
		// lastname shoud be more than three characters long
		if (strlen($_POST['lastname']) < 3) {
			// exception found! first, invalidate form
			$isFormValid = false;
			// now add the error to a list of error messages
			$validationErrors['lastname'] = 'Last name must be at least 3 characters.';
		}
		
		// Email should appear to be properly formatted
		$pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';
		if ( preg_match($pattern, $_POST['email']) == 0 ) {
			// exception found! first, invalidate form
			$isFormValid = false;
			// now add the error to a list of error messages
			$validationErrors['email'] = 'Email appears to be invalid.';
		}
		
		// now check if form is still valid
		if (!$isFormValid) {
			echo '{"status":0, "message":"Validation Error", "data": '.json_encode($validationErrors).'}';
			break;
		}

		// always sanitize data before using it in a query
		$firstname = $dbh->quote($_POST['firstname']);
		$lastname = $dbh->quote($_POST['lastname']);
		$email = $dbh->quote($_POST['email']);
		

		// build query
		// note that after using PDO->quote() the quotes around the values
		// are no longer necessary
		if (empty($id)) {
			$query = 'INSERT INTO ';
		} else {
			$query = 'UPDATE ';
		}
		
		$query .= 'contacts SET ' .
					"firstname = {$firstname}, " . 
					"lastname = {$lastname}, " . 
					"email = {$email} "; 
		
		if (!empty($id)) $query .= " WHERE id = {$id} ";

		// send query to server
		$result = $dbh->exec($query);
		
		// check server result
		if ($result == 0) {
			// no rows affected - some kind of error
			echo '{"status":0, "message":"Record not saved"}';
			break;
		}
		
		// success
		echo '{"status":1, "message":"Record save"}';
	
	
	break; // save
	
	
} // switch





