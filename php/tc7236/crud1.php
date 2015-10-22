<?php

require('init.php');

//if (!empty($_GET['id'])) $id = $dbh->quote($_GET['id']); else unset($id);
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);


include('header.php');


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
							'<td>' .
								makePostButton(array(
									'URI' => $self . '?action=edit&id=' . $row['id'], 
									'label' => 'Edit'
								)) .
								makePostButton(array(
									'URI' => $self . '?action=delete&id=' . $row['id'], 
									'label' => 'Delete'
								)) .
							'</td>' .
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
	
	case 'EDIT': // lookup and edit contact
		if (empty($id)) {
			echo '<p>No record specified to edit.</p>'; // no soup for you! *snap*
			break;
		}
		
		// retrieve record
		
		// build query
		$query = "SELECT firstname, lastname, email FROM contacts WHERE id = {$id}";
		
		// send query to server
		$result = $dbh->query($query);
		
		// check server result
		if ($result === false) {
			// query error
			echo '<p>Query error. No soup for you! *snap*</p>';
			echo '<p>Error info: ' . $dbh->errorinfo()[2] . '</p>';
			
			break; // terminate case
		}
		
		// retrieve contact from result set
		$contact = $result->fetch(PDO::FETCH_ASSOC);
	
	// break; // yes, that's deliberately commented out
	
	case 'ADD': // display contact form
?>

		<form action="<?php echo $self; ?>?action=process<?php if (!empty($id)) echo '&id='.$id ?>" method="post">
			<div>
				<label>First Name: 
				<input name="firstname" value="<?php echo empty($contact['firstname']) ?'': $contact['firstname']; ?>" /></label>
			</div>

			<div>
				<label>Last Name: 
				<input name="lastname" value="<?php echo empty($contact['lastname']) ?'': $contact['lastname']; ?>" /></label>
			</div>

			<div>
				<label>Email: 
				<input name="email" value="<?php echo empty($contact['email']) ?'': $contact['email']; ?>" /></label>
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
		
		// RULE 1: NEVER TRUST USER DATA!
		
		// data validation - 'innocent until guilty' approach
		$isFormValid = true; // start by assuming form is valid
		$validationErrors = '';
		
		// rules then look for exceptions
				
		// firstname should not be blank
		if (empty($_POST['firstname'])) {
			// exception found! first, invalidate form
			$isFormValid = false;
			// now add the error to a list of error messages
			$validationErrors .= '<br />First name cannot be blank.';
		}
		
		// lastname shoud be more than three characters long
		if (strlen($_POST['lastname']) < 3) {
			// exception found! first, invalidate form
			$isFormValid = false;
			// now add the error to a list of error messages
			$validationErrors .= '<br />Last name must be at least 3 characters.';
		}
		
		// Email should appear to be properly formatted
		$pattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';
		if ( preg_match($pattern, $_POST['email']) == 0 ) {
			// exception found! first, invalidate form
			$isFormValid = false;
			// now add the error to a list of error messages
			$validationErrors .= '<br />Email appears to be invalid.';
		}
		
		// now check if form is still valid
		if (!$isFormValid) {
			echo '<p>The following errors have been found: ' . $validationErrors .
			     '<br />Please go back and correct those field values.</p>';
			
			break;
		}

		// always sanitize data before using it in a query
		$firstname = $dbh->quote($_POST['firstname']);
		$lastname = $dbh->quote($_POST['lastname']);
		$email = $dbh->quote($_POST['email']);
		

		// build query
		// note that after using PDO->quote() the quotes around the values
		// are no longer necessary
		if (empty($id)) {
			$query = 'INSERT INTO ';
		} else {
			$query = 'UPDATE ';
		}
		
		$query .= 'contacts SET ' .
					"firstname = {$firstname}, " . 
					"lastname = {$lastname}, " . 
					"email = {$email} "; 
		
		if (!empty($id)) $query .= " WHERE id = {$id} ";

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
	
	case 'DELETE': // delete record
		if (empty($id)) {
			echo '<p>No record specified to delete.</p>'; // no soup for you! *snap*
			break;
		}
		
		$query = "DELETE FROM contacts WHERE id = {$id} ";
		
		// send query to server
		$result = $dbh->exec($query);
		
		// check server result
		if ($result == 0) {
			// no rows affected - some kind of error
			echo '<p>Record was NOT deleted.<br />'.$query.'</p>';
			break;
		}
		
		// success
		echo '<p>The record was deleted successfully.</p>';
	
	break; // DELETE
	
} // switch $action


include('footer.php');
