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

// connect to database server
// select database

try {
	$db = new PDO('mysql:dbname=tc11755;host=localhost', 'root', '');
} catch(PDOException $error) {
	echo '<p>Database error. No soup for you! *snap*</p>';
}

// get department data
// build query
$query = 'SELECT departmentid, name FROM departments';
// send query to server
$results = $db->query($query);
// check query
if (!$results) {
	// query error
	echo '<p>Query error. No soup for you! *snap* <br />' .
				$query . '</p>';
} else {
	// get entire result set as array
	$data = $results->fetchAll(PDO::FETCH_ASSOC);
}


dumpArray($data);

$options = [
	'name' 					=> 'department_id',
	'optionValue' 	=> 'departmentid',
	'optionTitle' 	=> 'name',
	'option1Title' 	=> 'Please select a department'
];

echo makeSelect($data, $options);


