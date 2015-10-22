<?php
require_once 'config.php';

?>
<p>
	<a href="<?php echo $me; ?>?mode=list">List Records</a>&nbsp;|&nbsp;
	<a href="<?php echo $me; ?>?mode=showform">Add New Record</a>
</p>
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
	if (isset($_POST['name']) && $_POST['name'] != '') 
		$name = escape($_POST['name']); 
	else $errmsg .= '<br />The subject name may not be blank.';

	if (isset($_POST['description']) && $_POST['description'] != '') 
		$description = escape($_POST['description']);

	if ($errmsg != '') $validated = false;
	if (!$validated) {
		// display error message
		echo "<p>$errmsg</p>";
	} else {
		if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
		$query .= "subjects SET name='$name', description='$description'";
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
		$query = "SELECT id, name, description FROM subjects WHERE id='$id'";
		
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
<p>Subject Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" /></p>
<p>Description: <input type="text" name="description" value="<?php echo $row['description']; ?>" /></p>
<input type="submit" name="butSubmit" />
</form>
<?php
	break; // SHOWFORM

	case 'LIST':
		$query = 'SELECT id, name, description FROM subjects ORDER BY name ASC';
		
		$results = mysql_query($query);
		
		if (!$results) {
			// display error message
		
		} else if (mysql_num_rows($results) < 1) {
			echo "<p>No records in database.</p>";
		} else {
			// display results table
			
			echo '<table><tr><td>ID</td><td>Subject Name</td><td>Description</td><td colspan="2">Options</td></tr>';
			
			while($row = mysql_fetch_array($results)) {
				echo "<tr>" . 
					"<td>{$row['id']}</td>" . 
					"<td>{$row['name']}</td>" . 
					"<td>{$row['description']}</td>" .
					"<td><a href='$me?mode=edit&id={$row['id']}'>Edit</a></td>" .
					"<td><a href='$me?mode=delete&id={$row['id']}'>Delete</a></td>" .
					"</tr>";
			}
			
			echo '</table>';
		}
	
	break;
	
	case 'DELETE':
	$query = "DELETE FROM subjects WHERE id='$id'";
	
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
