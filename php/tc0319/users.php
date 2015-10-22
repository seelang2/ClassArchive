<?php
require_once("config.php");

if ( isset($_GET['mode']) && $_GET['mode'] != '' ) $mode = strtoupper($_GET['mode']); else $mode = 'LIST';

include("header.php");

?>
<p>
<a href="<?php echo $me; ?>?mode=showform">Add new user record</a> |
<a href="<?php echo $me; ?>?mode=list">List users</a>
</p>

<?php

switch($mode)
{
	case 'EDIT':
		if ( isset($_GET['id']) ) $id = escape($_GET['id']);
		
		$query = "SELECT firstname, lastname, email, login, password, permission FROM users WHERE id = $id";
		
		$result = mysql_query($query);
		if (!$result) {
			echo "<p>No record matching id.</p>";
		} else {
			$row = mysql_fetch_array($result);
			$formmode = "editprocess&id=$id";
		}

	case 'SHOWFORM':
		if (!isset($formmode)) $formmode = 'process';
?>
		<form action="<?php echo $me; ?>?mode=<?php echo $formmode; ?>" method="post">
			<table border="0" cellpadding="2" cellspacing="0">
			<tr><td>First Name: </td><td><input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" size="20" maxlength="20" /></td></tr>
			<tr><td>Last Name: </td><td><input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" size="20" maxlength="25" /></td></tr>
			<tr><td>Email: </td><td><input type="text" name="email" value="<?php echo $row['email']; ?>" size="30" maxlength="60" /></td></tr>
			<tr><td>Login ID: </td><td><input type="text" name="login" value="<?php echo $row['login']; ?>" size="20" maxlength="12" /></td></tr>
			<tr><td>Password: </td><td><input type="text" name="password" value="<?php echo $row['password']; ?>" size="20" maxlength="15" /></td></tr>
			<tr><td>Permission Level: </td><td><input type="text" name="permission" value="<?php echo $row['permission']; ?>" size="2" maxlength="2" /></td></tr>
			<tr><td colspan="2"><input type="submit" value="Enter New User" /></td></tr>
			</table>

		</form>

<?php 
	break;
	
	case 'EDITPROCESS':
		if ( isset($_GET['id']) ) $id = mysql_real_escape_string($_GET['id']);
	
	case 'PROCESS':
		if ( isset($_POST['firstname']) ) $firstname = mysql_real_escape_string($_POST['firstname']);
		if ( isset($_POST['lastname']) ) $lastname = mysql_real_escape_string($_POST['lastname']);
		if ( isset($_POST['email']) ) $email = mysql_real_escape_string($_POST['email']);
		if ( isset($_POST['login']) ) $login = mysql_real_escape_string($_POST['login']);
		if ( isset($_POST['password']) ) $password = mysql_real_escape_string($_POST['password']);
		if ( isset($_POST['permission']) ) $permission = mysql_real_escape_string($_POST['permission']);

		$create_date = date('Y-m-d');
		
		if (isset($id)) $query = "UPDATE"; else $query = "INSERT INTO";
		
		$query .= " users SET firstname = '$firstname'," .
				 " lastname = '$lastname'," .
				 " email = '$email'," .
				 " login = '$login'," .
				 " password = '$password'," .
				 " permission = '$permission'," .
				 " create_date = '$create_date'," .
				 " status = '1'";
		
		if (isset($id)) $query .= " WHERE id = $id";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// do your preferred error handling routine here
			echo '<p>Error creating new record.</p>';
			echo "<p>Query used: $query</p>";
		} else {
			// display happy success message
			echo '<p>Created new record in database.</p>';
		}
		
	break;
	
	case 'LIST':
	default:
	
		$query = "SELECT id, firstname, lastname, email, login, permission FROM users";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// do error checking
			echo "<p>Did something go wrong?</p>";
		
		} else {
			// process results
			
			echo "<table>" .
				 "<tr><td>ID</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Login</td><td>Permission</td><td>Options</td></tr>";
			while($row = mysql_fetch_array($result)) {
				echo "<tr>" . 
					 "<td>" . $row['id'] . "</td>" . 
					 "<td>" . $row['firstname'] . "</td>" . 
					 "<td>" . $row['lastname'] . "</td>" . 
					 "<td>" . $row['email'] . "</td>" . 
					 "<td>" . $row['login'] . "</td>" . 
					 "<td>" . $row['permission'] . "</td>" . 
					 "<td><a href='$me?mode=edit&id=" . $row['id'] . "'>Edit</a>&nbsp;" .
					 "<a href='$me?mode=delete&id=" . $row['id'] . "' onClick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>" .
					 "</tr>";
			}
			echo "</table>";
			
		}
		
		echo "<p><a href='export.php' target='_blank'>Click here to export this list as a CSV</a></p>";
	
	break;
	
	case 'DELETE':
		if ( isset($_GET['id']) ) $id = mysql_real_escape_string($_GET['id']);
		
		$query = "DELETE FROM users WHERE id = $id";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// something went wrong
			echo "<p>Error attempting to delete record from database.</p>";
			echo "<p>Query used was $query</p>";
		} else {
			echo "<p>Record was deleted successfully.</p>";
		}

	break;
	
} // switch


include("footer.php");
?>