<?php
// set permission flag
$page_security = 9;

require_once('config.php');
include('header.php');

if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']); }
if (!empty($_GET['id'])) { $id = escape($_GET['id']); } else { unset($id); }

?>
<div id="menu">
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=list">List Records</a> | 
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add">Add New Record</a>
</div>
<?php

switch($action) {
	case 'PROCESS':
		
		// validate form data
		$validated = true;
		$validation_errors = '';
		
		$firstname = escape($_POST['firstname']);
		// field cannot be blank
		if (empty($firstname)) {
			$validated = false;
			$validation_errors .= '<br>First name cannot be blank.';
		}
		
		$lastname = escape($_POST['lastname']);
		// field must be minimum length
		if (strlen($lastname) < 4) {
			$validated = false;
			$validation_errors .= '<br>Last name must be at least 4 characters.';
		}
		
		$email = escape($_POST['email']);
		// match email number format
		if (!preg_match('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/', $email)) {
			$validated = false;
			$validation_errors .= '<br>Email address appears invalid.';
		}
		
		$password = escape($_POST['password']);
		// field has minimum and maximum length
		if (strlen($password) < 6 || strlen($password) > 15) {
			$validated = false;
			$validation_errors .= '<br>Password must be between 6 and 15 characters.';
		}
		
		$company = escape($_POST['company']);
		$title = escape($_POST['title']);
		$url = escape($_POST['url']);
		
		$phone1 = escape($_POST['pri_phone']);
		// match phone number format
		if (!preg_match('/[1-9][0-9]{2}-[1-9][0-9]{2}-[0-9]{4}/', $phone1)) {
			$validated = false;
			$validation_errors .= '<br>Phone number is not in valid format.';
		}
		
		$phone2 = escape($_POST['sec_phone']);
		
		$gender = escape($_POST['gender']);
		// field must be a number
		if (!is_numeric($gender)) {
			$validated = false;
			$validation_errors .= '<br>Gender is an invalid value.';
		}
		
		$permissions = escape($_POST['permissions']);
		
		if (!$validated) {
			// form data is not valid
			echo '<p>The following errors were found:' . $validation_errors .
				 '<br />Please go back and correct the errors.</p>';
			break; // terminate case
		}
		
		// update database
		// build query
		if (empty($id)) {
			$query = 'INSERT INTO ';
		} else {
			$query = 'UPDATE ';
		}
		
		$query .= 'users SET ' .
					"firstname = '".$firstname."', " .
					"lastname = '".$lastname."', " .
					"email = '".$email."', " .
					"password = '".$password."', " .
					"company = '".$company."', " .
					"title = '".$title."', " .
					"url = '".$url."', " .
					"pri_phone = '".$phone1."', " .
					"sec_phone = '".$phone2."', " .
					"gender = '".$gender."', " .
					"permissions = '".$permissions."' ";
		
		if (!empty($id)) { $query .= " WHERE id = '$id' ";}
		
		// send query to database server
		$result = @mysql_query($query);
		
		// check result
		// display user feedback
		if (!$result) {
			// no results - query error
			echo '<p>There was an error updating the database.<br />' .
				 mysql_error() . '<br />' .
				 $query . '</p>';
		
		} else {
			// query worked, all good
			echo '<p>The database was updated successfully.</p>';
			
		} // if result
		
		
	break; // PROCESS
	
	case 'EDIT':
		// check that id is set
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // terminate case 
		}
		
		// retrieve record
		
		$query = "SELECT * FROM users WHERE id = '$id' ";
		
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// query error or incorrect # of rows returned
			echo '<p>Invalid record specified.</p>';
			break;
		}
		
		$row = mysql_fetch_array($result);
	
	case 'ADD':
		// display form for user to enter data
		
		?>
        <div style="width: 300px;">
        <form action="admin-users.php?action=process<?php echo ((empty($id))?'':'&id='.$id); ?>" method="post">
        	<label>
            	First Name:
                <input type="text" name="firstname" 
                 value="<?php echo ((empty($row['firstname']))?'':$row['firstname']); ?>" />
            </label>
        	<label>
            	Last Name:
                <input type="text" name="lastname" 
                 value="<?php echo ((empty($row['lastname']))?'':$row['lastname']); ?>" />
            </label>
        	<label>
            	Email:
                <input type="text" name="email" 
                 value="<?php echo ((empty($row['email']))?'':$row['email']); ?>" />
            </label>
        	<label>
            	Password:
                <input type="text" name="password" 
                 value="<?php echo ((empty($row['password']))?'':$row['password']); ?>" />
            </label>
        	<label>
            	Company:
                <input type="text" name="company" 
                 value="<?php echo ((empty($row['company']))?'':$row['company']); ?>" />
            </label>
        	<label>
            	Title:
                <input type="text" name="title" 
                 value="<?php echo ((empty($row['title']))?'':$row['title']); ?>" />
            </label>
        	<label>
            	Website:
                <input type="text" name="url" 
                 value="<?php echo ((empty($row['url']))?'':$row['url']); ?>" />
            </label>
        	<label>
            	Primary Phone:
                <input type="text" name="pri_phone" 
                 value="<?php echo ((empty($row['pri_phone']))?'':$row['pri_phone']); ?>" />
            </label>
        	<label>
            	Secondary Phone:
                <input type="text" name="sec_phone" 
                 value="<?php echo ((empty($row['sec_phone']))?'':$row['sec_phone']); ?>" />
            </label>
        	<label>
            	Gender:
                <select name="gender">
                	<option value="">Select one</option>
                	<option value="1" 
					 <?php echo (!empty($row['gender']) && $row['gender'] == 1)?' selected="selected" ':''; ?>
                     >Male</option>
                	<option value="2"
					 <?php echo (!empty($row['gender']) && $row['gender'] == 2)?' selected="selected" ':''; ?>
                     >Female</option>
                </select>
            </label>
        	<label>
            	Permissions:
                <select name="permissions">
                	<option value="1">Regular User</option>
                	<option value="9">Administrator</option>
                </select>
            </label>
            <div style="text-align:center">
            	<input type="submit" value="Update Database" />
            </div>
        </form>
        </div>
        <?php
	
	break; // ADD
	
	case 'LIST':
		// build query
		$query = 'SELECT id, firstname, lastname, company, permissions FROM users';
		// send query to server
		$results = @mysql_query($query);
		// check results
		if (!$results) {
			// query error
			echo '<p>There was a query error. No soup for you! *snap*</p>';
			break;
		}
		if (mysql_num_rows($results) == 0) {
			echo '<p>No records found.</p>';
			break;
		}
		
		echo '<table><tbody>' .
			 '<tr>' .
			 	'<th>ID</th>' .
			 	'<th>Name</th>' .
			 	'<th>Company</th>' .
			 	'<th>Permissions</th>' .
			 	'<th>Options</th>' .
			 '</tr>';
		while($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>'.$row['id'].'</td>' .
					'<td>'.$row['lastname'].', '.$row['firstname'].'</td>' .
					'<td>'.$row['company'].'</td>' .
					'<td>'.$row['permissions'].'</td>' .
					'<td>' .
						'<a href="admin-users.php?action=edit&id='.$row['id'].'">Edit</a>' . ' | ' .
						'<a href="admin-users.php?action=delete&id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a>' .
					'</td>' .
				 '</tr>';
		}
		echo '</tbody></table>';
		
		
	break; // LIST
	
	case 'DELETE':
		// check that id is set
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // terminate case 
		}
		
		$query = "DELETE FROM users WHERE id = '$id' ";
		
		if (!$result = @mysql_query($query)) {
			// query error
			echo '<p>Query error - No soup for you!</p>';
			break;
		}
		
		echo '<p>'.mysql_affected_rows().' has/have been deleted.</p>';
		
	break; // DELETE
	
} // switch



include('footer.php');
?>