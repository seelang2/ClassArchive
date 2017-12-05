<?php
require_once('config.php');

include(TEMPLATE_HEADER);

$mode = 'LIST';
if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']);
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);

//if (!empty($_POST['butSubmit'])) $mode = 'PROCESSADD';

?>

<p>
<a href="<?php echo $_SERVER['PHP_SELF'] . '?mode=showform'; ?>">Add new record</a> | 
<a href="<?php echo $_SERVER['PHP_SELF'] . '?mode=list'; ?>">List records</a>
</p>

<?php


switch($mode)
{
	case 'PROCESSADD':
		
		// check for form data
		if (empty($_POST['butSubmit'])) {
			// no form data present
			echo '<p>No form data present. Invalid access. No soup for you!</p>';
		} else {
			// continue with process
			
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$type = $_POST['type'];
			
			$query = "INSERT INTO users SET " .
					 "firstname = '" . $firstname . "', " .
					 "lastname = '" . $lastname . "', " .
					 "email = '" . $email . "', " .
					 "password = '" . $password . "', " .
					 "type = '" . $type . "' ";
			
			// echo '<p>' . $query . '</p>'; // just for testing
			
			$result = mysql_query($query);
			
			if (!$result) {
				// query error
				echo "<p>Error performing query: <br />Query: $query</p>";
			} else {
				// success
				echo '<p>Record successfully added to database</p>';
			}
			
		}
		
	break; //processadd
	
	
	case 'EDIT':
	
		$query = "SELECT firstname, lastname, email, password, type FROM users WHERE id='$id'";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// query error
			echo "<p>Error performing query: <br />Query: $query</p>";
		} else {
			// query ok, continue
			if (mysql_num_rows($result) != 1) {
				// error
				echo '<p>No records (or too many) found</p>';
			} else {
				// record found
				$user = mysql_fetch_array($result);
			
			} // if num_rows
			
			
		} // if result
			
	
	case 'SHOWFORM':
		
?>
	
	<h2>Add Record</h2>
	
	<form action="<?php echo $_SERVER['PHP_SELF'] . '?mode=processadd'; ?>" method="post">
		<p>First Name: <input type="text" name="firstname" /></p>
		<p>Last Name: <input type="text" name="lastname" /></p>
		<p>Email: <input type="text" name="email" /></p>
		<p>Password: <input type="text" name="password" /></p>
		<p>Type: <input type="text" name="type" /></p>
		<input type="submit" name="butSubmit" value="Continue" />
	</form>


<?php
	
	break; // showform
	
	default:
	case 'LIST':
		
		$query = "SELECT id, firstname, lastname, email, type FROM users";
		
		$results = mysql_query($query);
		
		if (!$results) {
			// query error
			echo "<p>Error performing query: <br />Query: $query</p>";
		} else {
			// query ok, continue
			
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo '<p>No rows present.</p>';
			} else {
				
				echo '<table border="0" cellpadding="3" cellspacing="0">';
				echo '<tr>' .
					 	'<th>ID</th>' . 
					 	'<th>Name</th>' . 
					 	'<th>Email</th>' . 
					 	'<th>Type</th>' . 
					 	'<th>options</th>' . 
					 '</tr>';
				
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
							'<td>' . $row['id'] . '</td>' .
							'<td>' . $row['lastname'] . ', ' . $row['firstname'] . '</td>' .
							'<td>' . $row['email'] . '</td>' .
							'<td>' . $row['type'] . '</td>' .
							'<td>' .
								'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a>' .
							'</td>'.
						 '</tr>';
				}
				
				echo '</table>';
				
				
			} // if num rows
		} // if results
		
		
	break; // list



} // switch


include(TEMPLATE_FOOTER);
?>
