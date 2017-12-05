<?php
/*
	connect to database and return result set
	enclose data inside a wrapper to include request metadata
*/

header('Content-Type: application/json');

$db = new PDO('mysql:dbname=names;host=localhost','root','xampp');

$range = empty($_GET['range']) ? 10 : $_GET['range'];
$offset = empty($_GET['offset']) ? 0 : $_GET['offset'];

// get record count for this query
$result = $db->query("SELECT count(id) AS rowcount FROM names");
$rowCount = $result->fetchColumn();

// create wrapper with metadata
echo '{';
echo '"rowcount":'. $rowCount .','; // addrowcount


echo '"data":['; // opening array bracket
$results = $db->query("SELECT * FROM names LIMIT $offset, $range");
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

echo '}'; // wrapper object

?>