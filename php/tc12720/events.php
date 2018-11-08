<?php
require('init.php');


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
$id = empty($_GET['id']) ? null : $db->real_escape_string($_GET['id']);


switch($action) {
	default:
	case 'LIST': // display event list in a table
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
		include('header.php');

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

		?>
		<div>
			<p><a href="output/data.csv">Download Event list as CSV</a></p>
		</div>
		<?php

		include('footer.php');
	break; // LIST

	case 'EDIT':
		if (empty($id)) break; // nothing to see here
		// look up record
		$query = 'SELECT name, start_datetime, end_datetime, contact_name, contact_phone, contact_email, max_attendees, location_id FROM events WHERE id = '.$id;

		$result = $db->query($query);
		
		if (!$result) {
			// query error
			echo '<p>Query error. No soup for you! *snap* <br />'.$db->error.'</p>';
			break; // bail out of case
		}

		if ($result->num_rows != 1) {
			echo '<p>Record not found.</p>';
			break;
		}

		$data = $result->fetch_assoc();

		// break down date vars
		$startDT = parseDateTime($data['start_datetime']);
		$endDT = parseDateTime($data['end_datetime']);

		echo '<pre>'.print_r($startDT,true).'</pre>';
		echo '<pre>'.print_r($endDT,true).'</pre>';


	// break statement intentionally omitted

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

		include('header.php');

?>

		<form action="events.php?action=save<?php echo empty($id)? '':'&id='.$id; ?>" method="post">
			<label>
				<span>Event Name</span>
				<input name="name" 
					value="<?php echo empty($data) ? '': $data['name']; ?>" />
			</label>
			<label>
				<span>Contact Name</span>
				<input name="contactname" 
					value="<?php echo empty($data) ? '': $data['contact_name']; ?>" />
			</label>
			<label>
				<span>Contact Phone</span>
				<input name="contactphone" 
					value="<?php echo empty($data) ? '': $data['contact_phone']; ?>" />
			</label>
			<label>
				<span>Contact Email</span>
				<input name="contactemail" 
					value="<?php echo empty($data) ? '': $data['contact_email']; ?>" />
			</label>
			<fieldset>
				<legend>Event Start Date and Time</legend>
				<select name="startmonth">
					<option value="MM">MM</option>
					<option value="01"<?php echo $startDT['m'] == '01' ? 'selected' : ''; ?>>01</option>
					<option value="02"<?php echo $startDT['m'] == '02' ? 'selected' : ''; ?>>02</option>
					<option value="03"<?php echo $startDT['m'] == '03' ? 'selected' : ''; ?>>03</option>
					<option value="04"<?php echo $startDT['m'] == '04' ? 'selected' : ''; ?>>04</option>
					<option value="05"<?php echo $startDT['m'] == '05' ? 'selected' : ''; ?>>05</option>
					<option value="06"<?php echo $startDT['m'] == '06' ? 'selected' : ''; ?>>06</option>
					<option value="07"<?php echo $startDT['m'] == '07' ? 'selected' : ''; ?>>07</option>
					<option value="08"<?php echo $startDT['m'] == '08' ? 'selected' : ''; ?>>08</option>
					<option value="09"<?php echo $startDT['m'] == '09' ? 'selected' : ''; ?>>09</option>
					<option value="10"<?php echo $startDT['m'] == '10' ? 'selected' : ''; ?>>10</option>
					<option value="11"<?php echo $startDT['m'] == '11' ? 'selected' : ''; ?>>11</option>
					<option value="12"<?php echo $startDT['m'] == '12' ? 'selected' : ''; ?>>12</option>
				</select>
				-
				<select name="startday">
					<option value="DD">DD</option>
					<?php
					for ($c = 1; $c < 32; $c++) {
						echo '<option value="'.$c.'" ';
						if ($c == $startDT['d']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select>
				-
				<select name="startyear">
					<option value="YYYY">YYYY</option>
					<?php
					for ($c = 2025; $c > 1969; $c--) {
						echo '<option value="'.$c.'" ';
						if ($c == $startDT['Y']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select> 

				<select name="starthour">
					<option value="HH">HH</option>
					<?php
					for ($c = 0; $c < 24; $c++) {
						echo '<option value="'.$c.'" ';
						if ($c == $startDT['H']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select>
				:
				<select name="startminute">
					<option value="MM">MM</option>
					<?php
					for ($c = 0; $c < 60; $c+=15) {
						echo '<option value="'.$c.'" ';
						if ($c == $startDT['i']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select>
			</fieldset>
			<fieldset>
				<legend>Event End Date and Time</legend>
				<select name="endmonth">
					<option value="MM">MM</option>
					<option value="01"<?php echo $endDT['m'] == '01' ? 'selected' : ''; ?>>01</option>
					<option value="02"<?php echo $endDT['m'] == '02' ? 'selected' : ''; ?>>02</option>
					<option value="03"<?php echo $endDT['m'] == '03' ? 'selected' : ''; ?>>03</option>
					<option value="04"<?php echo $endDT['m'] == '04' ? 'selected' : ''; ?>>04</option>
					<option value="05"<?php echo $endDT['m'] == '05' ? 'selected' : ''; ?>>05</option>
					<option value="06"<?php echo $endDT['m'] == '06' ? 'selected' : ''; ?>>06</option>
					<option value="07"<?php echo $endDT['m'] == '07' ? 'selected' : ''; ?>>07</option>
					<option value="08"<?php echo $endDT['m'] == '08' ? 'selected' : ''; ?>>08</option>
					<option value="09"<?php echo $endDT['m'] == '09' ? 'selected' : ''; ?>>09</option>
					<option value="10"<?php echo $endDT['m'] == '10' ? 'selected' : ''; ?>>10</option>
					<option value="11"<?php echo $endDT['m'] == '11' ? 'selected' : ''; ?>>11</option>
					<option value="12"<?php echo $endDT['m'] == '12' ? 'selected' : ''; ?>>12</option>
				</select>
				-
				<select name="endday">
					<option value="DD">DD</option>
					<?php
					for ($c = 1; $c < 32; $c++) {
						echo '<option value="'.$c.'" ';
						if ($c == $endDT['d']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select>
				-
				<select name="endyear">
					<option value="YYYY">YYYY</option>
					<?php
					for ($c = 2025; $c > 1969; $c--) {
						echo '<option value="'.$c.'" ';
						if ($c == $endDT['Y']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select> 

				<select name="endhour">
					<option value="HH">HH</option>
					<?php
					for ($c = 0; $c < 24; $c++) {
						echo '<option value="'.$c.'" ';
						if ($c == $endDT['H']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select>
				:
				<select name="endminute">
					<option value="MM">MM</option>
					<?php
					for ($c = 0; $c < 60; $c+=15) {
						echo '<option value="'.$c.'" ';
						if ($c == $endDT['i']) echo 'selected';
						echo '>'.$c.'</option>';
					}
					?>
				</select>
			</fieldset>

			<label>
				<span>Max Attendees</span>
				<input name="maxattendees" 
					value="<?php echo empty($data) ? '': $data['max_attendees']; ?>" />
			</label>

			<label>
				<span>Location</span>
				<select name="location">
					<?php
					foreach ($locations as $id => $name) {
						echo '<option value="'.$id.'" ';
						if ($id == $data['location_id']) echo 'selected';
						echo ' >'.$name.'</option>';
					}
					?>
				</select>
			</label>
			<div>
				<input type="submit" class="button" value="Save" />
			</div>
		</form>

<?php
		include('footer.php');


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
		if (empty($id)) {
			$query = 'INSERT INTO ';
		} else {
			$query = 'UPDATE ';
		}

		$query .= ' events SET '.
		"name = '". $db->real_escape_string($name) ."', ".
		"contact_name = '". $db->real_escape_string($contactname) ."', ".
		"contact_email = '". $db->real_escape_string($contactemail) ."', ".
		"contact_phone = '". $db->real_escape_string($contactphone) ."', ".
		"max_attendees = '". $db->real_escape_string($maxattendees) ."', ".
		"location_id = '". $db->real_escape_string($locationID) ."', ".
		"start_datetime = '". $db->real_escape_string($startdate) ."', ".
		"end_datetime = '". $db->real_escape_string($enddate) ."' ";

		if (!empty($id)) $query .= ' WHERE id = '. $id;

		$result = $db->query($query);
		if (!$result) {
			// query error
			$_SESSION['flashmessage'] = '<p>Query Error. Query:'.$query.'</p>';
			// redirect to error page
			header('Location: errorpage.php');
			exit(); // ALWAYS explicitly call exit() after redirect
			break;
		}

		// success!
		$_SESSION['flashmessage'] = '<p>The record has been saved. Query:'.$query.'</p>';
		// redirect to list view
		header('Location: events.php?action=list');
		exit(); // ALWAYS explicitly call exit() after redirect


	break; // SAVE
} // switch $action













