<?php

// connect to database server and select database to use

try {
	$db = new PDO('mysql:dbname=tc12315;host=localhost','root','');
} catch (PDOException $error) {
	echo 'Error connecting to server: '. $error->getMessage();
	exit(); // terminate script
}

// get URI parameters
if (empty($_GET['action'])) { 
	$action = 'LIST'; 
} else { 
	$action = strtoupper($_GET['action']);
}

if (empty($_GET['id'])) { 
	unset($id); // ensure $id is not set 
} else { 
	$id = strtoupper($_GET['id']);
}

switch($action) {
	default:
	case 'LIST': // list all items
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
			break; // terminate case
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
						'<a href="properties.php?action=edit&id='. $row['id'].'">Edit</a> | ' . 
						'<a href="properties.php?action=delete&id='. $row['id'].'">Delete</a>' . 
					'</td>' .
				 '</tr>';
		} // while

		echo '</tbody></table>';

	break; // LIST

	case 'EDIT': // EDIT
		if (empty($id)) break; // bail if no id is present

		// retrieve item data
		$query = "SELECT 
					properties.id, 
					properties.name, 
					addresses.id as address_id,
					addresses.address_1, 
					addresses.address_2, 
					addresses.city, 
					addresses.state, 
					addresses.zip 
				  FROM properties LEFT JOIN addresses ON owner_id = properties.id 
				  WHERE properties.id = " . $db->quote($id);

		$result = $db->query($query);
		if (!$result) {
			// query error. display user feedback
			echo '<p>Query error. No soup for you *snap*<br />'.$query.'</p>';
			break; // terminate case
		}
		// get row data
		$row = $result->fetch(PDO::FETCH_ASSOC);


	// note that there is no break statement here on purpose

	case 'ADD': // add new item (display data entry form)
	?>
		<h2>Add New Property</h2>
		<form action="properties.php?action=processform<?php if (!empty($id)) echo '&id='.$id; ?>" method="post">
			<input type="hidden" name="address_id" value="<?php if (!empty($row['address_id'])) echo $row['address_id']; ?>" />
			<label>
				<span>Property Name:</span>
				<input name="name" value="<?php if (!empty($row['name'])) echo $row['name']; ?>" />
			</label>
			<label>
				<span>Address line 1:</span>
				<input name="address_1" value="<?php if (!empty($row['address_1'])) echo $row['address_1']; ?>" />
			</label>
			<label>
				<span>Address line 2:</span>
				<input name="address_2" value="<?php if (!empty($row['address_2'])) echo $row['address_2']; ?>" />
			</label>
			<label>
				<span>City:</span>
				<input name="city" value="<?php if (!empty($row['city'])) echo $row['city']; ?>" />
			</label>
			<label>
				<span>State:</span>
				<input name="state" value="<?php if (!empty($row['state'])) echo $row['state']; ?>" />
			</label>
			<label>
				<span>Zip:</span>
				<input name="zip" value="<?php if (!empty($row['zip'])) echo $row['zip']; ?>" />
			</label>
			<div><input type="submit" value="Save" /></div>
		</form>
	<?php
	break; // ADD

	case 'PROCESSFORM': // process data entry form
		// check if there's any data to process
		if (empty($_POST)) break; // terminate if no data is present

		// extract data from form
		$address_id = $_POST['address_id'];
		$name = $_POST['name'];
		$address_1 = $_POST['address_1'];
		$address_2 = $_POST['address_2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];

		// validate data
		$dataIsValid = true; // start off assuming the data is valid
		$errorMessages = []; // empty array of error messages

		// look for exceptions invalidating data

		// example: field can't be blank
		if (empty($name)) {
			$dataIsValid = false; // invalidate data
			array_push($errorMessages, 'Name cannot be blank.');
		}

		if (empty($address_1)) {
			$dataIsValid = false; // invalidate data
			array_push($errorMessages, 'Address cannot be blank.');
		}

		if (empty($city)) {
			$dataIsValid = false; // invalidate data
			array_push($errorMessages, 'City cannot be blank.');
		}

		if (strlen($state) != 2) {
			$dataIsValid = false; // invalidate data
			array_push($errorMessages, 'State must be 2 characters.');
		}

		if (strlen($zip) < 5) {
			$dataIsValid = false; // invalidate data
			array_push($errorMessages, 'Zip must be at least 5 characters.');
		}

		// check if form is valid
		if (!$dataIsValid) {
			// form is invalid
			echo '<p>The following errors were found:<br />' .
				 implode('<br />', $errorMessages) . 
				 '<br />Please go back and try again.</p>';
			break;
		}

		// DON'T FORGET TO ALWAYS SANITIZE THE DATA!

		// save property record
		if (empty($id)) {
			$query = "INSERT INTO ";
		} else {
			$query = "UPDATE ";
		}

		$query .= "properties SET name = " . $db->quote($name);

		if (!empty($id)) $query .= ' WHERE id = ' . $db->quote($id);

		$result = $db->query($query);
		// check to see if query was successful
		if (!$result) {
			// query error. display user feedback
			echo '<p>Query error. No soup for you *snap*</p>';
			break; // terminate case
		}

		// If adding new record, retrieve saved record id otherwise use existing id
		// use ternary for brevity
		$property_id = empty($id) ? $db->lastInsertId() : $id;

		if (empty($id)) {
			$query = "INSERT INTO ";
		} else {
			$query = "UPDATE ";
		}

		// save address record
		$query .= "addresses SET " .
					"address_1 = " . $db->quote($address_1) . "," .
					"address_2 = " . $db->quote($address_2) . "," .
					"city = " . $db->quote($city) . "," .
					"state = " . $db->quote($state) . "," .
					"zip = " . $db->quote($zip);

		if (empty($id)) {
			$query .= "," .
					"owner_id = " . $db->quote($property_id) . "," .
					"type = 1";
		} else {
			$query .= ' WHERE id = ' . $db->quote($address_id);
		}

		$result = $db->query($query);
		// check to see if query was successful
		if (!$result) {
			// query error. display user feedback
			echo '<p>Query error. No soup for you *snap*</p>';
			break; // terminate case
		}

		// operation successful. Display feedback.
		echo '<p>The record was successfully saved.</p>';

	break; // PROCESSFORM

} // switch $action




