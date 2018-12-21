<?php
require('init.php');
header('Content-type: application/json');

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
				echo json_encode($results->fetchAll(PDO::FETCH_ASSOC));
			} // if rowCount()
		} // if $results
	break; // LIST

	case 'EDIT':
		if (empty($id)) {
			echo json_encode(['status' => 'Error', 'message' => 'Invalid ID.']);
			break;
		}

		$query = "SELECT name, email, homephone, workphone FROM customers WHERE id = ".$db->quote($id);
		$result = $db->query($query);
		if (!$result) {
			// query error
			echo json_encode(['status' => 'Error', 'message' => 'Query error. '. $query]);
			break; // terminate case
		}

		if ($result->rowCount() != 1) {
			echo json_encode(['status' => 'Error', 'message' => 'Specified record not found.']);
			break;
		}

		$row = $result->fetch(PDO::FETCH_ASSOC);

		// output as json
		echo json_encode($row);
	break; // EDIT

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

