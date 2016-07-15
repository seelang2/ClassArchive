<?php

require('init.php');

include('header.php'); 

// build query
$query = "SELECT id, name FROM interests";

// send query to db server
$results = $db->query($query);

// check result
if (!$results) {
	// error. display feedback
	echo '<p>There was an error: '. $db->errorInfo()[2] . 
		 '<br />Query: ' . $query . '</p>';

	exit();
}

// process results

// check if there are any rows in table
if ($results->rowCount() < 1) {
	// no rows in table
	echo '<p>No rows in table</p>';
} else {
	// build table
	echo '<table><tbody>';

	// loop through result set and add rows to table
	while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
		echo '<tr>' .
				'<td>'. $row['id'] .'</td>' .
				'<td>'. $row['name'] .'</td>' .
			 '</tr>';
	}

	echo '</tbody></table>';
}

<?php include('footer.php'); ?>