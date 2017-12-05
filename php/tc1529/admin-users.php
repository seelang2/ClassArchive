<?php






// connect to database server
$dbcnx = @mysql_connect('localhost', 'root', 'xampp');
if (!$dbcnx) exit('Error connecting to database server.');

// select database
$dbh = @mysql_select_db('tc1529');
if (!$dbh) exit('Error selecting database.');


if (!empty($_GET['action'])) {
	$action = strtoupper($_GET['action']);
}

if (!empty($_GET['id'])) {
	$id = mysql_escape_string($_GET['id']);
} else {
	unset($id);
}

switch($action)
{
	case 'PROCESS': // process form data
		// form validation setup
		$data_validated = true;
		$validation_errors = '';
		
		// get data from POST array
		// validate data as we go along
		
		// check for blank field
		if (empty($_POST['firstname'])) {
			$data_validated = false;
			$validation_errors .= '<br />The first name field cannot be blank.';
		} else {
			$firstname = mysql_escape_string($_POST['firstname']);
		}
		
		if (empty($_POST['lastname'])) {
			$data_validated = false;
			$validation_errors .= '<br />The last name field cannot be blank.';
		} else {
			$lastname = mysql_escape_string($_POST['lastname']);
		}
		
		if (empty($_POST['screen_name'])) {
			$data_validated = false;
			$validation_errors .= '<br />The screen name field cannot be blank.';
		} else {
			$screen_name = mysql_escape_string($_POST['screen_name']);
		}
		
		if (empty($_POST['password'])) {
			$data_validated = false;
			$validation_errors .= '<br />The password field cannot be blank.';
		} else {
			$password = mysql_escape_string($_POST['password']);
		}
		
		// check for minimum length
		if (strlen($password) < 4) {
			$data_validated = false;
			$validation_errors .= '<br />The password must be at least four characters.';
		}
		
		if (empty($_POST['email'])) {
			$data_validated = false;
			$validation_errors .= '<br />The email field cannot be blank.';
		} else {
			$email = mysql_escape_string($_POST['email']);
		}
		
		if (empty($_POST['permissions'])) {
			$data_validated = false;
			$validation_errors .= '<br />The permissions field cannot be blank.';
		} else {
			$permissions = mysql_escape_string($_POST['permissions']);
		}
		
		// check validation state
		if (!$data_validated) {
			// display error message
			echo '<p>The following errors were encountered in your form:' .
				 $validation_errors .
				 '<br />Please go back and try again.</p>';
			break; // terminate case
		}
		
		// build query
		
		// if id is present then assume we'r doing an update
		if (empty($id)) {
			// no id, do an INSERT INTO
			$query = "INSERT INTO ";
		} else {
			// id present, do UPDATE instead
			$query = "UPDATE ";
		}
		
		$query .= "users SET " .
				  "firstname = '$firstname', " . 
				  "lastname = '$lastname', " . 
				  "screen_name = '$screen_name', " . 
				  "password = '$password', " . 
				  "email = '$email', " . 
				  "permissions = '$permissions' ";
		
		// add WHERE clause to update (id present on update)
		if (!empty($id)) $query .= "WHERE id = '$id'";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo 'Error. No soup for you!';
		} else {
			// query worked
			echo '<p>The database was updated successfully.</p>';
		}
	break; // PROCESS
	
	case 'EDIT': // edit record
		// check for id variable
		if (empty($id)) {
			// id hasn't been passed
			echo 'Invalid ID.';
			break; // terminate case
		}
		
		// lookup record
		$query = "SELECT firstname, lastname, screen_name, password, email, permissions " .
				 "FROM users " .
				 "WHERE id = '$id'";
		
		$result = @mysql_query($query);
		if ( (!$result) || (mysql_num_rows($result) != 1) ) {
			// query error or invalid number of rows
			echo 'Query error or record not found.';
			break; // terminate case
		}
		
		$user = mysql_fetch_array($result);
	
	case 'ADD': // display input form
?>		
		<form action="admin-users.php?action=process<?php if (isset($id)) echo '&id=' . $id; ?>"
         method="post">
        	<div>
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname"
                 value="<?php if (isset($user['firstname'])) echo $user['firstname']; ?>" />
            </div>
        	<div>
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname" id="lastname"
                 value="<?php if (isset($user['lastname'])) echo $user['lastname']; ?>" />
            </div>
        	<div>
                <label for="screen_name">Screen Name:</label>
                <input type="text" name="screen_name" id="screen_name"
                 value="<?php if (isset($user['screen_name'])) echo $user['screen_name']; ?>" />
            </div>
        	<div>
                <label for="password">Password:</label>
                <input type="text" name="password" id="password"
                 value="<?php if (isset($user['password'])) echo $user['password']; ?>" />
            </div>
        	<div>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email"
                 value="<?php if (isset($user['email'])) echo $user['email']; ?>" />
            </div>
        	<div>
                <label for="permissions">Permission:</label>
                <input type="text" name="permissions" id="permissions"
                 value="<?php if (isset($user['permissions'])) echo $user['permissions']; ?>" />
            </div>
            <div>
            	<input type="submit" value="Update database" />
            </div>
        </form>
<?php		
	break; // ADD
	
	case 'LIST': // list records
		
		// build query
		$query = 'SELECT id, lastname, firstname, email, permissions, screen_name FROM users';
		
		// send query to mysql engine
		$results = @mysql_query($query);
		
		// check results
		if (!$results) {
			// query error
			echo '<p>An error has occurred in the query: ' . mysql_error() . '<br />' .
				 'Query: ' . $query . '</p>';
			break;
		} // if results
		
		if (mysql_num_rows($results) < 1) {
			// no rows present
			echo '<p>No rows present.</p>';
		} else {
			// loop through result set and display in table
			
			echo '<table border="0" cellpadding="3" cellspacing="0">';
			echo '<tr>' .
					'<th>ID</th>' .
					'<th>Name</th>' .
					'<th>Screen Name</th>' .
					'<th>Email</th>' .
					'<th>Permissions</th>' .
					'<th>Options</th>' .
				 '</tr>';
			
			while ($row = mysql_fetch_array($results)) {

				echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['lastname'] . ', ' . $row['firstname'] . '</td>' .
						'<td>' . $row['screen_name'] . '</td>' .
						'<td>' . $row['email'] . '</td>' .
						'<td>' . $row['permissions'] . '</td>' .
						'<td>' .
							'<a href="admin-users.php?action=edit&id='. $row['id'] .'">Edit</a> | ' .
							'<a href="admin-users.php?action=delete&id='. $row['id'] .'">Delete</a>' .
						'</td>' .
					 '</tr>';
				
			} // while
			
			echo '</table>';
			
		} // if num_rows
	
	
	break; // LIST
	
	case 'DELETE': // delete record
		// check for id variable
		if (empty($id)) {
			// id hasn't been passed
			echo 'Invalid ID.';
			break; // terminate case
		}
		
		// build query
		$query = "DELETE FROM users WHERE id = '$id'";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo 'Error. No soup for you!';
		} else {
			// query worked
			echo '<p>The record was deleted successfully.</p>';
		}
	break; // DELETE
	
	
} // switch






?>