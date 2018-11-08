<?php
/**
 * inc_properties_list.php - List properties
 */

// build query
$query = "SELECT 
			properties.id, 
			properties.name, 
			addresses.address_1, 
			addresses.address_2, 
			addresses.city, 
			addresses.state, 
			addresses.zip 
		  FROM properties LEFT JOIN addresses ON owner_id = properties.id";

// send query to server
$results = $db->query($query);
// check query for errors
if (!$results) {
	// query error. display user feedback
	echo '<p>Query error. No soup for you *snap*</p>';
	return; // terminate case
}

// process result set
echo '<table><tbody>';
// loop through result rows and display each row in table
while($row = $results->fetch(PDO::FETCH_ASSOC)) {
	echo '<tr>' .
			'<td>' . $row['id'] . '</td>' .
			'<td>' . $row['name'] . '</td>' .
			'<td>' . $row['address_1'] . '</td>' .
			'<td>' . $row['address_2'] . '</td>' .
			'<td>' . $row['city'] . '</td>' .
			'<td>' . $row['state'] . '</td>' .
			'<td>' . $row['zip'] . '</td>' .
			'<td>' .
				'<a href="'.$_SERVER['PHP_SELF'].'?action=edit&id='. $row['id'].'">Edit</a> | ' . 
				'<a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='. $row['id'].'">Delete</a>' . 
			'</td>' .
		 '</tr>';
} // while

echo '</tbody></table>';

