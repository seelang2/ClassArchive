<?php
require('config.php');
include('header.php');

// extract action from query string
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

// extract id if passed in query string
if (!empty($_GET['id']))
	$id = escape($_GET['id']);
else
	unset($id);


switch($action) {
	case 'PROCESS':
		// process form data
		
		// ALWAYS sanitize user data before using in a query
		$name = escape($_POST['name']);
		$email = escape($_POST['email']);
		$login = escape($_POST['login']);
		$password = escape($_POST['password']);
		$permissions = escape($_POST['permissions']);
		
		// simple validation scheme - innocent until guilty
		$form_is_valid = true; // assume data is valid
		$errorMessages = '';
		
		// validation rules look for invalid data
		
		// name can't be blank
		if (empty($name)) {
			$form_is_valid = false; // mark data as invalid
			$errorMessages .= '<br />Name field cannot be blank.';
		}
		
		// login must be min 4 and max 15 chars
		if (strlen($login) < 4 || strlen($login) > 15) {
			$form_is_valid = false; // mark data as invalid
			$errorMessages .= '<br />Login must be between 4 to 15 characters.';
		}
		
		// email should look like an email address
		if (!preg_match('/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $email)) {
			$form_is_valid = false; // mark data as invalid
			$errorMessages .= '<br />Email appears invalid.';
		}
		
		if (!$form_is_valid) {
			echo '<p>The following errors have been found:'.$errorMessages.
			'<br />Please go back and correct these errors.</p>';
			break; // terminate case
		}
		
		// save record in database
		if (empty($id)) {
			$query = "INSERT INTO ";
		} else {
			$query = "UPDATE ";
		}
		
		$query.= "authors SET " .
				 "name = '$name', " .
				 "email = '$email', " .
				 "login = '$login', " .
				 "password = '$password', " .
				 "permissions = '$permissions' ";
		
		if (!empty($id)) $query .= " WHERE id = '$id' ";
		
		$result = @mysql_query($query);
		if (!$result) {
			// query error
			echo '<p>Query error. Query:<br />'.$query.'</p>';
			break;
		}
		
		// success!
		echo '<p>The record was successfully saved.<br />'.$query.'</p>';
		
	break; // PROCESS
	
	case 'EDIT': // edit record
		// retrieve record to display in form
		if (empty($id)) {
			// $id not set
			echo '<p>Invalid ID specified.</p>';
			break;	
		}
		
		// build query
		$query = "SELECT name, email, login, password, permissions ".
				 "FROM authors WHERE id = '$id'";
		// send query
		$result = @mysql_query($query);
		// check query result
		if (!$result && mysql_num_rows($result) != 1) {
			// error
			echo '<p>Query error or record not found.</p>';
			break; // terminate case
		}
		
		// process result
		$data = mysql_fetch_array($result,MYSQL_ASSOC);
		
		//echo '<pre>'.print_r($data, true).'</pre>';
		
	case 'ADD':
		// display data entry form
		?>
        <form action="admin-authors.php?action=process<?php echo empty($id)? '': '&id='.$id; ?>" method="post">
        	<label>
            	Name: 
                <input name="name" type="text" 
                 value="<?php echo empty($data['name'])? '': $data['name']; ?>" />
            </label>
        	<label>
            	Email: 
                <input name="email" type="text" 
                 value="<?php echo empty($data['email'])? '': $data['email']; ?>" />
            </label>
        	<label>
            	Login: 
                <input name="login" type="text" 
                 value="<?php echo empty($data['login'])? '': $data['login']; ?>" />
            </label>
        	<label>
            	Password: 
                <input name="password" type="text" 
                 value="<?php echo empty($data['password'])? '': $data['password']; ?>" />
            </label>
        	<label>
            	Permissions:
                <select name="permissions">
				<?php
                foreach($permissionList as $value => $optionName) {
                	echo '<option value="'.$value.'"';
					if (!empty($data['permissions']) && $data['permissions'] == $value)
                    	echo ' selected="selected"';
					echo '>'.$optionName.'</option>';
                }
                
                ?>
                </select> 
            </label>
            <label><input type="submit" value="Save Record" /></label>
        </form>
        <?php
	break; // ADD
	
	case 'LIST':
		// build query
		$query = "SELECT id, login, name, email, permissions FROM authors";
		
		// send query to server
		$results = @mysql_query($query);
		
		// check query result
		if (!$results) {
			// query error
			echo '<p>Query error. No soup for you! *snap*</p>';
			break; // terminate case
		}
		
		// process results
		if (mysql_num_rows($results) == 0) {
			// no rows in table
			echo '<p>No records in database.</p>';
			break; // terminate case
		}
		
		// build table
		echo '<table><tbody>';
		
		// loop through result set and build table rows
		while($row = mysql_fetch_array($results)) {
			echo '<tr>' .
				 	'<td>'. $row['id'] .'</td>' .
				 	'<td>'. $row['login'] .'</td>' .
				 	'<td>'. $row['name'] .'</td>' .
				 	'<td>'. $row['email'] .'</td>' .
				 	'<td>'. $permissionList[$row['permissions']] .'</td>' .
					'<td>'.
						'<a href="admin-authors.php?action=edit&id='.$row['id'].'">Edit</a>'.
						' | '.
						'<a href="admin-authors.php?action=delete&id='.$row['id'].'">Delete</a>'.
					'</td>'.
				 '</tr>';
		} // while
		
		echo '</tbody></table>';
		
	break; // LIST
	
	case 'DELETE': // delete a record
		if (empty($id)) {
			echo '<p>Invalid or missing ID.</p>';
			break;
		}
		
		$query = "DELETE FROM authors WHERE id = '$id'";
		
		if (!$result = @mysql_query($query)) {
			echo '<p>Error trying to delete the record.</p>';
			break;
		}
		
		echo '<p>The record has been deleted.</p>';
		
	break; // DELETE
	
} // switch

include('footer.php');
?>
