<?php 
require_once "tkt-config.php";

// page-specific configuration
$pagetitle = "Ticket System - Manage Users";

include TEMPLATE_HEADER; 

?>
<h2>Manage Users</h2>
<div id="submenu">
	<a href="tkt-users.php?mode=addform">Add new user</a> | 
	<a href="tkt-users.php?mode=list">List users</a>
</div>
<?php

$validated = true;
$buttontext = '';

$mode = 'LIST';
if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = strtoupper($_GET['mode']);

switch($mode)
{

case 'EDITFORM':

	if (isset($_GET['id']) && $_GET['id'] != '') $id = $_GET['id']; 
	else {
		echo "<p><strong>Error: </strong>ID parameter is missing or invalid.</p>";
		break;
	}

	$query = "SELECT id, name, email, password, permissions FROM users WHERE id = '$id' LIMIT 1";
	
	$result = @mysql_query($query);
	if (!$result) {
		echo "<p><strong>Error: </strong>Specified record does not exist in database.</p>";
		break;
	}
	
	$row = mysql_fetch_array($result);
	
	$buttontext = "Edit User Record";


case 'ADDFORM':
	// display data entry form

	if ($buttontext == '') $buttontext = "Add New User Record";

?>

<form action="<?php echo $me; ?>?mode=processform" method="post">
	<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	<p>
	First Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" /><br />
	Email: <input type="text" name="email" maxlength="60" value="<?php echo $row['email']; ?>" /><br />
	Password: <input type="password" name="password" value="<?php echo $row['password']; ?>" /><br />
	Permissions: <input type="text" name="permissions" value="<?php echo $row['permissions']; ?>" /><br />
	<input type="submit" value="<?php echo $buttontext; ?>" />
	</p>
</form>

<?php

break;

case 'PROCESSFORM':
	if (isset($_POST['id']) && $_POST['id'] != '') $id = $_POST['id']; else $id = '';
	if (isset($_POST['name']) && $_POST['name'] != '') $name = $_POST['name']; else $validated = false;
	if (isset($_POST['email']) && $_POST['email'] != '') $email = $_POST['email']; else $validated = false;
	if (isset($_POST['password']) && $_POST['password'] != '') $password = $_POST['password']; else $validated = false;
	if (isset($_POST['permissions']) && $_POST['permissions'] != '') $permissions = $_POST['permissions']; else $permissions = 1;
	
	if (!$validated) {
		// display error message and allow user to go back
		echo "<p><strong>Error: </strong>One or more fields in the form is blank. None of the form fields may be blank."
			. " Please go back and enter in all required information.</p>";
			
	} else {
		// NOW process form data
		if ($id == '') $query = "INSERT INTO "; else $query = "UPDATE ";
		
		$query .= "users SET name = '$name', email = '$email', password = '$password', permissions = '$permissions'";
		
		if ($id != '') $query .= " WHERE id = '$id'"; 
		
		$result = @mysql_query($query);
		
		if (!$result)  echo '<p><strong>Error: </strong>Error performing query: ' . mysql_error() . "<br />Query: $query" . '</p>';
		else echo "<p>Record successfully " . ( $id == '' ? "added to" : "edited in" ) . " database table.</p>";
	}

break;

case 'DELETE':
	if (isset($_GET['id']) && $_GET['id'] != '') $id = $_GET['id'];  else $validated = false;

	if (!$validated) {
		// display error message and stop processing
		echo "<p><strong>Error: </strong>Invalid record ID.</p>";
		break;
	} else {
		
		$query = "DELETE FROM users WHERE id = '$id'";
		
		if (!@mysql_query($query)) echo '<p><strong>Error: </strong>Error performing query: ' . mysql_error() . 
		"<br />Query: $query" . '</p>';
		else echo "<p>Record successfully deleted from database table.</p>";
		
	}
	
break;

case 'LIST':
	$query = "SELECT * FROM users";
	
	$result = @mysql_query($query);
	
	if (!mysql_num_rows($result)) echo '<p>No rows present.</p>';
	else {
		echo '<table class="list">' . 
			'<tr><td>ID</td><td>Name</td><td>Email</td><td>Password</td><td>Permission</td><td colspan="2">Options</td></tr>';
		while ($row = mysql_fetch_array($result)) {
			// display row

			echo '<tr>' . 
				'<td>' . $row['id'] . '</td>' . 
				'<td>' . $row['name'] . '</td>' .
				'<td>' . $row['email'] . '</td>' .
				'<td>' . $row['password'] . '</td>' .
				'<td>' . $row['permissions'] . '</td>' .
				'<td>' . '<a href="' . $me . '?mode=editform&id=' . $row['id'] . '"><img src="b_edit.png" alt="Edit Record" /></a>' . '</td>' .
				'<td>'  ?><form action="<?php echo $me; ?>?mode=delete&id=<?php echo $row['id']; ?>" method="post">
					<input type="image" src="b_drop.png" alt="Delete Record" value="Delete" /></form><?php  '</td>' .
				'</tr>' . "\n";

//			echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['password']}</td></tr>";
		}
		echo '</table>';
	}
break;

} // switch

?>

<?php include TEMPLATE_FOOTER; ?>