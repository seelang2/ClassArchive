<?php

// Connect to database server
// Select database to use
try {
    $db = new PDO('mysql:dbname=tc12196;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// get the query string parameters
$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);

switch($action) {
	default:
	case 'LIST':
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
							'<td>'.
								'<a href="'.$_SERVER['PHP_SELF'].'?action=edit&id='.$row['id'].'">Edit</a> '.
								'<a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$row['id'].'">Delete</a> '.
							'</td>'.
						 '</tr>';
				}
				echo '</tbody></table>';
			} // if rowCount()
		} // if $results
	break; // LIST

	case 'EDIT':
		if (empty($id)) {
			echo '<p>Invalid or no id specified.</p>';
			break;
		}

		$query = "SELECT name, email, homephone, workphone FROM customers WHERE id = ".$db->quote($id);
		$result = $db->query($query);
		if (!$result) {
			// query error
			echo '<p>Query error. '. $query .'</p>';
			break; // terminate case
		}

		if ($result->rowCount() != 1) {
			echo '<p>Specified record not found.</p>';
			break;
		}

		$row = $result->fetch(PDO::FETCH_ASSOC);

	case 'ADD': // display data entry form
	?>
		<style type="text/css">
		form label { 
			display: block;
			margin-bottom: 0.5em;
		}
		form label span, form label input {
			display: inline-block;
		}
		form label span { 
			width: 150px; 
			text-align: right;
			margin-right: 1em;
		}
		</style>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process<?php echo empty($id)? '' : '&id='.$id; ?>" method="post">
			<label>
				<span>Name:</span>
				<input name="name" value="<?php echo empty($row['name']) ? '': $row['name']; ?>" />
			</label>
			<label>
				<span>Email:</span>
				<input name="email" value="<?php echo empty($row['email']) ? '': $row['email']; ?>" />
			</label>
			<label>
				<span>Home Phone:</span>
				<input name="homephone" value="<?php echo empty($row['homephone']) ? '': $row['homephone']; ?>" />
			</label>
			<label>
				<span>Work Phone:</span>
				<input name="workphone" value="<?php echo empty($row['workphone']) ? '': $row['workphone']; ?>" />
			</label>
			<div><input type="submit" value="Save" /></div>
		</form>
	<?php
	break; // ADD

	case 'PROCESS': // process form data
		// extract data from form
		$name = $_POST['name'];
		$email = $_POST['email'];
		$homephone = $_POST['homephone'];
		$workphone = $_POST['workphone'];

		// validate and sanitize form data

		// save in database
		$query = empty($id) ? 'INSERT INTO ' : 'UPDATE ';

		$query .= " customers SET " .
								"name = ". $db->quote($name) .", " .
								"email = ". $db->quote($email) .", " .
								"homephone = ". $db->quote($homephone) .", " .
								"workphone = ". $db->quote($workphone) ." ";
		
		if (!empty($id)) $query .= ' WHERE id = ' . $db->quote($id);

		$result = $db->query($query);
		if (!$result) {
			// query error
			echo '<p>Query error. '. $query .'</p>';
			break; // terminate case
		}
		// success
		echo '<p>The record has been saved.</p>';
	break; // PROCESS

	case 'DELETE':
		if (empty($id)) {
			echo '<p>Invalid or no id specified.</p>';
			break;
		}

		$query = "DELETE FROM customers where id = ". $db->quote($id);
		$result = $db->query($query);
		if (!$result) {
			// query error
			echo '<p>Query error. '. $query .'</p>';
			break; // terminate case
		}
		// success
		echo '<p>The record has been deleted.</p>';
	break; // DELETE

} // switch $action

