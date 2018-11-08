<?php
/**
 * Process Event registration page (add attendee to event)
 */

require('init.php');

// extract, validate, and sanitize data

// extract info
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$event_id = $db->real_escape_string($_POST['event_id']);

// add new attendee record
$query = 'INSERT INTO attendees SET '.
"firstname = '". $db->real_escape_string($firstname) ."', ".
"lastname = '". $db->real_escape_string($lastname) ."', ".
"email = '". $db->real_escape_string($email) ."', ".
"phone = '". $db->real_escape_string($phone) ."', ".
"address_line1 = '". $db->real_escape_string($address1) ."', ".
"address_line2 = '". $db->real_escape_string($address2) ."', ".
"city = '". $db->real_escape_string($city) ."', ".
"state = '". $db->real_escape_string($state) ."', ".
"zip = '". $db->real_escape_string($zip) ."' ";

$result = $db->query($query);
if (!$result) {
	// query error
	//exit('<p>Query Error. <br />Query: '.$query.'<br />Error: '.$db->error.'</p>');

	// redirect to error page
	header('Location: errorpage.php');
	exit(); // ALWAYS explicitly call exit() after redirect
}

// get id of the new attendee record
$attendee_id = $db->insert_id;

// now add link table record to add attendee to event
$query = 'INSERT INTO attendees_events SET attendee_id = '.$attendee_id.', event_id = '.$event_id;

$result = $db->query($query);
if (!$result) {
	// query error
	//exit('<p>Query Error. <br />Query: '.$query.'<br />Error: '.$db->error.'</p>');

	// rollback previous operations
	// delete attendee record

	// redirect to error page
	header('Location: errorpage.php');
	exit(); // ALWAYS explicitly call exit() after redirect
}

// success!
	// redirect to success page
	header('Location: eventthankyou.php');
	exit(); // ALWAYS explicitly call exit() after redirect


