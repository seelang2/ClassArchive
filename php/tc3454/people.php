<?php

// connect to database server
$dbLink = @mysql_connect('localhost','root','xampp');
if (!$dbLink) exit('Error connecting to database server.');

// select database
$db = @mysql_select_db('tc3454');
if (!$db) exit('Error selecting database.');

if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

switch($action) {
	case 'PROCESSFORM':
		
		// data validation
		$validated = true;
		$errormessages = '';
		
		// value cannot be blank
		if (empty($_POST['name'])) {
			$validated = false; // rule is triggered, invalidate form data
			$errormessages .= '<br />The name field cannot be blank.';
		}
		
		// name has to be at least 4 characters
		if (strlen($_POST['name']) < 4) {
			$validated = false; // rule is triggered, invalidate form data
			$errormessages .= '<br />The name field must be at least 4 characters.';
		}
		
		// password has to be between 6 and 15 chars
		if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 15) {
			$validated = false; // rule is triggered, invalidate form data
			$errormessages .= '<br />Password must be between 6 and 15 characters.';
		}
		
		// check for valid email using regular expression
		if (!preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i', $_POST['email'])) {
			$validated = false; // rule is triggered, invalidate form data
			$errormessages .= '<br />Email appears to be invalid.';
		}
		
		// check if data is still valid
		if (!$validated) {
			// FAIL
			echo '<p>The following errors have been found:<br />' .
				 $errormessages . 
				 '<br />Please go back and correct these fields.</p>';
			break; // terminate case
		}
		
		// get form values from POST and sanitize
		// ALWAYS SANITIZE USER DATA BEFORE USING IN A SQL QUERY
		$name = mysql_escape_string($_POST['name']);
		$email = mysql_escape_string($_POST['email']);
		$phone = mysql_escape_string($_POST['phone']);
		$password = mysql_escape_string($_POST['password']);
		$type = mysql_escape_string($_POST['type']);
		
		// build query
		$query = "INSERT INTO people SET " .
				 "name = '$name', " .
				 "email = '$email', " .
				 "phone = '$phone', " .
				 "password = '$password', " .
				 "type = '$type' ";
		
		// semd query to server
		$result = @mysql_query($query);
		// check result
		if (!$result) {
			// query error
			echo '<p>Query error. No soup for you! *snap*</p>';
		} else {
			// success message
			echo '<p>The record was saved successfully.</p>';
		} // if result
		
	break; // PROCESSFORM
	
	case 'DISPLAYFORM': // displays data entry form
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=processform" method="post">
		<div><label>Name: <input name="name" /></label></div>
		<div><label>Email: <input name="email" /></label></div>
		<div><label>Phone: <input name="phone" /></label></div>
		<div><label>Password: <input name="password" /></label></div>
		<div><label>Type: 
        		<select name="type">
                	<option value="0">Attendee</option>
                	<option value="1">Speaker</option>
                	<option value="2">Admin</option>
                </select>
             </label></div>
		<div><input type="submit" value="Save" /></div>
	</form>
    <?php
	break; // DISPLAYFORM
	
	default:
	case 'LIST':
		
		// build query
		$query = "SELECT id, type, name, phone, email FROM people";
		// send query to server
		$results = @mysql_query($query);
		// check result
		if (!$results) {
			// query error 
			echo '<p>There was a problem with the query. <br />' . $query . '</p>';
			break; // terminate case 
		}
		// process results (if any)
		if (mysql_num_rows($results) == 0) {
			// no data in table
			echo '<p>No rows in table.</p>';
		} else {
			// display results in html table
			
			echo '<table><tbody>';
			
			// loop through rows in resultset
			while ($row = mysql_fetch_array($results)) {
				echo '<tr>' .
						'<td>'.$row['id'].'</td>' . 
						'<td>'.$row['name'].'</td>' . 
						'<td>'.$row['type'].'</td>' . 
						'<td>'.$row['phone'].'</td>' . 
						"<td>{$row['email']}</td>" . 
					 '</tr>';
				
			} // while
			
			echo '</tbody></table>';
		}
	break;
} // switch




?>