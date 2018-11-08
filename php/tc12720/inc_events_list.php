<?php


// build query
$query = 'SELECT
	events.id,
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
	break; // bail out of case
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
				'<td>'.
					'<a href="events.php?action=edit&id='.$row['id'].'">Edit</a>'.
				'</td>'.
			 '</tr>';
	}
	echo '</tbody></table>';
}

// create CSV file, save to server and display download link
$results->data_seek(0); // reset result row pointer

$outputFile = fopen('output/data.csv', 'w+'); // set up file for writing

// loop through result set and write rows to file
while ($row = $results->fetch_assoc()) {
	$line = implode(',', $row) . "\n"; // combine row items into a string with new line char
	fwrite($outputFile, $line);
}

fclose($outputFile); // close file

/*
?>
<div>
	<p><a href="output/data.csv">Download Event list as CSV</a></p>
</div>
<?php
// continue


*/