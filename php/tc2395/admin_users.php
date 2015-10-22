<?php
$page_permission = 9;
require_once('config.php');

$action = 'LIST';
// get action parameter from query string
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);
// set or unset id if passed or not
if (!empty($_GET['id'])) $id = escape($_GET['id']); else unset($id);

?>
<div>
	<p>
    	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=list">List Records</a>&nbsp;|&nbsp;
    	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add">Add New Record</a>
    </p>
</div>
<?php

switch($action)
{
	case 'POST': // process form data
		
		// begin data validation
		$validated = true; // innocent until proven guilty
		$errormsg = ''; // placeholder for any error messages
		
		// name cannot be blank
		if (empty($_POST['name'])) {
			$validated = false;
			$errormsg .= '<br />Name field cannot be blank.';
		} else {
			$name = escape($_POST['name']); // ALWAYS sanitize data before using in query!
		}
		
		// field has a minimum and maximum length
		if (strlen($_POST['password']) < 4 || strlen($_POST['password']) > 12) {
			$validated = false;
			$errormsg .= '<br />Password must be between 4 and 12 characters.';
		} else {
			$password = escape($_POST['password']); // ALWAYS sanitize data before using in query!
		}
		
		// email validation
		if ( preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $_POST['email']) != 1) {
			$validated = false;
			$errormsg .= '<br />Email does not appear to be a valid address.';
		} else {
			$email = escape($_POST['email']); // ALWAYS sanitize data before using in query!
		}
		
		// check to see if value exists in an array
		if (!array_key_exists($_POST['permissions'],$PERMISSION_CODES)) { // method 1
		//if (empty($PERMISSION_CODES[$_POST['permissions']])) { // alternate method
			$validated = false;
			$errormsg .= '<br />Permissions field is not a valid value.';
		} else {
			$permissions = escape($_POST['permissions']); // ALWAYS sanitize data before using in query!
		}
		
		// confirm validation
		if (!$validated) {
			// validation fail
			echo '<p>The following errors have occurred:' .
				 $errormsg . 
				 '<br />Please go back and correct before continuing.</p>';
			break; // terminate case
		}
		
		// build query
		if (empty($id)) {
			// add new record
			$query = 'INSERT INTO ';
		} else {
			// edit existing record
			$query = 'UPDATE ';
		}
		
		$query .= 'users SET ' .
				 "name = '$name', " .
				 "email = '$email', " .
				 "password = '$password', " .
				 "permissions = '$permissions' ";
		
		if (!empty($id)) $query .= " WHERE id = '$id' ";
		
		// send query to server
		$result = @mysql_query($query);
		// check result(s)
		if (!$result) {
			// query error
			echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		// display feedback
		echo '<p>The database was updated successfully.</p>';
		
	break; // POST
	
	case 'EDIT': // edit record
		if (empty($id)) {
			echo '<p>Invalid id. No soup for you! *snap*</p>';
			break; // terminate case
		}
		
		// lookup record
		$query = "SELECT * FROM users WHERE id = '$id' ";
		
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// query error or no rows/too many rows(?!) found
			echo '<p>The record could not be found.</p>';
			//echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		$user = mysql_fetch_array($result);
	
	case 'ADD': // display new form
?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=post<?php if ($action == 'EDIT') echo "&id=$id"; ?>" method="post">
        	<div>
            	<label for="name">Name</label>
                <input id="name" name="name" value="<?php echo ( empty($user['name']) ) ? NULL : $user['name']; ?>" />
            </div>
        	<div>
            	<label for="email">Email</label>
                <input id="email" name="email" value="<?php echo ( empty($user['email']) ) ? NULL : $user['email']; ?>" />
            </div>
        	<div>
            	<label for="password">Password</label>
                <input id="password" name="password" value="<?php echo ( empty($user['password']) ) ? NULL : $user['password']; ?>" />
            </div>
        	<div>
            	<label for="permissions">Permission</label>
                <input id="permissions" name="permissions" value="<?php echo ( empty($user['permissions']) ) ? NULL : $user['permissions']; ?>" />
            </div>
            <div>
            	<input type="submit" value="Update record" />
            </div>
        </form>
<?php	
	break; // ADD
	
	case 'LIST': // list records in table
		// build query
		$query = 'SELECT * FROM users';
		// send query to server
		$results = @mysql_query($query, $dbcnx);
		// check results
		if (!$results) {
			// query error
			echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		// process results
		if (mysql_num_rows($results) == 0) {
			// no rows present
			echo '<p>No rows present.</p>';
		} else {
			// display rows in table
			echo '<table><thead>';
			echo '<tr>' .
					'<td>ID</td>' .
					'<td>Name</td>' .
					'<td>Email</td>' .
					'<td>Password</td>' .
					'<td>Permissions</td>' .
					'<td>Options</td>' .
				 '</tr>';
			echo '</thead><tbody>';
			// loop through result rows
			while($row = mysql_fetch_array($results)) {
				echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['name'] . '</td>' .
						'<td>' . $row['email'] . '</td>' .
						'<td>' . $row['password'] . '</td>' .
						'<td>' . $PERMISSION_CODES[$row['permissions']] . '</td>' .
						'<td>' .
							'<a href="admin_users.php?action=edit&id='.$row['id'].'">Edit</a> | ' .
							'<a href="admin_users.php?action=delete&id='.$row['id'].
								'" onclick="return confirm(\'Are you sure you wish to delete this record?\')">Delete</a>' .
						'</td>' .
					 '</tr>';
			} // while
			echo '</tbody></table>';
			
		} // if num_rows
		
	break; // LIST
	
	case 'DELETE': // delete records
		if (empty($id)) {
			echo '<p>Invalid id. No soup for you! *snap*</p>';
			break; // terminate case
		}
		// lookup record
		$query = "DELETE FROM users WHERE id = '$id' ";
		// send query to server
		$result = @mysql_query($query);
		// check result(s)
		if (!$result) {
			// query error
			echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		// display feedback
		echo '<p>The record has been successfully deleted.</p>';
		
	break; // DELETE
	
} // switch


?>