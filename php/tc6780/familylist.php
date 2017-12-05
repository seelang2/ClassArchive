<?php

// get connection to database server and database
// use @ in front of the comand or set warning levels in php.ini config file
$db = @new mysqli("localhost", "root", "xampp", "tc6780");

// test for errors
if ($db->connect_errno) {
    //exit("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
    exit('Unable to connect right now. Please try again later.');
}

// build query
$query = "SELECT id, name FROM family";

// send query to server
$results = $db->query($query);

// check result
if ($results === false) {
	echo '<p>Error in query.</p>';
} else {

	// process results if any
	while ($row = $results->fetch_assoc()) {
		echo '<p>' . $row['id'] . ' ' . $row['name'] . '</p>';
	}

}




