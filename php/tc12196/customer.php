<?php
require('init.php');


// get the query string parameters
$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);

switch($action) {
	default:
	case 'LIST':
		include('header.php');

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
		include('header.php');
	?>
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
		$formIsValid = true; // innocent until proven guilty
		$validationErrors = '';

		/*
		Can't be empty: if (empty($field))
		Minimum length: if (strlen($field) < 5)
		Email: if (preg_match('/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,4}$/', $field) < 1)
		*/

		// field can't be blank/empty
		if (empty($name)) {
			$formIsValid = false; // invalidate form
			$validationErrors .= 'Name cannot be blank.<br />';
		}

		if (preg_match('/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,4}$/', $email) < 1) {
			$formIsValid = false; // invalidate form
			$validationErrors .= 'Email appears to be invalid.<br />';
		}

		if (!$formIsValid) {
			// form is invalid
			echo '<p>The following errors were found: <br />'. $validationErrors . 
			'Please go back and try again.</p>';
			break;
		}

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
		//echo '<p>The record has been saved.</p>';
		$_SESSION['flashMessage'] = '<p>The record has been saved.</p>';
		// redirect to list view
		header('Location: '.$_SERVER['PHP_SELF'].'?action=list');
		exit(); // ALWAYS exit after a redirect

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

include('footer.php');
