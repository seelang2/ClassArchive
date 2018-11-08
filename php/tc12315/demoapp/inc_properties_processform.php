<?php
/**
 * inc_properties_processform.php - Process form data
 */

// check if there's any data to process
if (empty($_POST)) return; // terminate if no data is present

// extract data from form
$address_id = $_POST['address_id'];
$name = $_POST['name'];
$address_1 = $_POST['address_1'];
$address_2 = $_POST['address_2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

// validate data
$dataIsValid = true; // start off assuming the data is valid
$errorMessages = []; // empty array of error messages

// look for exceptions invalidating data

// example: field can't be blank
if (empty($name)) {
	$dataIsValid = false; // invalidate data
	array_push($errorMessages, 'Name cannot be blank.');
}

if (empty($address_1)) {
	$dataIsValid = false; // invalidate data
	array_push($errorMessages, 'Address cannot be blank.');
}

if (empty($city)) {
	$dataIsValid = false; // invalidate data
	array_push($errorMessages, 'City cannot be blank.');
}

if (strlen($state) != 2) {
	$dataIsValid = false; // invalidate data
	array_push($errorMessages, 'State must be 2 characters.');
}

if (strlen($zip) < 5) {
	$dataIsValid = false; // invalidate data
	array_push($errorMessages, 'Zip must be at least 5 characters.');
}

// check if form is valid
if (!$dataIsValid) {
	// form is invalid
	echo '<p>The following errors were found:<br />' .
		 implode('<br />', $errorMessages) . 
		 '<br />Please go back and try again.</p>';
	return;
}

// DON'T FORGET TO ALWAYS SANITIZE THE DATA!

// save property record
if (empty($id)) {
	$query = "INSERT INTO ";
} else {
	$query = "UPDATE ";
}

$query .= "properties SET name = " . $db->quote($name);

if (!empty($id)) $query .= ' WHERE id = ' . $db->quote($id);

$result = $db->query($query);
// check to see if query was successful
if (!$result) {
	// query error. display user feedback
	echo '<p>Query error. No soup for you *snap*</p>';
	return; // terminate case
}

// If adding new record, retrieve saved record id otherwise use existing id
// use ternary for brevity
$property_id = empty($id) ? $db->lastInsertId() : $id;

if (empty($id)) {
	$query = "INSERT INTO ";
} else {
	$query = "UPDATE ";
}

// save address record
$query .= "addresses SET " .
			"address_1 = " . $db->quote($address_1) . "," .
			"address_2 = " . $db->quote($address_2) . "," .
			"city = " . $db->quote($city) . "," .
			"state = " . $db->quote($state) . "," .
			"zip = " . $db->quote($zip);

if (empty($id)) {
	$query .= "," .
			"owner_id = " . $db->quote($property_id) . "," .
			"type = 1";
} else {
	$query .= ' WHERE id = ' . $db->quote($address_id);
}

$result = $db->query($query);
// check to see if query was successful
if (!$result) {
	// query error. display user feedback
	echo '<p>Query error. No soup for you *snap*</p>';
	return; // terminate case
}

// operation successful. Display feedback.
echo '<p>The record was successfully saved.</p>';

