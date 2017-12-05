<?php
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
	$query = 'SELECT id, firstname, lastname, email, status FROM contacts ';
	if ( !empty($id) ) $query .= 'WHERE id = ' . $db->escape_string($id);

	//echo $query; exit();

	$result = $db->query($query);

	// check query result
	if ($result === false) {
		// query error
		return false;
	}

	// retrieve and return data
	return $result->fetch_all(MYSQLI_ASSOC);

} // getContactData

function searchContacts($db, $q = null, $limit = 8) {

	// send query to server
	$query = "SELECT id, firstname, lastname FROM contacts WHERE firstname LIKE '$q%' OR lastname LIKE '$q%' ORDER BY firstname ASC, lastname ASC LIMIT $limit";

	//echo $query; exit();

	$result = $db->query($query);

	// check query result
	if ($result === false) {
		// query error
		return false;
	}

	// retrieve and return data
	return $result->fetch_all(MYSQLI_ASSOC);

} // searchContacts

function saveContactData($db, $data, $id = null) {

	$query = empty($id) ? 'INSERT INTO ' : 'UPDATE ';

	$query .= ' contacts SET ' .
			 " firstname = '". $db->escape_string($data['firstname']) ."', " .
			 " lastname = '". $db->escape_string($data['lastname']) ."', " .
			 " status = '". $db->escape_string($data['status']) ."', " .
			 " email = '". $db->escape_string($data['email']) ."' ";

	if (!empty($id)) $query .= ' WHERE id = ' . $db->escape_string($id);

	$result = $db->query($query);

	return $result;		
}


$action = empty($_GET['action']) ? 'VIEW' : strtoupper($_GET['action']);
if ( !empty($_GET['id']) ) { $id = $_GET['id']; } else { $id = null; }
$query = empty($_GET['q']) ? null : strtolower($_GET['q']);

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
			// query error
			$response['status'] = 0;
			$response['statusMsg'] = 'Query Error';
		} else {
			if ( empty($id) ) {
				// data processing is fine
				$response['requestData'] = $results;				
			} else {
				// id specified, so we're looking for a specific record
				if (empty($results)) {
					// can't find record for id
					$response['status'] = 0;
					$response['statusMsg'] = 'Invalid ID specified';
					break;
				}
				$response['requestData'] = $results;
			}
		}

	break; //view

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
		$result = saveContactData($db, $_POST, $id);

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

	break; // save

	case 'SEARCH':
		$db = dbConnect();
		if (!$db) {
			// database error
			$response['status'] = 0;
			$response['statusMsg'] = 'Database Error';
			break;
		}

		$result = searchContacts($db, $query);

		if ($result === false) {
			// query error
			$response['status'] = 0;
			$response['statusMsg'] = 'Query Error';
		} else {
			$response['requestData'] = $result;				
		}
	break; // search

} // switch $action

// return JSON response to user agent
header('Content-type: application/json');
echo json_encode($response);

