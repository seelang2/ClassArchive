<?php
// connect to database server and database
try {
	
	$db = new PDO('mysql:dbname=tc7235;host=localhost','root','xampp');
	
} catch (PDOException $err) {
	echo '<p>There was an error connecting to the database: ' .
		 $err->getMessage() . '</p>';
	exit(); // no point in going any further
}


echo "Parsing file {$argv[1]}:\n";

$file = file_get_contents($argv[1]);

// parse file into rows
$fileArray = explode("\n", $file);

// loop through rows, parse and build queries
foreach($fileArray as $index => $row) {
	$query = 'INSERT INTO contacts SET ';
	
	// parse row fields
	$fields = explode(',', $row);
	
	$query .= "firstname = '".$fields[0]."', ";
	$query .= "lastname = '".$fields[1]."', ";
	$query .= "email = '".$fields[2]."', ";
	$query .= "login = '".$fields[3]."', ";
	$query .= "password = '".$fields[4]."' ";
	
	//echo $query."\n";
	
	$result = $db->query($query);

	if ( !$result ) {
		echo "Record $index not saved.\n";
	} else {
		echo "Record $index saved.\n";
	}

}

