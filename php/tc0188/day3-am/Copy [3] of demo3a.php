<?php


$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!dbcnx) { 
	echo '<p>Unable to connect to the database server at this time.</p>';
	exit();
}


if (!@mysql_select_db('demo1')) {
	exit('<p>Unable to locate the database at this time.</p>');
}

// echo '<p>Successfully connected to the database!</p>';


$me = $_SERVER['PHP_SELF'];

$validated = true;

$mode = 'LIST';
if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = strtoupper($_GET['mode']);

switch($mode)
{

case 'ADDPROCESS':
	// validate data and process
	
	if (isset($_POST['name']) && $_POST['name'] != '') $name = $_POST['name']; else $validated = false;
	if (isset($_POST['email']) && $_POST['email'] != '') $email = $_POST['email']; else $validated = false;
	if (isset($_POST['password']) && $_POST['password'] != '') $password = $_POST['password']; else $validated = false;
	
	if (!$validated) {
		// display error message and allow user to go back
		echo "<p><strong>Error: </strong>One or more fields in the form is blank. None of the form fields may be blank."
			. " Please go back and enter in all required information.</p>";
			
	} else {
		// NOW process form data
		$query = "INSERT INTO users SET name = '$name', email = '$email', password = '$password'";
		
		$result = @mysql_query($query);
		
		if (!$result)  echo '<p><strong>Error: </strong>Error performing query: ' . mysql_error() . "<br />Query: $query" . '</p>';
		else echo "<p>Record successfully added to database table.</p>";
	}
break;

case 'ADDFORM':
	// display data entry form

?>

<form action="<?php echo $me; ?>?mode=addprocess" method="post">
	<p>
	First Name: <input type="text" name="name" /><br />
	Email: <input type="text" name="email" maxlength="60" /><br />
	Password: <input type="password" name="password" /><br />
	<input type="submit" value="Enter New User" />
	</p>
</form>

<?php

break;

case 'EDITFORM':

	if (isset($_GET['id']) && $_GET['id'] != '') $id = $_GET['id']; 
	else {
		echo "<p><strong>Error: </strong>ID parameter is missing or invalid.</p>";
		break;
	}

	$query = "SELECT id, name, email, password FROM users WHERE id = '$id' LIMIT 1";
	
	$result = @mysql_query($query);
	if (!$result) {
		echo "<p><strong>Error: </strong>Specified record does not exist in database.</p>";
		break;
	}
	
	$row = mysql_fetch_array($result);

?>

<form action="<?php echo $me; ?>?mode=editprocess" method="post">
	<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	<p>
	First Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" /><br />
	Email: <input type="text" name="email" maxlength="60" value="<?php echo $row['email']; ?>" /><br />
	Password: <input type="password" name="password" value="<?php echo $row['password']; ?>" /><br />
	<input type="submit" value="Edit User" />
	</p>
</form>

<?php

break;

case 'EDITPROCESS':
	if (isset($_POST['id']) && $_POST['id'] != '') $id = $_POST['id'];  else $validated = false;
	if (isset($_POST['name']) && $_POST['name'] != '') $name = $_POST['name'];  else $validated = false;
	if (isset($_POST['email']) && $_POST['email'] != '') $email = $_POST['email'];  else $validated = false;
	if (isset($_POST['password']) && $_POST['password'] != '') $password = $_POST['password'];  else $validated = false;
	
	if (!$validated) {
		// display error message and stop processing
		echo "<p><strong>Error: </strong>Blank fields are not allowed. Please go back and enter appropriate values.</p>";
		break;
	} else {
		// continue update
		$query = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
		
		echo "<p>Query: $query</p>";
		
		$result = @mysql_query($query);
		
		if (!$result)  echo '<p><strong>Error: </strong>Error performing query: ' . mysql_error() . "<br />Query: $query" . '</p>';
		else echo "<p>Record successfully edited in database table.</p>";
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
	
	if (!$result) echo '<p>No rows present.</p>';
	else {
		echo '<table>';
		while ($row = mysql_fetch_array($result)) {
			// display row

			echo '<tr>' . 
				'<td>' . $row['id'] . '</td>' . 
				'<td>' . $row['name'] . '</td>' .
				'<td>' . $row['email'] . '</td>' .
				'<td>' . $row['password'] . '</td>' .
				'<td>' . '<a href="' . $me . '?mode=editform&id=' . $row['id'] . '">Edit</a>' . '</td>' .
				'<td>'  ?><form action="<?php echo $me; ?>?mode=delete&id=<?php echo $row['id']; ?>" method="post">
					<input type="submit" value="Delete" /></form><?php  '</td>' .
				'</tr>' . "\n";

//			echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['password']}</td></tr>";
		}
		echo '</table>';
	}
break;

} // switch

?>



<p><a href="<?php echo $me; ?>?mode=addform">Add new entry</a></p>
<p><a href="<?php echo $me; ?>?mode=list">List entry</a></p>
