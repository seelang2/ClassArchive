<?php
/*
	connect to database and return result set
	enclose data inside a wrapper to include request metadata
	modified to work with DataTables jQuery plugin
	
	refs:
	http://www.json.org/
	http://datatables.net/manual/server-side
	http://datatables.net/examples/server_side/simple.html
*/

header('Content-Type: application/json');

$db = new PDO('mysql:dbname=names;host=localhost','root','xampp');

$range = empty($_GET['length']) ? 10 : $_GET['length'];
$offset = empty($_GET['start']) ? 0 : $_GET['start'];
$search = empty($_GET['search']) ? array() : $_GET['search'];


// build query predicate
$query = 'FROM names ';

// add search phrase
if (!empty($search['value'])) {
	$query .= 'WHERE ' .
		"firstname LIKE '".$search['value']."%'" .
		" OR lastname LIKE '".$search['value']."%'" .
		" OR code LIKE '".$search['value']."%' ";
}

// add ordering clause(s)
if (!empty($_GET['order'])) {
	$query .= ' ORDER BY ';
	$c = 0;
	// loop through order array to build clauses
	foreach ($_GET['order'] as $index => $order) {
		if ($c++ > 0) $query .= ',';
		$query .= $_GET['columns'][$order['column']]['data'].' '. $order['dir'].' '; 
	}

}

$query .= "LIMIT $offset, $range"; // add limit clause

// get record count for this query
$result = $db->query("SELECT count(id) AS rowcount ".$query);
if ($result === false) {
	exit('Query error: '."SELECT count(id) AS rowcount ".$query);
}

$rowCount = $result->fetchColumn();

// create wrapper with metadata
echo '{';
echo '"draw":'. (int)$_GET['draw'] .','; // pass draw through

echo '"recordsTotal":'. $rowCount .','; // addrowcount
echo '"recordsFiltered":'. $rowCount .','; // addrowcount


echo '"data":['; // opening array bracket
$results = $db->query("SELECT * ".$query);
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