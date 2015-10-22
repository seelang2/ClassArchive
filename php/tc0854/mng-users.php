<?php
require_once('config.php');

include('header.php');
?>

<?php


$mode = 'LIST';

if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']); 

if (!empty($_GET['id'])) $id = mysql_escape_string($_GET['id']); else unset($id);

switch($mode)
{
	// process record edit
	case 'PROCESSEDIT':
		if (empty($id)) {
			// id not present, display error and break out
			echo 'Error: ID value missing.';
			break;
		}
	
	// process add from form
	case 'PROCESSADD':
		// check to see if form submitted
		if (!empty($_POST['butSubmit'])) {
			
			// basic validation
			$validated = true;
			$errmsg = '';
			
			// check that firstname ha a value
			if (empty($_POST['firstname'])) {
				$validated = false;
				$errmsg .= '<br />The First Name field cannot be blank.';
			}
			
			// check that lastname ha a value
			if (empty($_POST['lastname'])) {
				$validated = false;
				$errmsg .= '<br />The Last Name field cannot be blank.';
			}
			
			// check that email ha a value
			if (empty($_POST['email'])) {
				$validated = false;
				$errmsg .= '<br />The Email field cannot be blank.';
			}
			
			// check that password ha a value
			if (empty($_POST['password'])) {
				$validated = false;
				$errmsg .= '<br />The Password field cannot be blank.';
			}
			
			// check that login ha a value
			if (empty($_POST['login'])) {
				$validated = false;
				$errmsg .= '<br />The Login field cannot be blank.';
			}
			
			if ($validated) {
				if (empty($id)) $query = "INSERT INTO "; else $query = "UPDATE ";
				
				$query .= "users SET " . 
						  "firstname='" . mysql_escape_string($_POST['firstname']) . "', " .
						  "lastname='" . mysql_escape_string($_POST['lastname']) . "', " .
						  "email='" . mysql_escape_string($_POST['email']) . "', " .
						  "password='" . mysql_escape_string($_POST['password']) . "', " .
						  "login='" . mysql_escape_string($_POST['login']) . "'";
				
				// $query = "INSERT INTO users SET name='{$_POST['name']}'"; <-- avoid using
				
				if (!empty($id)) $query .= " WHERE id='$id'";
				
				$result = @mysql_query($query);
				
				if (!$result) {
					// query error
					echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
				} else {
					// successfull add
					echo '<p>The database was successfully updated. Query: ' . $query . '</p>';
				
				} // if result
			} else {
				// form data not validated, display error message
				echo '<p>The following errors have been encountered: ' . $errmsg . '<br />Please go back and try again.</p>';
			}
		} // if butSubmit
	
	break; // processadd
	
	
	// edit record
	case 'EDIT':
		if (!empty($id)) {
		
			$query = "SELECT firstname, lastname, email, password, login FROM users WHERE id='$id' LIMIT 1";
			
			$result = @mysql_query($query);
			if (!$result || mysql_num_rows($result) != 1) {
				// query error or no record found -display error
				echo 'Query error or no record found - no soup for you';
			} else {
				$row = mysql_fetch_array($result);
				$querystring = '?mode=processedit&id=' . $id;
			} // if result
		} // if empty id
	
	// display form
	case 'ADD':
		if (empty($querystring)) $querystring = '?mode=processadd';
?>		
		<form action="<?php echo $_SERVER['PHP_SELF'] . $querystring; ?>" method="post">
			<div><label for="firstname">First Name:</label><input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" size="50" /></div>
			<div><label for="lastname">Last Name:</label><input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" size="50" /></div>
			<div><label for="email">Email:</label><input type="text" name="email" value="<?php echo $row['email']; ?>" size="50" /></div>
			<div><label for="password">Password:</label><input type="text" name="password" value="<?php echo $row['password']; ?>" size="50" /></div>
			<div><label for="login">Login:</label><input type="text" name="login" value="<?php echo $row['login']; ?>" size="50" /></div>
			<div><input type="submit" name="butSubmit" value="Save Record" /></div>
		</form>
	
<?php	
	break; // add
	
	// list (read) records
	case 'LIST':
		// built query
		$query = "SELECT id, firstname, lastname, email, password, login FROM users";
		
		// send query to db
		$results = @mysql_query($query);
		
		// check response
		
		if (!$results) {
			// query error - display message
			echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
		} else {
			if (mysql_num_rows($results) < 1) {
				// no results returned
				echo '<p>No rows present.</p>';
			} else {
				// process results
				echo '<table border="0" cellpadding="3" cellspacing="0">' .
					 '<tr><th>ID</th><th>Name</th><th>Options</th>';

				while ($row = mysql_fetch_array($results)) {
					echo "<tr>" .
							"<td>" . $row['id'] . "</td>" .
							"<td>" . $row['firstname'] . "</td>" .
							"<td>" . $row['lastname'] . "</td>" .
							"<td>" . $row['email'] . "</td>" .
							"<td>" . $row['password'] . "</td>" .
							"<td>" . $row['login'] . "</td>" .
							"<td>" .
								'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a> | ' . 
								'<a href="' . $_SERVER['PHP_SELF'] . '?mode=delete&id=' . $row['id'] . '">Delete</a>' . 
							"</td>" .
						 "</tr>";
				}
				
				echo '</table>';

			} // if num rows
		} // if result
	break;

	// delete record
	case 'DELETE':
		if (empty($id)) {
			// id not present, display error and break out
			echo 'Error: ID value missing.';
			break;
		}
		
		$query = "DELETE FROM users WHERE id='$id'";
		
		if (!$result = @mysql_query($query)) {
			// error
			echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
		} else {
			// success
			echo '<p>The database was successfully updated. Query: ' . $query . '</p>';
		}
	break;

} // switch




include('footer.php');
?>