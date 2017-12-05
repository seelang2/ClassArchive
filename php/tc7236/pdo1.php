<?php

// connect to DB server
try {
	$dbh = new PDO('mysql:dbname=tc7236;host=localhost','root','xampp');
} catch (PDOException $e) {
	// don't leave this blank - always handle the error somehow
	
	exit('<p>Error:</p> There was an error: '.$e->getMessage()); // terminate script
	
}

if (empty($_GET['action'])) {
	$action = 'LIST'; // set default action
} else {
	$action = strtoupper($_GET['action']);
}

switch($action) {
	default:
	
	case 'LIST': // retrieve contacts and display as table (list)
		
		// build query
		$query = 'SELECT id, firstname, lastname, email FROM contacts';
		
		// send query to server
		$results = $dbh->query($query);
		
		// check server result
		if ($results === false) {
			// query error
			echo '<p>Query error. No soup for you! *snap*</p>';
			echo '<p>Error info: ' . $dbh->errorinfo()[2] . '</p>';
			
			break; // terminate case
		}
		
		// process results if applicable
		
		$rowHTML = '';
		$rowCount = 0;
		// loop through results
		while($row = $results->fetch(PDO::FETCH_ASSOC)) {
			$rowCount++;
			
			$rowHTML .= '<tr>' .
							'<td>' . $row['id'] . '</td>' .
							'<td>' . $row['firstname'] . '</td>' .
							'<td>' . $row['lastname'] . '</td>' .
							'<td>' . $row['email'] . '</td>' .
						'</tr>';
		} // while
		
		if ($rowCount > 0) {
			// build table
			echo '<table><tbody>' . $rowHTML . '</tbody></table>';
			
		} else {
			// no rows round
			echo '<p>No data in table.</p>';
		}
		
		
		
	break; // LIST
	
	case 'ADD': // display contact form
?>

		<form action="pdo1.php?action=process" method="post">
			<div>
				<label>First Name: <input name="firstname" /></label>
			</div>

			<div>
				<label>Last Name: <input name="lastname" /></label>
			</div>

			<div>
				<label>Email: <input name="email" /></label>
			</div>

			<div><input type="submit" /></div>
		</form>


<?php
	break; // ADD
	
	case 'PROCESS': // process form data
		if (empty($_POST)) {
			echo '<p>No form data present to save.</p>';
			break;
		}
		
		//echo '<p>Processing form, please wait...</p>';
		
		// build query
		$query = 'INSERT INTO contacts SET ' .
					"firstname = '{$_POST['firstname']}', " . 
					"lastname = '{$_POST['lastname']}', " . 
					"email = '{$_POST['email']}' "; 
		
		// send query to server
		$result = $dbh->exec($query);
		
		// check server result
		if ($result == 0) {
			// no rows affected - some kind of error
			echo '<p>Record was NOT saved.</p>';
			break;
		}
		
		// success
		echo '<p>The record was saved successfully.</p>';
	
	break; // PROCESS
	
} // switch $action
