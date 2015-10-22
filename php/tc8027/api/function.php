<?php

/*
	Retrieves a list of records or a specific record if id is present
*/
function get(&$db, $model, $fields = '*', $id = null) {
	$query = "SELECT ".$fields." FROM ".$model;
	if (!empty($id)) $query .= " WHERE id = ". $db->quote($id);
	$results = $db->query($query);
	if ($results === false) {
		return false;
	}
	return $results->fetchAll(PDO::FETCH_ASSOC);
} // get

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
		$query .= $fieldName . " = " . $db->quote($fieldValue);
	}
	
	if (!empty($id)) $query .= " WHERE id = " . $id;
	
	$result = $db->query($query); // send query to server
	
	if ($result === false) {
		return false;
	}
	if ($result->rowCount() != 1) {
		return false;
	}
	
	// no data to return, just return true
	return true;
} // save





function alumni_get(&$db, $id = null) {	
	$fields = 'alumni.id, alumni.firstname, alumni.lastname, schools.name AS school';
	$model = 'alumni LEFT JOIN schools ON alumni.school_id = schools.id';
	
	return get($db, $model, $fields, $id);
}





function fundraisers_get(&$db, $school_id = null) {
	$query = "SELECT fundraisers.id, fundraisers.name, fundraisers.description, fundraisers.goal, schools.name AS school FROM fundraisers INNER JOIN schools ON fundraisers.school_id = schools.id";
	
	$results = $db->query($query);
	if ($results === false) {
		return false;
	}
	return $results->fetchAll(PDO::FETCH_ASSOC);
}
