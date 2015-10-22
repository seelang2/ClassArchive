<?php
// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 10);

if (!$dbLink = @mysql_connect('localhost','root','xampp')) exit('Error');
if (!$dbH = @mysql_select_db('fakenames')) exit('Error');

$page = empty($_GET['page']) ? 1: $_GET['page'];
$range = empty($_GET['range']) ? 10: $_GET['range'];
$cols = empty($_GET['cols']) ? '': $_GET['cols'];
$order = empty($_GET['order']) ? '': $_GET['order'];

$offset = $range * ($page - 1);

$query  = "SELECT ";
if (empty($cols)) {
	$query .= "*";
} else {
	$query .= implode(',', explode('-',$_GET['cols']));
}

$query .= " FROM fakenames";

if (!empty($order)) {
	$query .= " ORDER BY " . $order;
}

$query .= " LIMIT $offset, $range";

$results = @mysql_query($query);

if (!$results || mysql_num_rows($results) < 1) {
	exit('Error: query error or no result set');
} else {
	$counter = 0;
	$output = array();
	$output['names'] = array();
	$output['columnNames'] = array();
	while($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
		if ($counter == 0) {
			// create column names array
			$tmp = array();
			foreach($row as $key => $value) {
				$tmp[] = $key;
			}
			$output['columnNames'] = $tmp;
		}
		$output['names'][] = $row;
		$counter++;
	}
	header('Content-Type','application/json');
	echo json_encode($output);
}

?>