<?php

/*
	Retrieves a list of records or a specific record if id is present
*/
function get(&$db, $model, $fields = '*', $id = null) {
	$query = "SELECT ".$fields." FROM ".$model;
	if (!empty($id)) $query .= " WHERE id = ". PDO::quote($id);
	$results = $db->query($query);
	if ($results === false) {
		return false;
	}
	return $results->fetchAll(PDO::FETCH_ASSOC);
} // get

/*
function save(&$db, $model, $fields, $id = null) {
	// save posted data to table
	if (empty($fields)) {
		return false;
	}
	// build query
	// we'll ignore validation but not sanitization
	if (empty($id)) {
		$query = "INSERT INTO ";
	} else {
		$query = "UPDATE ";
	}
	
	$query .= $model . " SET ";
	// loop through field array, sanitize, and add to query
	$c = 0; // throwaway counter
	foreach ($fields as $fieldName => $fieldValue) {
		$query .= $c++ > 0 ? ", " : "";
		$query .= $fieldName . " = " . PDO::quote($fieldValue);
	}
	
	if (!empty($id)) $query .= " WHERE id = " $id;
	
	$result = $dbh->query($query); // send query to server
	
	if ($result === false) {
		return false;
	}
	if ($result->rowCount() != 1) {
		return false;
	}
	
	// no data to return, just return true
	return true;
} // save








function get_school_fundraiser_list(&db, $school_id = null) {
	$query = "SELECT fundraisers.id, fundraisers.name, fundraisers.description, fundraisers.goal, schools.name AS school FROM fundraisers INNER JOIN schools ON fundraisers.school_id = schools.id";
	
	$results = $db->query($query);
	if ($results === false) {
		return false;
	}
	return $results->fetchAll(PDO::FETCH_ASSOC);
}
*/
