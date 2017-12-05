<?php
require_once 'config.php';

// additional template parameters can go here
$pageheading = 'Contact Manager';

include 'header1.php';

?>

<?php

$mode = 'LIST'; // sets default case
if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = strtoupper($_GET['mode']);
if (isset($_GET['id']) && $_GET['id'] != '') $id = escape($_GET['id']);

switch($mode)
{
	case 'PROCESS':
	// process form
	$validated = true;
	$errmsg = '';
	
	// validation rules
	if (isset($_POST['firstname']) && $_POST['firstname'] != '') 
		$firstname = escape($_POST['firstname']); 
	else $errmsg .= '<br />The first name may not be blank.';

	if (isset($_POST['lastname']) && $_POST['lastname'] != '') 
		$lastname = escape($_POST['lastname']); 
	else $errmsg .= '<br />The last name may not be blank.';

	if (isset($_POST['login']) && $_POST['login'] != '') 
		$login = escape($_POST['login']); 
	else $errmsg .= '<br />The login may not be blank.';

	if (isset($_POST['phone']) && $_POST['phone'] != '') 
		$phone = escape($_POST['phone']);

	if (isset($_POST['email']) && $_POST['email'] != '') 
		$email = escape($_POST['email']);

	if (isset($_POST['room']) && $_POST['room'] != '') 
		$room = escape($_POST['room']);

	if (isset($_POST['password']) && $_POST['password'] != '') 
		$password = escape($_POST['password']);

	if ($errmsg != '') $validated = false;
	if (!$validated) {
		// display error message
		echo "<p>$errmsg</p>";
	} else {
		if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
		$query .= "contacts SET " . 
				  "firstname='$firstname', " .
				  "lastname='$lastname', " .
				  "phone='$phone', " .
				  "email='$email', " .
				  "room='$room', " .
				  "login='$login', " .
				  "password='$password'";
		if (isset($id)) $query .= " WHERE id='$id'";
		
		$result = mysql_query($query);
		
		if (!$result) {
			// display error message
			echo "<p>Error entering record into database. Query used:<br />$query</p>";
		} else {
			// display success message
			echo "<p>Successfully entered record into database.</p>";
		}
	} // if validated
	break;
	
	case 'EDIT':
		$query = "SELECT * FROM contacts WHERE id='$id'";
		
		if (!$result = mysql_query($query)) {
			// error
			echo "<p>Requested record could not be found.</p>";
		} else {
			$row = mysql_fetch_array($result);
		
		}
	
	case 'SHOWFORM':
	// display form
?>
<form action="<?php echo $me; ?>?mode=process<?php if (isset($id)) echo "&id=$id"; ?>" method="post">
<div><label for="">First Name:</label> <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" /></div>
<div><label for="">Last Name:</label> <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" /></div>
<div><label for="">Email:</label> <input type="text" name="email" value="<?php echo $row['email']; ?>" /></div>
<div><label for="">Phone:</label> <input type="text" name="phone" value="<?php echo $row['phone']; ?>" /></div>
<div><label for="">Room:</label> <input type="text" name="room" value="<?php echo $row['room']; ?>" /></div>
<div><label for="">Login:</label> <input type="text" name="login" value="<?php echo $row['login']; ?>" /></div>
<div><label for="">Password:</label> <input type="text" name="password" value="<?php echo $row['password']; ?>" /></div>
<input type="submit" name="butSubmit" />
</form>
<?php
	break; // SHOWFORM

	case 'LIST':
		$query = 'SELECT id, firstname, lastname, room FROM contacts ORDER BY lastname ASC, firstname ASC';
		
		echo "\n<!-- $query -->\n";
		$results = mysql_query($query);
		
		if (!$results) {
			// display error message
			echo "<p>Error running query $query<br />MySQL Error: " . mysql_error() . '</p>';
		} else if (mysql_num_rows($results) < 1) {
			echo "<p>No records in database.</p>";
		} else {
			// display results table
			
			echo '<table><tr><td>ID</td><td>Name</td><td>Room</td><td colspan="2">Options</td></tr>';
			
			while($row = mysql_fetch_array($results)) {
				echo "<tr>" . 
					"<td>{$row['id']}</td>" . 
					"<td>{$row['lastname']}, {$row['firstname']}</td>" . 
					"<td>{$row['room']}</td>" .
					"<td><a href='$me?mode=edit&id={$row['id']}'>Edit</a></td>" .
					"<td><a href='$me?mode=delete&id={$row['id']}'>Delete</a></td>" .
					"</tr>";
			}
			
			echo '</table>';
		}
	
	break;
	
	case 'DELETE':
	$query = "DELETE FROM contacts WHERE id='$id'";
	
	$result = mysql_query($query);
	
	if (!$result) {
		// display error message
		echo "<p>Error deleting record into database. Query used:<br />$query</p>";
	} else {
		// display success message
		echo "<p>Successfully deleted record into database.</p>";
	}
	break;
	
} // switch $mode
?>

<?php include 'footer1.php'; ?>