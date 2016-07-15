<?php
/**
 * 
 * @description
 *
 */

require('init.php');

// echo '<pre>'.print_r($_POST,true).'</pre>';

// if there's no POST data then bail
if (empty($_POST)) exit('No data to save.');

// build query for contacts insert
$query = "INSERT INTO contacts SET ".
			"firstname = '". $_POST['firstname'] ."', " . 
			"lastname = '". $_POST['lastname'] ."', " . 
			"email = '". $_POST['email'] ."' "; 

// send query to db server
$result = $db->query($query);

// check result
if (!$result) {
	// error. display feedback
	echo '<p>There was an error: '. $db->errorInfo()[2] . 
		 '<br />Query: ' . $query . '</p>';

	exit(); // can't continue 
}

// retrieve last insert id from previous insert to get new contact id
$contactID = $db->lastInsertId();

// add rows for contact into link table
$query = 'INSERT INTO contacts_interests (`contact_id`,`interest_id`) VALUES ';

$c = 0;
// loop through $_POST['interests'] array and add rows
foreach($_POST['interests'] as $value) {
	// append to query
	$query .= $c > 0 ? ',' : ''; // ternary: cond ? trueVal : falseVal
	$query .= "(". $contactID .", ". $value .")";
	$c++;
} 

echo '<p>Query: '.$query.'</p>';

// send query to db server
$result = $db->query($query);

// check result
if (!$result) {
	// error. display feedback
	echo '<p>There was an error: '. $db->errorInfo()[2] . 
		 '<br />Query: ' . $query . '</p>';

	exit(); 
}

// successfully updated link table
echo '<p>The contact data has been saved.</p>';

