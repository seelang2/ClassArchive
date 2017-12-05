<?php

require('database.php');

$filename = 'contacts.txt';

// read source file into string
$filedata = file_get_contents($filename);

//echo $filedata;

// parse into array of rows
$fileArray = explode("\n", $filedata);

//echo '<pre>'.print_r($fileArray, true).'</pre>';

// build query
$query = "INSERT INTO contacts (`firstname`, `lastname`, `email`) VALUES \n";

$r = 0;

// loop through array
foreach ($fileArray as $index => $row) {
	// trim off possible carriage return at end of line
	$row = str_replace("\r", '', $row);

	// parse row into columns
	$fieldArray = explode("\t", $row);

	//echo '<pre>'.print_r($fieldArray, true).'</pre>';
	if ($r++ > 0) $query .= ',' . "\n";
	
	$query .= "(";
	
	$c = 0; 
	
	// loop through columns
	foreach ($fieldArray as $colData) {
		// append query
		if ($c++ > 0) $query .= ',';
		
		$query .= $dbh->quote($colData);
	}
	
	$query .= ")";
	
} // foreach

echo $query;

// send query to server
$result = $dbh->exec($query);

// check server result
if ($result == 0) {
	// no rows affected - some kind of error
	echo '<p>Records were NOT imported.<br />'.$query.'</p>';
} else {
	// success
	echo '<p>The records were imported successfully.</p>';
}



