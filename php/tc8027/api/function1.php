<?php

// school module functions
function school_list(&$db) {
	$query = "SELECT id, name FROM schools";
	$results = $db->query($query);
	if ($results === false) {
		return false;
	}
	return $results->fetchAll(PDO::FETCH_ASSOC);
}

function get_school_fundraiser_list(&db, $school_id = null) {
	$query = "SELECT fundraisers.id, fundraisers.name, fundraisers.description, fundraisers.goal, schools.name AS school FROM fundraisers INNER JOIN schools ON fundraisers.school_id = schools.id";
	
	$results = $db->query($query);
	if ($results === false) {
		return false;
	}
	return $results->fetchAll(PDO::FETCH_ASSOC);
}
