<?php
/**
 * inc_properties_edit.php - Edit properties
 */

if (empty($id)) return; // bail if no id is present

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
	return; // terminate case
}
// get row data
$row = $result->fetch(PDO::FETCH_ASSOC);



