<?php
// connect to database server and select database
// the @ in front of new suppresses warning messages
$db = @new mysqli('localhost', 'root', '', 'tc10963');

// check if conection worked
if ($db->connect_error) {
	// problem with database connection - abort
	exit('Error connecting to database server.');
}

// data validation
$formIsValid = true;
// blah blah blah

// ALWAYS SANITIZE USER DATA BEFORE USING IN QUERY
$name = $db->real_escape_string($_POST['name']);
$location = $db->real_escape_string($_POST['location']);
$term = $db->real_escape_string($_POST['term']);
$instructor_id = $db->real_escape_string($_POST['instructor_id']);

if ($formIsValid) {
	// save data to database
	$query = "INSERT INTO courses SET " .
				"course_name = '$name', " . 
				"location = '$location', " . 
				"term = '$term', " . 
				"instructor_id = '$instructor_id' ";

	$result = $db->query($query);

	if (!$result) {
		// some error
		echo '<p>Query error. No soup for you! *snap* <br />Query: ' . $query;
	} else {
		// huzzah, it worked
		echo '<p>The record has been saved.<br />Query: ' . $query.'</p>';
	}

} else {
	// data invalid, display feedback

}

