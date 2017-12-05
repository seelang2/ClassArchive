<?php
$pagesecurity = 9; // set security level on each page
require_once('config.php');

include('header.php');

if (!empty($_GET['action'])) $action = strtoupper($_GET['action']); else $action = 'LIST';
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);

switch ($action) {
	
	case 'PROCESSFORM':
		if (empty($_POST)) {
			echo '<p>Error: No data to process</p>';
			break;
		}
		
		// set up validation rules
		$validated = true;
		$validationerrors = '';
		
		// field cannot be blank
		if (empty($_POST['firstname'])) {
			$validated = false;
			$validationerrors .= '<br />First name field cannot be blank.';
		}
		
		// field has to be certain chars only
		if (preg_match('/^[A-Za-z \-\']+$/', $_POST['firstname']) == 0) {
			$validated = false;
			$validationerrors .= '<br />First name can only contain letters, spaces, hyphens and single quotes.';
		}
		
		// field cannot be blank
		if (empty($_POST['lastname'])) {
			$validated = false;
			$validationerrors .= '<br />Last name field cannot be blank.';
		}
		
		// minimum length
		if (strlen($_POST['login']) < 4) {
			$validated = false;
			$validationerrors .= '<br />Login must be at least 4 characters.';
		}
		
		// must be between x and y characters long
		if (strlen($_POST['password']) < 4 || strlen($_POST['password']) > 12) {
			$validated = false;
			$validationerrors .= '<br />Password must be 4 to 12 characters.';
		}
		
		// field nust be a number
		if (!is_numeric($_POST['permissions'])) {
			$validated = false;
			$validationerrors .= '<br />Permissions must be numeric.';
		}
		
		if (!$validated) {
			echo '<p>The following errors were found in your form: ' .
				 $validationerrors .
				 '<br />Please go back and correct those fields.</p>';
			break;
		}
		
		$firstname = $dbh->quote($_POST['firstname']);
		$lastname = $dbh->quote($_POST['lastname']);
		$login = $dbh->quote($_POST['login']);
		$password = $dbh->quote($_POST['password']);
		$permissions = $dbh->quote($_POST['permissions']);
		
		// build query
		if (empty($id)) {
			$query = 'INSERT INTO ';
		} else {
			$query = 'UPDATE ';
		}
		
		$query .= "users SET " . 
				  "firstname = $firstname, " . 
				  "lastname = $lastname, " .
				  "login = $login, " .
				  "password = $password, " .
				  "permissions = $permissions ";
		
		if (!empty($id)) $query .= " WHERE id = ".$dbh->quote($id);
		
		if (!$dbh->query($query)) {
			// query error
			$errorInfo = $dbh->errorInfo();
			echo "<p>There was an error in your query:<br />".
				 $errorInfo[2] . '<br />' .
				 "Query: $query </p>";
			break; // terminate case
		}
		
		// got this far, must've worked
		echo '<p>The database has been updated.</p>';
		
	break; // processform
	
	case 'EDIT': 
		if (empty($id)) {
			// no id - error
			echo '<p>Error: Invalid id specified.</p>';
			break; // must be present in order to win
		}
		
		$query = "SELECT * FROM users WHERE id = " . $dbh->quote($id);
		$result = $dbh->query($query);
		if (!$result) {
			// query error
			$errorInfo = $dbh->errorInfo();
			echo "<p>There was an error in your query:<br />".
				 $errorInfo[2] . '<br />' .
				 "Query: $query </p>";
			break; // terminate case
		}
		
		/*
		if (!$record = $result->fetch()) {
			// no record found with that id
			echo '<p>No record for the specified id can be found.</p>';
			break;
		}
		*/
		$record = $result->fetchAll(PDO::FETCH_ASSOC);
		if (count($record) != 1) {
			// no record or too many records found
			echo '<p>No record or too many records for the specified id can be found.</p>';
			break;
		}
		
		//print_r($record);
		
		$record = $record[0];
		
	case 'SHOWFORM':
		?>
        <form 
        	action="<?php echo $_SERVER['PHP_SELF']; ?>?action=processform<?php echo (empty($id)? '':'&id='.$id);?>" 
            method="post">
            <div>
            	<label for="firstname">First Name:</label>
                <input id="firstname" name="firstname" 
                	value="<?php echo (empty($record['firstname'])? '' : $record['firstname']); ?>" />
            </div>
        	<div>
            	<label for="lastname">Last Name:</label>
                <input id="lastname" name="lastname" 
                	value="<?php echo (empty($record['lastname'])? '' : $record['lastname']); ?>" />
            </div>
        	<div>
            	<label for="login">Login:</label>
                <input id="login" name="login" 
                	value="<?php echo (empty($record['login'])? '' : $record['login']); ?>" />
            </div>
        	<div>
            	<label for="password">Password:</label>
                <input id="password" name="password" 
                	value="<?php echo (empty($record['password'])? '' : $record['password']); ?>" />
            </div>
        	<div>
            	<label for="permissions">Permissions:</label>
                <select id="permissions" name="permissions">
                	<option value="1" <?php echo ($record['permissions'] == 1? 'selected="selected"' : ''); ?>>
                    	Visitor
                    </option>
                	<option value="2" <?php echo ($record['permissions'] == 2? 'selected="selected"' : ''); ?>>
                        Author
                    </option>
                	<option value="3" <?php echo ($record['permissions'] == 3? 'selected="selected"' : ''); ?>>
                        Editor
                    </option>
                	<option value="9" <?php echo ($record['permissions'] == 9? 'selected="selected"' : ''); ?>>
                        Sysadmin
                    </option>
                </select>
            </div>
            <div><input type="submit" value="Update >>" /></div>
        </form>
		<?php
	break; // showform
	
	case 'LIST':
		$query = "SELECT id, firstname, lastname, login, permissions FROM users";
		
		$result = $dbh->prepare($query);
		
		if (!$result->execute()) {
			// query error
			echo '<p>There was a problem executing the query.</p>';
		} else {
			
			echo '<table><thead><tr>' .
					'<th>ID</th>' .
					'<th>Name</th>' .
					'<th>Login</th>' .
					'<th>Permissions</th>' .
					'<th>Options</th>' .
					'</tr></thead><tbody>';
			
			/*
			while($row = $result->fetch()) {
				echo '<tr>' .
						'<td>'.$row['id'].'</td>' .
						'<td>'.$row['lastname'].', '.$row['firstname'].'</td>' .
						'<td>'.$row['login'].'</td>' .
						'<td>'.$row['permissions'].'</td>' .
					 '</tr>';
			}
			*/
			
			$data = $result->fetchAll();
			foreach ($data as $row) {
				echo '<tr>' .
						'<td>'.$row['id'].'</td>' .
						'<td>'.$row['lastname'].', '.$row['firstname'].'</td>' .
						'<td>'.$row['login'].'</td>' .
						'<td>'.$row['permissions'].'</td>' .
						'<td>' .
							'<a href="'.$_SERVER['PHP_SELF'].'?action=edit&id='.$row['id'].'">Edit</a> | ' .
							'<a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$row['id'].'">Delete</a>' .
						'</td>' .
					 '</tr>';
			}
			
			echo '</tbody></table>';
		}
	break; // LIST
	
	case 'DELETE':
		if (empty($id)) {
			echo '<p>Error: No id specified.</p>';
			break;
		}
		
		$query = "DELETE FROM users WHERE id = " . $dbh->quote($id);
		
		if (!$dbh->query($query)) {
			// query error
			$errorInfo = $dbh->errorInfo();
			echo "<p>There was an error in your query:<br />".
				 $errorInfo[2] . '<br />' .
				 "Query: $query </p>";
			break; // terminate case
		}
		
		echo '<p>The record was successfully deleted.</p>';
	break; // delete
	
} // switch




include('footer.php');
?>