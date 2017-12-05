<?php
/*
database.php - Database include file
*/


// Set up database functions
$dbcnx = @mysql_connect('localhost', 'tcchi101_dbuser', 'password');
if (!$dbcnx) {
  exit('<p>Unable to connect to the database server at this time.</p>');
}

if (!@mysql_select_db('tcchi101_test')) {
  exit('<p>Unable to locate the database at this time.</p>');
}

/*
Table Field Label Map - Maps field names to text labels
Note: Fields with values left blank are intentional and meant to NOT be displayed
*/

$table_field_labels = array(
	'user_info' => array(
		'id' => '',
		'firstname' => 'First Name',
		'lastname' => 'Last Name',
		'email' => 'Email Address',
		'password' => 'Password',
		'date_joined' => 'Date Joined'
	),
	'class_info' => array(
		'id' => 'Class ID',
		'class_name' => 'Class Name',
		'class_desc' => 'Description'
	),
	'class_recording' => array(
		'class_id' => 'Class ID',
		'desc' => 'Description',
		'rec_date' => 'Date',
		'rec_data' => ''
	),
	'users_to_clases' => array(
		'user_id' => '',
		'class_id' => '',
	)
);

?>