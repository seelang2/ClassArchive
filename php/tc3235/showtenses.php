<?php

// connect to db server
$dbLink = @mysql_connect('localhost', 'root', 'xampp'); // use '@' to suppress direct output by a function
if (!$dbLink) exit('Error connecting to database server.');

// select database
$dbH = @mysql_select_db('lingprof');
if (!$dbH) exit('Error selecting database.');

// build query
$query = 'SELECT id, description FROM participles';

// send the query to server
$results = @mysql_query($query);

// check query result
if (!$results) {
	// query error
	echo '<p>Query error: <br />' . mysql_error() . '<br />Original query: ' . $query . '</p>';
} else {
	// query success, continue
	// process results if any
	// check if there are rows returned
	if (mysql_num_rows($results) == 0) {
		// no rows returned
		echo '<p>No records in table.</p>';
	} else {
		echo '<table><thead><tr>'.
				'<th>ID</th>' .
				'<th>Description</th>' .
			 '</tr></thead><tbody>';
		// loop through result set and process
		while ($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['description'] . '</td>' .
				 '</tr>';
		} // while
		echo '</tbody></table>';
	} // if num rows
} // if $results

?>
