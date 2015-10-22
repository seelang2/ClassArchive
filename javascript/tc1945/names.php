<?php

if (!$dbcnx = @mysql_connect('localhost','root','xampp')) exit('Error: cannot connect to db');
if (!$dbh = @mysql_select_db('tc1945')) exit('Error: cannot select db');

if (!empty($_GET['name'])) $name = $_GET['name']; else exit('Error: name not specified');

$query = "SELECT firstname FROM names WHERE firstname LIKE '" . $name . "%' ORDER BY RAND() LIMIT 8";

$results = @mysql_query($query);

if (!$results || mysql_num_rows($results) < 1) {
	exit('Error: query error or no result set');
} else {
	$counter = 0;
	echo '[';
	while($row = mysql_fetch_array($results)) {
		if ($counter > 0) echo ',';
		echo '"'. $row['firstname'] .'"';
		$counter++;
	}
	echo ']';
}

?>