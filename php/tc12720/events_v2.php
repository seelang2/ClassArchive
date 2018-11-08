<?php


// connect to db server and select db
$db = new mysqli('localhost','adminer','a9e.1FD13!','tc12720');

if ($db->connect_error) {
	exit('<strong>Error:</strong> Unable to connect to database server.<br />Error: '.$db->connect_error);

	// redirect to error page
	//header('Location: errorpage.php');
	//exit(); // ALWAYS explicitly call exit() after redirect
}


// set URI parameters
/*
// ternary replaces this IF..ELSE
if (empty($_GET['action'])) {
	$action = 'LIST';
} else {
	$action = strtoupper($_GET['action']);
}
*/

$action = empty($_GET['action']) ? 'LIST' : strtoupper($_GET['action']);


switch($action) {
	default:
	case 'LIST': // display event list in a table
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
					 '</tr>';
			}
			echo '</tbody></table>';
		}
	break; // LIST

	case 'ADD': // display event entry form

		// get location data
		$query = 'SELECT id, name FROM locations';
		$results = $db->query($query);
		if (!$results) {
			// query error. display feedback
			echo '<p>Unable to retrieve location data.</p>';
			break; // bail out of case 
		}
		$locations = [];
		while ($row = $results->fetch_assoc()) {
			$locations[$row['id']] = $row['name'];
		}
?>

		<form action="events.php?action=save" method="post">
			<label>
				<span>Event Name</span>
				<input name="name" />
			</label>
			<label>
				<span>Contact Name</span>
				<input name="contactname" />
			</label>
			<label>
				<span>Contact Phone</span>
				<input name="contactphone" />
			</label>
			<label>
				<span>Contact Email</span>
				<input name="contactemail" />
			</label>
			<fieldset>
				<legend>Event Start Date and Time</legend>
				<select name="startmonth">
					<option value="MM">MM</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				-
				<select name="startday">
					<option value="DD">DD</option>
					<?php
					for ($c = 1; $c < 32; $c++) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select>
				-
				<select name="startyear">
					<option value="YYYY">YYYY</option>
					<?php
					for ($c = 2025; $c > 1969; $c--) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select> 

				<select name="starthour">
					<option value="HH">HH</option>
					<?php
					for ($c = 0; $c < 24; $c++) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select>
				:
				<select name="startminute">
					<option value="MM">MM</option>
					<?php
					for ($c = 0; $c < 60; $c+=15) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select>
			</fieldset>
			<fieldset>
				<legend>Event End Date and Time</legend>
				<select name="endmonth">
					<option value="MM">MM</option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				-
				<select name="endday">
					<option value="DD">DD</option>
					<?php
					for ($c = 1; $c < 32; $c++) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select>
				-
				<select name="endyear">
					<option value="YYYY">YYYY</option>
					<?php
					for ($c = 2025; $c > 1969; $c--) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select> 

				<select name="endhour">
					<option value="HH">HH</option>
					<?php
					for ($c = 0; $c < 24; $c++) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select>
				:
				<select name="endminute">
					<option value="MM">MM</option>
					<?php
					for ($c = 0; $c < 60; $c+=15) {
						echo '<option value="'.$c.'">'.$c.'</option>';
					}
					?>
				</select>
			</fieldset>

			<label>
				<span>Max Attendees</span>
				<input name="maxattendees" />
			</label>

			<label>
				<span>Location</span>
				<select name="location">
					<?php
					foreach ($locations as $id => $name) {
						echo '<option value="'.$id.'">'.$name.'</option>';
					}
					?>
				</select>
			</label>
			<div>
				<input type="submit" value="Save" />
			</div>
		</form>

<?php
	break; // ADD

	case 'SAVE': // save posted form data
		// extract info
		$name = $_POST['name'];
		$contactname = $_POST['contactname'];
		$contactemail = $_POST['contactemail'];
		$contactphone = $_POST['contactphone'];
		$maxattendees = $_POST['maxattendees'];
		$locationID = $_POST['location'];

		// dates/times in MySQL are stored as YYYY-MM-DD HH:MM:SS
		$startdate = $_POST['startyear'].'-'.
					 $_POST['startmonth'].'-'.
					 $_POST['startday'].' '.
					 $_POST['starthour'].':'.
					 $_POST['startminute'].':00';

		$enddate =   $_POST['endyear'].'-'.
					 $_POST['endmonth'].'-'.
					 $_POST['endday'].' '.
					 $_POST['endhour'].':'.
					 $_POST['endminute'].':00';

		// validate and sanitize
		// save data
		$query = 'INSERT INTO events SET '.
		"name = '". $db->real_escape_string($name) ."', ".
		"contact_name = '". $db->real_escape_string($contactname) ."', ".
		"contact_email = '". $db->real_escape_string($contactemail) ."', ".
		"contact_phone = '". $db->real_escape_string($contactphone) ."', ".
		"max_attendees = '". $db->real_escape_string($maxattendees) ."', ".
		"location_id = '". $db->real_escape_string($locationID) ."', ".
		"start_datetime = '". $db->real_escape_string($startdate) ."', ".
		"end_datetime = '". $db->real_escape_string($enddate) ."' ";

		$result = $db->query($query);
		if (!$result) {
			// query error
			echo '<p>Query Error. Query:'.$query.'</p>';
			break;
		}

		// success!
		echo '<p>The record has been saved. Query:'.$query.'</p>';
	break; // SAVE
} // switch $action













