<?php

// connect to database server and select database
// the @ in front of new suppresses warning messages
$db = @new mysqli('localhost', 'root', '', 'tc10963');

// check if conection worked
if ($db->connect_error) {
	// problem with database connection - abort
	exit('Error connecting to database server.');
}


// build a table listing the instructors

// build query
$query = "SELECT id, name, phone, email FROM instructors";

// send query to db server
$results = $db->query($query);

// check response
if (!$results) {
	// query error. 
	echo '<p>Query error. No soup for you! *snap* <br />Query: ' . $query;

} else {
	// process results (if any)

	// are there any rows?
	if ($results->num_rows == 0) {
		// no rows to process
		echo '<p>No data in table.</p>';
	} else {
		// display content in table:

		// add table opening tags
		echo '<table><tbody>';
		
		// for every row in result set:
		while ($row = $results->fetch_assoc()) {
			// display fields/columns in HTML table row
			echo '<tr>' . 
					'<td>' . $row['id'] . '</td>' . 
					'<td>' . $row['name'] . '</td>' . 
					'<td>' . $row['email'] . '</td>' . 
					'<td>' . $row['phone'] . '</td>' . 
				 '</tr>';
		} // while

		// add table closing tags
		echo '</tbody></table>';

	} // if num_rows
} // if !$results

