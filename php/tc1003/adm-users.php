<?php
require_once('config.php');

/*
$dbcnx = mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) exit('Error connecting to database server.');

$dbh = mysql_select_db('tc1003');

if (!$dbh) exit('Error selecting database.');
*/

function listRecords() {
		global $permissionTypes;
		
		$query = 'SELECT id, firstname, lastname, email, permission FROM users';
		
		if (!$results = mysql_query($query)) {
			// query error
			echo "Error processing query $query";
		} else {
			if (mysql_num_rows($results) < 1) {
				echo '<p>No rows present.</p>';
			} else {
				// process result set
				
				echo '<table cellpadding="3" cellspacing="0">';
				echo '<tr><th>ID</th><th>Name</th><th>Email Address</th><th>Permission</th><th>Options</th></tr>';
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['lastname'] . ', ' . $row['firstname'] . '</td>' .
						'<td>' . $row['email'] . '</td>' .
						'<td>' . $permissionTypes[$row['permission']] . '</td>' .
						'<td>' . 
						'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a> | ' .
						'<a href="' . $_SERVER['PHP_SELF'] . '?mode=delete&id=' . $row['id'] . '">Delete</a>' .
						'</td>' .
						'</tr>';
				}
				echo '</table>';
			}
		}
}

function validateEmail($email) {
//	$query = 'SELECT id FROM users WHERE email = \'' . escape($_POST['email']) . '\' LIMIT 1';
	$query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
	$result = @mysql_query($query);
	if (!$result) {
		// query error
		echo "Error processing query $query";
	} else {
		if (mysql_num_rows($result) > 0) {
			return false;
//			$validated = false;
//			$errmsg .= 'A user with that email address already exists.<br />';
		}
		return true;	
	}
}

$mode = 'LIST';
if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']);
if (!empty($_GET['id'])) $id = mysql_real_escape_string($_GET['id']); else unset($id);

include('header.php');

?>

<p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List records</a> | 
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add new record</a>
</p>

<?php

switch($mode)
{
	case 'LIST':
		listRecords();
	break;
	
	case 'UPDATE':
		if (!isset($id)) {
			// error
			echo 'No id present.';
			break;
		}
	
	case 'INSERT':
		if (isset($_POST['butSubmit'])) {
			// processing form data
			
			$validated = true;
			$errmsg = '';
			
			// run validation rules
			
			// avoid duplicate email entries
			if (!isset($id)) {
				// this is an insert
				if (!validateEmail(escape($_POST['email']))) {
					$validated = false;
					$errmsg .= 'A user with that email address already exists.<br />';
				}
			}
			
			if (isset($id)) {
				// this is an update, email is optional
				$query = "SELECT email FROM users where id = '$id' LIMIT 1";
				if (!$result = @mysql_query($query)) {
					// query error
				} else {
					$user = @mysql_fetch_array($result);
					if (escape($_POST['email']) != $user['email']) {
						if (!validateEmail(escape($_POST['email']))) {
							$validated = false;
							$errmsg .= 'A user with that email address already exists.<br />';
						}
					}
				}
			}

			
			// validate password only if operation is not an update
			if (!isset($id)) {
				if (empty($_POST['password']) || strlen($_POST['password']) < 4) {
					$validated = false;
					$errmsg .= 'The password field must be longer than 4 characters.<br />';
				}
				
				if ($_POST['password'] != $_POST['password2']) {
					$validated = false;
					$errmsg .= 'The password fields do not match.<br />';
				}
			}
			
			// password validation version for updates only
			if (isset($id)) {
				if (!empty($_POST['password'])) {
					if (strlen($_POST['password']) < 4) {
						$validated = false;
						$errmsg .= 'The password field must be longer than 4 characters.<br />';
					}

					if ($_POST['password'] != $_POST['password2']) {
						$validated = false;
						$errmsg .= 'The password fields do not match.<br />';
					}
				} else {
					unset($_POST['password']);
				}
			
			}
			
			if ($validated) {
				
				if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
				
				$query .= 'users SET ';
				
				$c = 1;
				foreach ($_POST as $field => $value) {
					if ($field != 'butSubmit' && $field != 'password2') {
						if ($c > 1) $query .= ', ';
						$value = mysql_real_escape_string($value);
						if ($field == 'password') $value = sha1($value . SECURITY_SALT);
						$query .= "$field = '$value'";
					}
					$c++;
				}
				
				if (isset($id)) $query .= " WHERE id = '$id'";
				
				$result = mysql_query($query);
				if (!$result) {
					// error occurred
					echo "Error processing query $query";
				} else {
					// process results
					echo 'Record successfully updated.';
					listRecords();
				}
				
			} else {
				// validation failed
				echo "The following error(s) have occurred:<br />$errmsg<br />Please click the Back button on your browser to correct.";
			}
				
		} else {
			// no form data posted
			echo '<p>Error: No form data present.</p>';
		}
	break;
	
	case 'EDIT':
		if (!isset($id)) {
			// error
			echo 'No ID specified.';
			redirect($base_url . $_SERVER['PHP_SELF']);
		} else {
			$query = "SELECT * FROM users WHERE id = '$id'";
			$result = mysql_query($query);
			if (!$result || mysql_num_rows($result) != 1) {
				// error
				echo "Error processing query $query";
				break;
			} else {
				$row = mysql_fetch_array($result);
				$newmode = 'update&id=' . $id;
			}
		}
	
	case 'ADD':
		// display entry form
		if (!isset($newmode)) $newmode = 'insert';
		
?>		
		<h1>Add New Record</h1>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=<?php echo $newmode; ?>" method="post">
			<div>
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" size="50" maxlength="100" />
			</div>
			<div>
			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" size="50" maxlength="100" />
			</div>
			<div>
			<label for="email">Email:</label>
			<input type="text" name="email" value="<?php echo $row['email']; ?>" size="50" maxlength="100" />
			</div>
			<div>
			<label for="password">Password:</label>
			<input type="password" name="password" value="<?php //echo $row['password']; ?>" size="50" maxlength="100" />
			</div>
			<div>
			<label for="password2">Re-enter Password:</label>
			<input type="password" name="password2" value="<?php //echo $row['password']; ?>" size="50" maxlength="100" />
			</div>
			<div>
			<label for="permission">Permission:</label>
<?php
			echo '<select name="permission">';
			foreach ($permissionTypes as $key => $value) {
				echo '<option value="' . $key . '"';
				if ($row['permission'] == $key) echo ' selected="selected"';
				echo '>' . $value . '</option>';
			}
			echo '</select>';
?>
			</div>

<!--
			<label for="permission">Permission:</label>
			<input type="text" name="permission" value="<?php echo $row['permission']; ?>" size="50" maxlength="100" />
			</div>
-->			
			<input name="butSubmit" type="submit" value="Enter Record" />
		</form>

<?php
	break;

	case 'DELETE':
		if (!isset($id)) {
			// no id present, display error
			echo 'No id present.';
		} else {
			// process delete
			$query = "DELETE FROM users WHERE id = '$id'";
			if (!$result = mysql_query($query)) {
				// error during delete
				echo "Error processing query $query";
			} else {
				// successful delete
				echo 'Record successfully deleted.';
				listRecords();
			}
		}
	break;

}






include('footer.php');
?>