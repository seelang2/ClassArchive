<?php
// inc_lib.php - function library

// simple debugging line wrapped in a function for reusability
function dumpvar($array) {
	echo '<pre>'.print_r($array,true).'</pre>';
}


// data functions


function getData(&$db, $query) {
	$results = $db->query($query);
	if ($results === false) {
		// query error. handle it
		return false; // bail out of function
	}

	// return rows
	return $results->fetchAll(PDO::FETCH_ASSOC);
}

/*
  Gets tickets for a specified user
  Note that the ata access object is passed as a reference into the function
  Return array of rows or false on failure
*/
function getTicketsByOriginator(&$db, $userid, $status = -1) {

	if ($status < 0) {
		$status = ' BETWEEN 1 AND 2 ';
	} else {
		$status = ' = ' . $status . ' ';
	}

	// using a heredoc here to make this easier
	$query = <<<END
SELECT 
	tickets.id as ticket_id, 
	tickets.status,
	users.login as tech, 
	facilities.short_name as facility,
    tickets.request_date,
    tickets.description 
FROM tickets 
LEFT JOIN facilities ON tickets.location_id = facilities.id 
LEFT JOIN users on tickets.tech_id = users.id
WHERE originator_id = {$userid} 
AND tickets.status {$status}
END;

	return getData($db, $query);
}

/*
  Return array of rows or false on failure
*/
function getTicketsByTech(&$db, $userid, $status = 2) {

	// using a heredoc here to make this easier
	$query = <<<END
SELECT 
	tickets.id as ticket_id, 
	tickets.status,
	users.login as tech, 
	facilities.short_name as facility,
    tickets.request_date,
    tickets.description 
FROM tickets 
LEFT JOIN facilities ON tickets.location_id = facilities.id 
LEFT JOIN users on tickets.tech_id = users.id
WHERE tickets.tech_id = {$userid} 
AND tickets.status = {$status}
END;

	return getData($db, $query);
}

function getTicketById(&$db, $id, $withComments = true) {
	// create array to store data
	$data = array();

	$query = <<<END
SELECT
	tickets.id,
    tickets.status,
    tickets.flags,
    tickets.request_date,
    tickets.location,
    tickets.description,
    originators.login AS originator,
    techs.login AS tech,
    facilities.long_name AS facility
FROM tickets 
LEFT JOIN facilities ON facilities.id = tickets.location_id 
LEFT JOIN users AS originators ON originators.id = tickets.originator_id 
LEFT JOIN users AS techs ON techs.id = tickets.tech_id
WHERE tickets.id = {$id}
END;

	$data['tickets'] = getData($db, $query);

	if (!$withComments) return $data;

	// get comment data for ticket
	$query =<<<END
SELECT
	comments.comment,
    comments.comment_date,
    users.login AS author
FROM comments
LEFT JOIN users ON comments.author_id = users.id
WHERE comments.ticket_id = {$id}
ORDER BY comment_date DESC
END;

	$data['comments'] = getData($db, $query);

	return $data;
}