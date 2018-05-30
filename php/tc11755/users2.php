<?php

function dumpArray($srcArray) {
	echo '<pre>'.print_r($srcArray,true).'</pre>';
}

/*
	Options:
		name 					- name of select
		id 						- id of select
		optionValue 	- key used for option value attribute
		optionTitle 	- key used for option title
		option1Title 	- message for first option element
*/
function makeSelect($srcArray, $options) {
	$selectHTML = '<select';
	
	if (!empty($options['id'])) 
		$selectHTML .= ' id="'.$options['id'].'"';
	
	if (!empty($options['name'])) 
		$selectHTML .= ' name="'.$options['name'].'"';

	$selectHTML .= '>';

	if (!empty($options['option1Title'])) 
	$selectHTML .= '<option value="">'.$options['option1Title'].'</option>';

	// loop through and add options to the SELECT
	foreach($srcArray as $index => $row) {
		$selectHTML .= '<option value="'.$row[$options['optionValue']].'">'. $row[$options['optionTitle']] .'</option>';
	
		//$selectHTML .= "<option value='{$row[$options['optionValue']]}'>{$row[$options['optionTitle']]}</option>";
	}

	$selectHTML .= '</select>';
	return $selectHTML;
}

/*
	Options:
		query 			- (string) SQL query to run
		fetchAll 		- (bool) If true, use fetchAll instead of fetch
		callback 		- (function) Callback function to process rows during
									fetch
*/
function getResults(&$db, $options) {
	// merge default settings with passed options
	$options = array_merge(['fetchAll' => false], $options);

	// if there's no query we bail
	if (empty($options['query'])) return false;

	// send query to server
	$results = $db->query($options['query']);
	// check query
	if (!$results) return false;

	if ($options['fetchAll']) {
		// get entire result set as array
		return $results->fetchAll(PDO::FETCH_ASSOC);
	}

	// if there's no callback function throw an error
	if (empty($options['callback'])) {
		throw new Exception('No callback function passed');
	}

	// set up while loop using fetch and use callback
	while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
		// execute the callback and pass the row data
		$options['callback']($row);
	}

}





// connect to database server
// select database

try {
	$db = new PDO('mysql:dbname=tc11755;host=localhost', 'root', '');
} catch(PDOException $error) {
	echo '<p>Database error. No soup for you! *snap*</p>';
}

// get department data
$options = [
	'query' 		=> 'SELECT departmentid, name FROM departments',
	'fetchAll' 	=> true
];

$data = getResults($db, $options);

//dumpArray($data);

$options = [
	'name' 					=> 'department_id',
	'optionValue' 	=> 'departmentid',
	'optionTitle' 	=> 'name',
	'option1Title' 	=> 'Please select a department'
];

$departmentSelect = makeSelect($data, $options);

/*
// get location data
$options = [
	'query' 		=> 'SELECT locationid, locationname FROM locations',
	'callback' 	=> function($row) {
		echo '<p>ID: '.$row['locationid'].', Name: '.$row['locationname'].'</p>';
	}
];

getResults($db, $options);
*/

// get location data 
$options = [
	'query' 		=> 'SELECT locationid, locationname FROM locations',
	'fetchAll' 	=> true
];

$data = getResults($db, $options);

// make select for locations
$options = [
	'name' 					=> 'location_id',
	'optionValue' 	=> 'locationid',
	'optionTitle' 	=> 'locationname',
	'option1Title' 	=> 'Please select a location'
];

$locationSelect = makeSelect($data, $options);


