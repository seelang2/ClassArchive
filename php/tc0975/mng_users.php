<?php

$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) exit('Error connecting to database server.');

$dbh = @mysql_select_db('tc975');

if (!$dbh) exit('Error selecting database.');

$mode = 'LIST';

switch($mode)
{
	case 'LIST':
		
		$query = "SELECT id, firstname, lastname, email, type FROM users";
		
		$results = mysql_query($query);
		
		if (!$results) {
			// query error
			echo "<p>Error performing query: <br />Query: $query</p>";
		} else {
			// query ok, continue
			
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo '<p>No rows present.</p>';
			} else {
				
				echo '<table border="0" cellpadding="3" cellspacing="0">';
				echo '<tr>' .
					 	'<th>ID</th>' . 
					 	'<th>Name</th>' . 
					 	'<th>Email</th>' . 
					 	'<th>Type</th>' . 
					 '</tr>';
				
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
							'<td>' . $row['id'] . '</td>' .
							'<td>' . $row['lastname'] . ', ' . $row['firstname'] . '</td>' .
							'<td>' . $row['email'] . '</td>' .
							'<td>' . $row['type'] . '</td>' .
						 '</tr>';
				}
				
				echo '</table>';
				
				
			} // if num rows
		} // if results
		
		
	break; // list



} // switch

?>
