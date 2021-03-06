<?php

// get connection to database server and database
// use @ in front of the comand or set warning levels in php.ini config file
$db = @new mysqli("localhost", "root", "xampp", "tc6780");

// test for errors
if ($db->connect_errno) {
    //exit("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
    exit('Unable to connect right now. Please try again later.');
}

if (empty($_POST)) {
	// no data submitted to process, bail
	echo '<p>No data to process.</p>';
} else{
	//process form data
	
	// extract and sanitize data from $_POST
	$firstname = $db->real_escape_string($_POST['firstname']);
	$lastname = $db->real_escape_string($_POST['lastname']);
	
	$dob = $db->real_escape_string($_POST['year']) . '-' . 
		   $db->real_escape_string($_POST['month']) . '-' .
		   $db->real_escape_string($_POST['day']);
		   
	$phone = $db->real_escape_string($_POST['phone']);
	$gender = $db->real_escape_string($_POST['gender']);
	
	// build query
	
	//$q = "INSERT INTO family SET name = '{$name}', phone = '{$phone}', paternal_id = '{$paternal}', maternal_id = '{$maternal}' ";
	
	$query = "INSERT INTO people SET " .
	
			 "name = '".$name."', " .
			 
			 "phone = '".$phone."', " .
			 
			 "paternal_id = '".$paternal."', " .
			 
			 "maternal_id = '".$maternal."' ";
	
	// send to server
	$result = $db->query($query);
	
	// check result
	if (!$result) {
		// query error
		echo '<p>Query error. No soup for you! *snap*</p>';
	} else {
		// success,display feedback
		echo '<p>The record has been saved.</p>';
	}
}

