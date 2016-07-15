<?php
// if there's no POST data then bail
if (empty($_POST)) exit('No data to save.');

// connect to db server and select database
try {
	// create an instance of the PDO class
	$db = new PDO('mysql:dbname=tc9342;host=localhost',
				  'root',
				  'xampp');

} catch (PDOException $e) {
    // terminate if there was a database error
    exit( 'Connection failed: ' . $e->getMessage() );
}

// build query
// ALWAYS sanitize data before using it in a query
$query = "INSERT INTO interests SET ".
			"name = ". $db->quote($_POST['name']) ." ";

// send query to db server
$result = $db->query($query);

// check result
if (!$result) {
	// error. display feedback
	echo '<p>There was an error: '. $db->errorInfo()[2] . 
		 '<br />Query: ' . $query . '</p>';

	exit();
}

// operation successful, display feedback
echo '<p>The record was saved.</p>';

