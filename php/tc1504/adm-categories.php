<?php

$dbcnx = @mysql_connect('localhost', 'root', 'xampp');

if (!$dbcnx) exit ('Error connecting to database server.');

$dbh = @mysql_select_db('tc1504');

if (!$dbh) exit ('Error selecting database.');


if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']); else $mode = 'LIST';

switch($mode)
{
	case 'LIST':
		$query = 'SELECT id, name FROM categories';
		
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error
			echo '<p>There was an error with the query:<br />' . mysql_error() . '<br />' .
				 'Query contents: ' . $query . '</p>';
		} else {
			// query ok
			if (mysql_num_rows($results) == 0) {
				// no rows in result set
				echo '<p>No rows present.</p>';
			} else {
				// process result set
				echo '<table border="0" cellspacing="0">';
				echo '<tr>' .
					 '<th>ID</th>' .
					 '<th>Name</th>' .
					 '</tr>';
				
				// loop through result set
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						 '<td>' . $row['id'] . '</td>' .
						 '<td>' . $row['name'] . '</td>' .
						 '</tr>';
				} // while
				
				echo '</table>';
			} // if num rows
			
		} // if results
	
	break; // list
	
	
} // switch mode



?>