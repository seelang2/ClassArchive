<?php

if (!$dbcnx = @mysql_connect('localhost','root','xampp')) exit('Error: cannot connect to db');
if (!$dbh = @mysql_select_db('names')) exit('Error: cannot select db');

if (!empty($_GET['name'])) $name = $_GET['name']; else exit('Error: name not specified');

$query = "SELECT firstname FROM names WHERE firstname LIKE '" . $name . "%' ORDER BY RAND() LIMIT 8";

$results = @mysql_query($query);

if (!$results) {
	exit('Error: query error or no result set');
} else {
	header("Content-Type: application/json");
	$counter = 0;
	echo '[';
	while($row = mysql_fetch_array($results)) {
		echo ($counter > 0 ? ',': '') . '"'.$row['firstname'].'"';
		$counter++;
	}
	echo ']';
}

?>