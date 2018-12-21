<?php

// Connect to database server
// Select database to use
try {
    $db = new PDO('mysql:dbname=tc12196;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Build query
$query = "SELECT id, name, homephone, workphone, email FROM customers";
// Send query to server
$results = $db->query($query);
// Check query result
if (!$results) {
	// query error
	echo '<p>Query error. No soup for you! *snap*</p>';
} else {
	// Process results (if any)
	if ($results->rowCount() == 0) {
		// no rows
		echo '<p>No data in table.</p>';
	} else {
		// display results in a table
		echo '<table><tbody>';
		// loop through result set and output table rows
		while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
			echo '<tr>'.
					'<td>'. $row['id'] .'</td>'.
					'<td>'. $row['name'] .'</td>'.
					'<td>'. $row['homephone'] .'</td>'.
					'<td>'. $row['workphone'] .'</td>'.
					'<td>'. $row['email'] .'</td>'.
				 '</tr>';
		}
		echo '</tbody></table>';
	} // if rowCount()
} // if $results


