		<h2>Addresses for this contact</h2>
<?php

		$query = "SELECT a.id, address1, address2, city, state, zip, type " .
				 "FROM addresses AS a " .
				 "WHERE a.contact_id = '$id'";
		
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error, do something
			echo '<p>There was an error in the SQL query:' .
				 mysql_error() . '<br />Query: ' . $query . '</p>';
		
		} else {
			// query ok, proceed
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo '<p>No rows in table</p>';
				
			} else {
				// display rows
				
				echo '<table><tbody>' . 
					 '<tr>' . 
					 '<th>ID</th>' . 
					 '<th>Address1</th>' .
					 '<th>Address2</th>' .
					 '<th>City</th>' .
					 '<th>State</th>' .
					 '<th>Zip</th>' .
					 '<th>Type</th>' .
					 '<th>Options</th>' .
					 '</tr>';
					
				// loop through results and diplay row data
				while($row = mysql_fetch_array($results)) {
					
					echo '<tr>' .
						 '<td>' . $row['id'] . '</td>' .
						 '<td>' . $row['address1'] . '</td>' .
						 '<td>' . $row['address2'] . '</td>' .
						 '<td>' . $row['city'] . '</td>' .
						 '<td>' . $row['state'] . '</td>' .
						 '<td>' . $row['zip'] . '</td>' .
						 '<td>' . $address_types[$row['type']] . '</td>' .
						 '<td>' .
						 	'<a href="'. $_SERVER['PHP_SELF'] .'?mode=edit&id='. $row['id'] .'">Edit/View</a> | ' .
						 	'<a href="'. $_SERVER['PHP_SELF'] .'?mode=delete&id='. $row['id'] .'">Delete</a>' .
						 '</td>' .
						 '</tr>';
				
				} // while
				
				echo '</tbody></table>';
			
			}
		}// if results

?>
	<p><a href="add_address.php?contactid=<?php echo $id; ?>">Add new address to this contact</a></p>
	
	
	
	
	