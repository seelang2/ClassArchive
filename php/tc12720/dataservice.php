<?php
/**
 * API access for data
 */

require('init.php');

/*
	Query string parameters
	model 	- Specifies the data collection to access. Options: events|attendees
	action 	- Specifies the operation to perform on the data. Options: view|add|delete
	id 			- Specifies record to retrieve in a collection.
*/

$model = empty($_GET['model']) ? null : strtoupper($_GET['model']);
$action = empty($_GET['action']) ? null : strtoupper($_GET['action']);
$id = empty($_GET['id']) ? null : $db->real_escape_string($_GET['id']);

// switch that controls model selection
switch($model) {
	default:
		echo 'error';
	break;
	case 'EVENTS':
		switch($action) {
			default:
				echo 'error';
			break;

			case 'LIST':
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
					echo 'error';
					break; // bail out of case
				}

				// process results
				header('Content-Type: application/json');

				if ($results->num_rows == 0) {
					// no data, so output an empty array serialized as JSON
					echo json_encode([]);
				} else {
					//$data = $results->fetch_all(MYSQLI_ASSOC);
					//dump($data);

					// get full result set as an associative array and serialize
					echo json_encode($results->fetch_all(MYSQLI_ASSOC));
				}

			break;
		} // switch $action

	break; // EVENTS
} // switch $model


