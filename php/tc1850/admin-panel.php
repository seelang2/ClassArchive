<?php
require('config.php');
include('header.php');

$action = '';

if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);
if (!empty($_GET['id'])) $id = mysql_escape_string($_GET['id']); else unset($id);


?>

	<p>
    	<a href="admin-panel.php?action=list">List Records</a> | 
    	<a href="admin-panel.php?action=showform">Add New Record</a>
    </p>

<?php

switch($action) 
{
	default:
	case 'LIST':
		// build query
		$query = 'SELECT id, username, firstname, lastname, status FROM users';
		// send query
		$results = @mysql_query($query);
		// check results
		if (!$results) {
			// query error
			echo '<p>There was a problem with the query.<br />' . $query . '</p>';
			break; // terminate case
		}
		// process results
		if (mysql_num_rows($results) == 0) {
			echo '<p>No rows in table.</p>';
			break;
		}
		// loop through results and display table
		echo '<table border="0" cellpadding="3" cellspacing="0">' .
				'<tr>' .
					'<th>ID</th>' .
					'<th>Username</th>' .
					'<th>Firstname</th>' .
					'<th>Lastname</th>' .
					'<th>Status</th>' .
					'<th>Options</th>' .
				'</tr>';
		while($row = mysql_fetch_array($results)) {

			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['username'] . '</td>' .
					'<td>' . $row['firstname'] . '</td>' .
					'<td>' . $row['lastname'] . '</td>' .
					'<td>' . $row['status'] . '</td>' .
					'<td>' .
						'<a href="admin-panel.php?action=edit&id='. $row['id'] .'">View/Edit</a>' . ' | ' .
						'<a href="admin-panel.php?action=delete&id='. $row['id'] .
						'" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>' .
					'</td>' .
				 '</tr>';
			
		} // while
		echo '</table>';
		
	break; // LIST
	
	case 'PROCESSFORM':
		// check if data is present
		if (empty($_POST)) {
			echo '<p>Error: No data present</p>';
			break;
		}
		
		$firstname = mysql_escape_string($_POST['firstname']);
		$lastname = mysql_escape_string($_POST['lastname']);
		$email = mysql_escape_string($_POST['email']);
		$username = mysql_escape_string($_POST['username']);
		$password = mysql_escape_string($_POST['password']);
		$permissions = mysql_escape_string($_POST['permissions']);
		$status = mysql_escape_string($_POST['status']);
		
		// validation rules
		$validated = true; // innocent until proven guilty
		$errors = '';
		
		// check for blank field
		if (empty($firstname)) {
			$validated = false;
			$errors .= '<br />First name cannot be blank.';
		}
		
		// check for blank field
		if (empty($lastname)) {
			$validated = false;
			$errors .= '<br />Last name cannot be blank.';
		}
		
		// check for minimum length
		if (strlen($username) < 4) {
			$validated = false;
			$errors .= '<br />Username must be at least four characters.';
		}

		// check for range
		if (strlen($password) < 4 || strlen($password) > 15) {
			$validated = false;
			$errors .= '<br />Password must be between 4 and 15 characters.';
		}
		
		// basic email validation
		if (!preg_match("/^[^@]*@[^@]*\.[^@]*$/", $email)) {
			$validated = false;
			$errors .= '<br />Please enter a valid email address.';
		}
		
		// check validation status
		if (!$validated) {
			echo '<p>The following errors have been encountered:' . 
				 $errors .
				 '<br />Please go back and correct those errors.</p>';
			break;
		}

		// build query
		if (empty($id)) {
			$query = "INSERT INTO ";
		} else {
			$query = "UPDATE ";
		}
		
		$query .= "users SET " .
				 "firstname = '$firstname', " .
				 "lastname = '$lastname', " .
				 "email = '$email', " .
				 "username = '$username', " .
				 "password = '$password', " .
				 "permissions = '$permissions', " .
				 "status = '$status' ";
		
		if (!empty($id)) $query .= "WHERE id = '$id'";
		 
		// send query to server
		$result = @mysql_query($query);
		// check result
		if (!$result) {
			echo '<p>There was a problem with the query.<br />' . $query . '</p>';
			break; // terminate case
		}
		// success
		echo '<p>The record was saved successfully.</p>';
		
	break; // PROCESSFORM
	
	case 'EDIT':
		// check for valid id
		if (empty($id)) {
			echo '<p>Invalid or missing id.</p>';
			break;
		}
		
		// build query
		$query = "SELECT firstname, lastname, email, username, password, permissions, status " .
				 "FROM users " .
				 "WHERE id = '$id'";
		// send query
		$result = @mysql_query($query);
		if ($result == false || mysql_num_rows($result) == 0) {
			// query error or no rows found
			echo '<p>Query invalid or missing id.</p>';
			break;
		}
		$row = mysql_fetch_array($result);
		
		
		
	case 'SHOWFORM':
	?>
    	<form action="admin-panel.php?action=processform<?php if (!empty($id)) echo '&id='.$id; ?>" method="post">
            <div>
                <label for="firstname">First Name:</label>
                <input id="firstname" name="firstname" value="<?php if (!empty($row['firstname'])) echo $row['firstname']; ?>" />
            </div>
            <div>
                <label for="lastname">Last Name:</label>
                <input id="lastname" name="lastname" value="<?php if (!empty($row['lastname'])) echo $row['lastname']; ?>" />
            </div>
            <div>
                <label for="email">Email:</label>
                <input id="email" name="email" value="<?php if (!empty($row['email'])) echo $row['email']; ?>" />
            </div>
            <div>
                <label for="username">Username:</label>
                <input id="username" name="username" value="<?php if (!empty($row['username'])) echo $row['username']; ?>" />
            </div>
            <div>
                <label for="password">Password:</label>
                <input id="password" name="password" value="<?php if (!empty($row['password'])) echo $row['password']; ?>" />
            </div>
            <div>
                <label for="permissions">Permissions:</label>
                <select id="permissions" name="permissions">
                	<option value="0" <?php if ($row['permissions'] == 0) echo 'selected="selected"'; ?>>No Access</option>
                	<option value="1" <?php if ($row['permissions'] == 1) echo 'selected="selected"'; ?>>Basic (users can leave comments)</option>
                	<option value="2" <?php if ($row['permissions'] == 2) echo 'selected="selected"'; ?>>Author (users can post pages)</option>
                	<option value="9" <?php if ($row['permissions'] == 9) echo 'selected="selected"'; ?>>Administrator</option>
                </select>
            </div>
            <div>
                <label for="status">Status:</label>
                <select id="status" name="status">
                	<option value="0" <?php if ($row['status'] == 0) echo 'selected="selected"'; ?>>Inactive</option>
                	<option value="1" <?php if ($row['status'] == 1) echo 'selected="selected"'; ?>>Deactivated</option>
                	<option value="2" <?php if ($row['status'] == 2) echo 'selected="selected"'; ?>>Suspended</option>
                	<option value="3" <?php if ($row['status'] == 3) echo 'selected="selected"'; ?>>Pending</option>
                	<option value="10" <?php if ($row['status'] == 10) echo 'selected="selected"'; ?>>Active</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Continue" />
            </div>
        </form>
    
    <?php
	break; // SHOWFORM
	
	case 'DELETE':
		if (empty($id)) {
			echo '<p>Invalid id. No soup for you!</p>';
			break;
		}
		
		$query = "DELETE FROM users WHERE id = '$id'";
		// send query to server
		$result = @mysql_query($query);
		// check result
		if (!$result) {
			echo '<p>There was a problem with the query.<br />' . $query . '</p>';
			break; // terminate case
		}
		// success
		echo '<p>The record was deleted successfully.</p>';
		
		
	break; // DELETE
	
} // switch



include('footer.php');
?>