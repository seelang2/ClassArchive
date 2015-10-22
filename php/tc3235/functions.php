<?php
/*
	functions.php - base function library
*/


function getDataArray($query, $dbLink = NULL) {
	// create temp array to store and return data in
	$tmpArray = array();
	
	if (!$dbLink) {
		$results = @mysql_query($query);
	} else {
		$results = @mysql_query($query, $dbLink);
	}
	
	if (!$results) {
		// query error
		return false; // return false on error encountered
	} // if results

	// loop through results and add to array
	while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
		$tmpArray[] = $row;
	} // while row
	
	return $tmpArray;
} // getDataArray




?>