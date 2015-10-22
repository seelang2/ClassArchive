<?php

// connect to db server
$dbLink = @mysql_connect('localhost','root','xampp');
if (!$dbLink) exit('Error connecting to database server.');

// select database
$db = @mysql_select_db('tc3025');
if (!$db) exit('Error selecting database.');

// get action parameter from query string
if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']); } else { $action = 'LIST'; }

switch($action)
{
	
	case 'LIST': // display records in table
		
		// get results from database
		// build query
		$query = "SELECT id, name, pn, quantity FROM widgets";
		// send query to server
		$results = @mysql_query($query);
		// check results
		if (!$results) {
			// query error
			echo '<p>Query error. No soup for you! *snap*</p>';
			break; // terminate case - nothing more to see here
		}
		// process results
		// are there any rows in the result set?
		if (mysql_num_rows($results) == 0) {
			// empty result set
			echo '<p>No rows in table.</p>';
			break;
		}
		// loop through results and display inside table
		
		echo '<table><tbody>' .
			 '<tr>' .
			 	'<th>ID</th>' .
			 	'<th>Name</th>' .
			 	'<th>Part #</th>' .
			 	'<th>Quantity</th>' .
			 '</tr>';
		while($row = mysql_fetch_array($results)) {
			echo '<tr>' .
				 	'<td>' . $row['id'] . '</td>' .
				 	'<td>' . $row['name'] . '</td>' .
				 	'<td>' . $row['pn'] . '</td>' .
				 	'<td>' . $row['quantity'] . '</td>' .
				 '</tr>';
			
		} // while results
		
		echo '</tbody></table>';
		
	break; // LIST
	
	case 'ADD':
		
		// display blank form
		?>
		<form action="widget.php?action=processform" method="post">
        	<div>
              <label for="name">Name:</label>
              <input id="name" name="name" value="" />
            </div>
        	<div>
              <label for="description">Description:</label>
              <input id="description" name="description" value="" />
            </div>
        	<div>
              <label for="pn">Part #:</label>
              <input id="pn" name="pn" value="" />
            </div>
        	<div>
              <label for="quantity">Quantity:</label>
              <input id="quantity" name="quantity" value="" />
            </div>
        	<div>
              <label for="cost">Cost:</label>
              <input id="cost" name="cost" value="" />
            </div>
        	<div>
              <label for="location">Location:</label>
              <input id="location" name="location" value="" />
            </div>
        	<div>
              <input type="submit" value="Update Database" />
            </div>
        </form>
		<?php
	break; // ADD
	
	case 'PROCESSFORM':
		// retrieve form data and sanitize
		$name = mysql_escape_string($_POST['name']);
		$description = mysql_escape_string($_POST['description']);
		$pn = mysql_escape_string($_POST['pn']);
		$quantity = mysql_escape_string($_POST['quantity']);
		$cost = mysql_escape_string($_POST['cost']);
		$location = mysql_escape_string($_POST['location']);
		
		// build query
		$query = "INSERT INTO widgets SET " .
					 "name = '$name', " .
					 "description = '$description', " .
					 "pn = '$pn', " .
					 "quantity = '$quantity', " .
					 "cost = '$cost', " .
					 "location = '$location' ";
		
		// send query to server
		$result = @mysql_query($query);
		// check result
		if (!$result) {
			// query error
			echo '<p>Query error. No soup for you! *snap*<br />'.$query.'</p>';
			break; // terminate case - nothing more to see here
		}
		// must've worked
		echo '<p>The database has been updated.<br />'.$query.'</p>';
		
	break; // PROCESSFORM
	
} // switch








?>