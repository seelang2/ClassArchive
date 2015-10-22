<?php
$pagesecured = true; // simple page protection
require('init.php');

include('header.php');

// get query string parameters
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);
if (!empty($_GET['id'])) $id = mysql_escape_string($_GET['id']); else unset($id);

switch ($action) {
	
	case 'LIST':
		
		// build query
		$query = "SELECT id, firstname, lastname, email, login, status FROM users";
		// send query to server
		$results = @mysql_query($query);
		// check result
		if (!$results) {
			// query error
			echo '<p>Query error:<br />' . $query . '</p>';
			break; // terminate case
		} // if results
		
		// process results
		if (mysql_num_rows($results) == 0) {
			// no rows in table
			echo '<p>No rows in table.</p>';
			break;
		}
		
		// loop through result set and display rows in table
		echo '<table><tbody><tr>' .
			 '<th>ID</th>' .
			 '<th>Name</th>' .
			 '<th>Email</th>' .
			 '<th>Login</th>' .
			 '<th>Status</th>' .
			 '<th>Options</th>' .
			 '<tr>';
			 
		while($row = mysql_fetch_array($results)) {
			echo '<tr>' .
				 '<td>'.$row['id'].'</td>' .
				 '<td>'.$row['firstname'].' '.$row['lastname'].'</td>' .
				 '<td>'.$row['email'].'</td>' .
				 '<td>'.$row['login'].'</td>' .
				 '<td>'.$userStatus[$row['status']].'</td>' .
				 '<td>' .
				 	'<a href="manageusers.php?action=edit&id='.$row['id'].'">Edit</a>' . ' | ' .
				 	'<a href="manageusers.php?action=delete&id='.$row['id'].'">Delete</a>' .
				 '</td>' .
				 '</tr>';
		}
		
		echo '</tbody></table>';
		
	break; // LIST
	
	case 'PROCESSDATA': // process form data
		// sanitize form data. NEVER trust raw input from the user agent!
		$firstname = mysql_escape_string($_POST['firstname']);
		$lastname = mysql_escape_string($_POST['lastname']);
		$email = mysql_escape_string($_POST['email']);
		$login = mysql_escape_string($_POST['login']);
		$password = mysql_escape_string($_POST['password']);
		//validate form data
		$validated = true; // innocent until proven guilty approach
		$errors = ''; // to hold validation errors
		// create evalidation rules
		
		// field can't be blank
		if (empty($firstname)) {
			$validated = false; // invalidate form
			$errors .= '<br />First name cannot be blank.';
		}
		
		// field must be minimum length
		if (strlen($lastname) < 2) {
			$validated = false;
			$errors .= '<br />Last name must be at least two characters.';
		}
		
		// field must be a specific length
		if (strlen($password) < 6 || strlen($password) > 14) {
			$validated = false;
			$errors .= '<br />Password must be between 6 and 14 characters.';
		}
		
		// check field against a regular expression
		if (!preg_match('/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/', $email)) {
			$validated = false;
			$errors .= '<br />Please enter a valid email address';
		}
		
		// test form for validation
		if (!$validated) {
			echo '<p>The following error(s) were encountered with your form:' . $errors . 
				 '<br />Please go back and correct the form.</p>';
			break; // terminate case
		}
		
		// save data to database
		/*
		// query constructed using separate statements
		$query = empty($id)? 'INSERT INTO ' : 'UPDATE ';
		$query .= "users SET " .
					"firstname = '".$_POST['firstname']."', " .
					"lastname = '".$_POST['lastname']."', " .
					"email = '".$_POST['email']."', " .
					"login = '".$_POST['login']."', " .
					"password = '".$_POST['password']."' ";
		if (!empty($id)) $query .= " WHERE id = '$id' ";
		*/
		// query constructed in one statement using ternary operators
		$query = (empty($id)? 'INSERT INTO ' : 'UPDATE ') .
				"users SET " .
					"firstname = '".$firstname."', " .
					"lastname = '".$lastname."', " .
					"email = '".$email."', " .
					"login = '".$login."', " .
					"password = '".sha1($password . $securitySalt)."' " . // use sha1 and salt to encrypt password
				(!empty($id)? " WHERE id = '$id' " : '');
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo '<p>Query error:<br />' . $query . '</p>';
			break; // terminate case
		}
		
		// display (positive) user feedback
		echo '<p>The record has been saved.<br />' . $query . '</p>';
		
	break; // PROCESSDATA
	
	case 'EDIT':
		if (empty($id)) {
			// id has not been passed
			echo '<p>Invalid id specified.</p>';
			break;
		}
		
		$query = "SELECT firstname, lastname, email, login, password, status FROM users WHERE id = '$id' ";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// query error or empty result set
			echo '<p>The record cannot be found.</p>';
			break;
		}
		$user = mysql_fetch_array($result);
		
		
	// break omitted intentionally
	
	case 'ADD':
		// display data entry form
	?>
		
        <form action="manageusers.php?action=processdata<?php echo empty($id)?'':'&id='.$id; ?>" method="post">
            <label>First Name:
            	<input type="text" name="firstname" value="<?php echo empty($user['firstname'])?'':$user['firstname']; ?>" />
            </label>
            <label>Last Name:
            	<input type="text" name="lastname" value="<?php echo empty($user['lastname'])?'':$user['lastname']; ?>" />
            </label>
            <label>Email:
            	<input type="text" name="email" value="<?php echo empty($user['email'])?'':$user['email']; ?>" />
            </label>
            <label>Login:
            	<input type="text" name="login" value="<?php echo empty($user['login'])?'':$user['login']; ?>" />
            </label>
            <label>password:
            	<input type="text" name="password" value="<?php echo empty($user['password'])?'':$user['password']; ?>" />
            </label>
            <input type="submit" value="Save" />
        </form>
        
    <?php
	break; // ADD
	
	case 'DELETE':
		if (empty($id)) {
			// id has not been passed
			echo '<p>Invalid id specified.</p>';
			break;
		}
		
		$query = "DELETE FROM users WHERE id = '$id' ";
		$result = @mysql_query($query);
		if (!$result) {
			// query error or empty result set
			echo '<p>Error trying to delete the record.</p>';
			break;
		}
		
		echo '<p>The record has been deleted successfully.</p>';
		
	break; // DELETE

} // switch

include('footer.php');
?>