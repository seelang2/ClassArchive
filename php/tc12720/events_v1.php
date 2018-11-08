<?php


// connect to db server and select db
$db = new mysqli('localhost','adminer','a9e.1FD13!','tc12720');

if ($db->connect_error) {
	exit('<strong>Error:</strong> Unable to connect to database server.<br />Error: '.$db->connect_error);

	// redirect to error page
	//header('Location: errorpage.php');
	//exit(); // ALWAYS explicitly call exit() after redirect
}

// display event list in a table

// build query
$query = 'SELECT
	events.name AS eventname,
	events.start_datetime,
	events.end_datetime,
	locations.name AS location,
	locations.city,
	locations.state,
	count(attendees.id) as attendee_count
FROM
	events
LEFT JOIN locations
ON locations.id = events.location_id
LEFT JOIN attendees_events
ON events.id = attendees_events.event_id
LEFT JOIN attendees
ON attendees_events.attendee_id = attendees.id
GROUP BY events.id';

// send query to server
$results = $db->query($query);
// check response
if (!$results) {
	// query error
	echo '<p>Query error. No soup for you! *snap* <br />'.$db->error.'</p>';
	exit();
}

// process results

if ($results->num_rows == 0) {
	echo '<p>No data to display.</p>';
} else {
	// display table
	echo '<table><tbody>';
	// loop through result set and create table rows
	while ($row = $results->fetch_assoc()) {
		echo '<tr>'.
				'<td>'. $row['eventname'] .'</td>'.
				'<td>'. $row['start_datetime'] .'</td>'.
				'<td>'. $row['end_datetime'] .'</td>'.
				'<td>'. $row['location'] .'</td>'.
				'<td>'. $row['city'] .'</td>'.
				'<td>'. $row['state'] .'</td>'.
				'<td>'. $row['attendee_count'] .'</td>'.
			 '</tr>';
	}
	echo '</tbody></table>';
}












