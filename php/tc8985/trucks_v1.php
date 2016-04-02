<?php
require('init.php');

include('header.php');

switch ($action) {
	case 'LIST': // list records in table
		// build query
		$query = 'SELECT 
					trucks.id, 
					trucks.number, 
					drivers.name AS driver, 
					clients.name AS client 
				  FROM 
				    trucks 
				  LEFT JOIN drivers 
				    ON trucks.driver_id = drivers.id 
				  LEFT JOIN clients 
				    ON trucks.client_id = clients.id
				 ';

		// send query to server
		$results = $db->query($query);

		// check query result
		if ($results === false) {
			// query error. Display feedback
			echo '<p>Query error: '. $db->error .
				 '<br />Query: '. $query . '</p>';
			break; // terminate case
		}

		// process results

		// if no rows 
		if ($results->num_rows == 0) {
			//display feedback
			echo '<p>No rows in table.</p>';
		} else {
		//  else display results in HTML table
			// create initial table markup
			echo '<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Number</th>
							<th>Driver</th>
							<th>Client</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>';
			// for each row in result set
				while ($row = $results->fetch_assoc()) {
					// create new row in table
					echo '<tr>'.
							'<td>'. $row['id'] . '</td>'.
							'<td>'. $row['number'] . '</td>'.
							'<td>'. $row['driver'] . '</td>'.
							'<td>'. $row['client'] . '</td>'.
							'<td>'.
								'<a href="trucks.php?action=edit&id='.$row['id'].'">Edit</a> | '.
								'<a href="trucks.php?action=delete&id='.$row['id'].'">Delete</a>'.
							'</td>'.
						 '</tr>';
				}
			// close out table markup
			echo '</tbody></table>';
		}

	break; // LIST

	case 'EDIT': // edit record
		// verify id is present
		if (empty($id)) {
			// display feedback and bail
			echo '<p>Error: Invalid ID.</p>';
			break; // terminate case
		}

		// retrieve record from db
		$query = "SELECT 
			trucks.id, 
			trucks.number, 
			trucks.driver_id,
			trucks.client_id 
		FROM trucks 
		WHERE id = '{$id}' ";

		$result = $db->query($query);

		if ($result === false) {
			// query error. Display feedback
			echo '<p>Query error: '. $db->error .
				 '<br />Query: '. $query . '</p>';
			break; // terminate case
		}

		$row = $result->fetch_assoc();

		echo '<pre>'.print_r($row, true).'</pre>';

		// display record in form
	// EDIT no break added intentionally

	case 'ADD': // add a new row to the database table
		include('trucks-form.php');
	break; // ADD

	case 'PROCESS': // update database

		// preprocess data
		// validate data
		$isValidData = true; // innocent until proven guilty
		$validationMessages = '';

		// test that number is a numeric value
		if (!is_numeric($_POST['number'])) {
			// rule has failed
			$isValidData = false; // invalidate form data
			$validationMessages .= '<br />Number field must be numeric.';
		}

		if (!$isValidData) {
			// form data invalid. Display feedback and bail
			echo '<p>There was an error in one or more fields: ' .
			$validationMessages .
			'<br />Please go back and correct the specified field(s).</p>';
			break; // terminate process
		}

		// ALWAYS remember to sanitize your data!
		$number = $db->real_escape_string($_POST['number']);
		$driverId = $db->real_escape_string($_POST['driver_id']);
		$clientId = $db->real_escape_string($_POST['client_id']);

		// update database
		// build query
		if (empty($id)) {
			$query = 'INSERT INTO ';
		} else {
			$query = 'UPDATE ';
		}

		$query .= 'trucks SET ' .
			"number = {$number}, " . 
			"driver_id = {$driverId}, " . 
			"client_id = {$clientId} ";

		if (!empty($id)) $query .= " WHERE id='{$id}' ";

		// send query to server
		$result = $db->query($query);

		// check query result
		if ($result === false) {
			// query error. Display feedback
			echo '<p>Query error: '. $db->error .
				 '<br />Query: '. $query . '</p>';
			break; // terminate case
		}

		// process any results
		if ($db->affected_rows != 1) {
			// affected rows doesn't match up
			echo '<p>Error: Total rows affected: ' .
				$db->affected_rows . ' is not 1.</p>';
			break;
		}

		// everything's good, it worked - display feedback
		echo '<p>The record has been saved.</p>';

	break; // PROCESS

	case 'DELETE': // delete record
		// verify id is present
		if (empty($id)) {
			// display feedback and bail
			echo '<p>Error: Invalid ID.</p>';
			break; // terminate case
		}
		$query = "DELETE FROM trucks WHERE id = '{$id}'";
		$result = $db->query($query);
		if ($result === false) {
			// query error. Display feedback
			echo '<p>Query error: '. $db->error .
				 '<br />Query: '. $query . '</p>';
			break; // terminate case
		}
		// display success feedback
		echo '<p>The record was successfully deleted.</p>';
	break; // DELETE
} // switch

include('footer.php');

?>