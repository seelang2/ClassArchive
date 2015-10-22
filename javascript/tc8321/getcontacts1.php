<?php
/*
	connect to database and return result set

*/

$range = empty($_GET['range']) ? 10 : $_GET['range'];
$offset = empty($_GET['offset']) ? 0 : $_GET['offset'];

$db = new PDO('mysql:dbname=names;host=localhost','root','xampp');
$results = $db->query("SELECT * FROM names LIMIT $offset, $range");

header('Content-Type: application/json');

// it would be great if we could just use json_encode with fetchAll,
// but we would get horrible performance with really large result sets
// (and probably blow the PHP memory allocation in the process).

//echo json_encode($results->fetchAll(PDO::FETCH_ASSOC));

// instead we 'stream' the output row by row and manually create the
// JSON structure

echo '['; // opening array bracket
$r = 0;
while($row = $results->fetch(PDO::FETCH_ASSOC)) {
	if ($r++ > 0) echo ',';
	echo '{';
	
	$c = 0;
	foreach($row as $key => $value) {
		if ($c++ > 0) echo ',';
		echo '"'.$key.'"'.':'.'"'.$value.'"';
	}
	
	echo '}';
}
echo ']'; // closing array bracket

?>