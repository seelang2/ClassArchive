<?php

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
	echo '<p>Query Error. Query:'.$query.'</p>';
	break;
}

// success!
echo '<p>The record has been saved. Query:'.$query.'</p>';
