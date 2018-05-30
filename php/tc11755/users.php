<?php

// connect to database server
// select database

try {
	$db = new PDO('mysql:dbname=tc11755;host=localhost', 'root', '');
} catch(PDOException $error) {
	echo '<p>Database error. No soup for you! *snap*</p>';
}

// get department data
// build query
$query = 'SELECT departmentid, name FROM departments';
// send query to server
$results = $db->query($query);
// check query
if (!$results) {
	// query error
	echo '<p>Query error. No soup for you! *snap* <br />' .
				$query . '</p>';
} else {
	// build select element
	$departmentSELECT = '<select name="department">';
	// loop through result rows and add OPTIONs to the SELECT
	while($row = $results->fetch(PDO::FETCH_ASSOC)) {
		//echo '<pre>'.print_r($row,true).'</pre>';
		$departmentSELECT .= '<option value="'.
															$row['departmentid'].'">'.
															$row['name'].'</option>';
	
	}
	// finish off SELECT
	$departmentSELECT .= '</select>';

	echo $departmentSELECT;

}



