<?php
/****

 **/



// apply pattern and build query
switch($pattern) {
	case 'C':
		$query = "SELECT * FROM {$requestArray[0]}";
	break;
	
	case 'CI':
		$query = "SELECT * FROM {$requestArray[0]} WHERE id = {$requestArray[1]}";
	break;
	
	case 'CIC':
		$c1 = $requestArray[0];
		$c2 = $requestArray[2];
		$i1 = $requestArray[1];
		
		$localKey = $schema[$c1]['relationships'][$c2]['localKey'];
		$remoteKey = $schema[$c1]['relationships'][$c2]['remoteKey'];
		// if there's a link table, replace collection 1 with the link table info
		if (isset($schema[$c1]['relationships'][$c2]['linkTable'])) {
			$c1 = $schema[$c1]['relationships'][$c2]['linkTable'];
		}
		
		$query = "SELECT * FROM {$c2} INNER JOIN {$c1} ON {$localKey} = {$remoteKey} WHERE {$localKey} = {$i1}";
	break;
	
	case 'CC':
		$c1 = $requestArray[0];
		$c2 = $requestArray[1];
		
		$localKey = $schema[$c1]['relationships'][$c2]['localKey'];
		$remoteKey = $schema[$c1]['relationships'][$c2]['remoteKey'];
		// if there's a link table, replace collection 1 with the link table info
		if (isset($schema[$c1]['relationships'][$c2]['linkTable'])) {
			$c1 = $schema[$c1]['relationships'][$c2]['linkTable'];
		}
		
		$query = "SELECT * FROM {$c2} INNER JOIN {$c1} ON {$localKey} = {$remoteKey}";
	break;
} // switch

		
//echo '</p>Query: ' . $query . '</p>';		
	
// send query to server
$results = $db->query($query);

// check response
if ($results === false) {
	// error encountered
	$error = $db->errorInfo();
	
	$response = array(
		'status' => 0,
		'message' => 'Query error ('.$error[0].') near "'.$error[2].'": '. $query
	);
	exit(json_encode($response)); // send data as JSON and terminate
}

/*
// use this for dealing with huge result sets
while ($row = $results->fetch()) {

}
*/

// process response if applicable
//echo pr($results->fetchAll(PDO::FETCH_ASSOC));
echo json_encode($results->fetchAll(PDO::FETCH_ASSOC));


