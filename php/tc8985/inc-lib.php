<?php
/**
 *	inc-lib.php - Library include 
 */

// basic debuggin function
function dump($array) {
	return '<pre>'.print_r($array,true).'</pre>';
}

// database functions

// process db queries
// a reference to the database instance is passed to the function
// instead of importing the global var
function process_query(&$db, $query) {
	// import global vars into function scope - not recommended
	//global $db;

	// send query to server
	$result = $db->query($query);

	// check query result
	if ($result === false) {
		// query error. Display feedback
		echo '<p>Query error: '. $db->error .
			 '<br />Query: '. $query . '</p>';
		return false; // terminate function with false
	}

	// process results
	// mysqli returns boolean true for queries with no result
	// sets or a mysqli_result object.

	if ($result === true) {
		return true;
	}

	// return result object
	return $result;


} // process_query


function listTrucks(&$db) {
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

	// returns false or result object
	return process_query($db, $query);

} // listTrucks


function deleteTruck(&$db, $id) {
	if (empty($id)) return false; // bail if no id present

	$query = "DELETE FROM trucks WHERE id = '{$id}'";

	// will return false if query error or true if it worked
	return process_query($db, $query);
}


