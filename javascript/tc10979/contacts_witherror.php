<?php
/*
Note that this version of contacts.php has an error to demonstrate 
how error handling works in the client app.

The error is on line 125.
*/
function dbConnect() {
	// connect to db
	$db = @new mysqli('localhost', 'root', '', 'tc10979_contacts');
	if ( $db->connect_error) {
		return false; // bail out of function
	}
	return $db;
}

function getContactData($db, $id = null) {

	// send query to server
	$query = 'SELECT id, firstname, lastname, email FROM contacts ';
	if ( !empty($id) ) $query .= 'WHERE id = ' . $db->escape_string($id);
	$result = $db->query($query);

	// check query result
	if ($result === false) {
		// query error
		return false;
	}

	// retrieve and return data
	return $result->fetch_all(MYSQLI_ASSOC);

} // getContactData

function saveContactData($db, $data, $id = null) {

	$query = empty($id) ? 'INSERT INTO ' : 'UPDATE ';

	$query .= ' contacts SET ' .
			 " firstname = '". $db->escape_string($data['firstname']) ."', " .
			 " lastname = '". $db->escape_string($data['lastname']) ."', " .
			 " email = '". $db->escape_string($data['email']) ."' ";

	if (!empty($id)) $query .= ' WHERE id = ' . $db->escape_string($id);

	$result = $db->query($query);

	return $result;		
}


$action = empty($_GET['action']) ? 'VIEW' : strtoupper($_GET['action']);
if ( !empty($_GET['id']) ) { $id = $_GET['id']; } else { $id = null; }

// define JSON wrapper data
$response = array(
	'status' => 1,
	'statusMsg' => 'Ok',
	'requestData' => null
);



switch($action) {
	case 'VIEW': 	// view records
		$db = dbConnect();
		if (!$db) {
			// database error
			$response['status'] = 0;
			$response['statusMsg'] = 'Database Error';
			break;
		}

		$results = getContactData($db, $id);

		if ($results === false) {
		} else {
			if ( empty($id) ) {
				// data processing is fine
				$response['requestData'] = $results;				
			} else {
				// can't find record for id
				$response['status'] = 0;
				$response['statusMsg'] = 'Invalid ID specified';
			}
		}

	break;

	case 'SAVE': 	// save new record or update existing record
		$db = dbConnect();
		if (!$db) {
			// database error
			$response['status'] = 0;
			$response['statusMsg'] = 'Database Error';
			break;
		}

		// data validation
		$dataIsValid = true; // innocent until proven guilty

		// firstname can't be blank
		if ( empty($_POST['firstname']) ) {
			$dataIsValid = false;
		}

		// lastname can't be blank
		if ( empty($_POST['lastname']) ) {
			$dataIsValid = false;
		}

		// email can't be blank
		if ( empty($_POST['email']) ) {
			$dataIsValid = false;
		}

		if (!$dataIsValid) {
			$response['status'] = 0;
			$response['statusMsg'] = 'Data validation failed';
			break; // terminate case
		}

		// where's the data?
		// note that the typo $_POSTXXX is deliberate to test error handling
		$result = saveContactData($db, $_POSTXXX, $id);

		if ($result === false){
			// query error
			$response['status'] = 0;
			$response['statusMsg'] = 'Database or query Error';
		} else {
			if (empty($id)) {
				// get last insert id of newly saved record
				$response['lastInsertId'] = $db->insert_id;
			}
		}

	break;

} // switch $action

// return JSON response to user agent
header('Content-type: application/json');
echo json_encode($response);

