<?php

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


