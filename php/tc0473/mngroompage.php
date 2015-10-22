<?php
require_once 'config.php';

// additional template parameters can go here
$pageheading = 'Room Page Manager';
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
	if (isset($_POST['contact_id']) && $_POST['contact_id'] != '') 
		$contact_id = escape($_POST['contact_id']); 
	else $errmsg .= '<br />The contact id is not valid.';

	if (isset($_POST['content']) && $_POST['content'] != '') 
		$content = escape($_POST['content']); 
	else $errmsg .= '<br />The content may not be blank.';

	if ($errmsg != '') $validated = false;
	if (!$validated) {
		// display error message
		echo "<p>$errmsg</p>";
	} else {
		if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
		$query .= "roompages SET contact_id='$contact_id', content='$content'";
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
		$query = "SELECT id, contact_id, content FROM roompages WHERE id='$id'";
		
		if (!$result = mysql_query($query)) {
			// error
			echo "<p>Requested record could not be found.</p>";
		} else {
			$row = mysql_fetch_array($result);
		
		}
	
	case 'SHOWFORM':
	
		$query = 'SELECT id, firstname, lastname FROM contacts';
		if (!$results = mysql_query($query)) {
			// display error message
		} else {
			$contactSelect = '<select name="contact_id"><option value="">Please select a name</option>';
			
			while($temprow = mysql_fetch_array($results)) {
				$contactSelect .= '<option';
				if ($temprow[id] == $row['contact_id']) $contactSelect .= ' selected="selected"';
				$contactSelect .= ' value="' . $temprow[id] . '">' . $temprow['lastname'] . ', ' . $temprow['firstname'] . '</option>';
			}
			
			$contactSelect .= '</select>';
		}
	// display form
?>
<form action="<?php echo $me; ?>?mode=process<?php if (isset($id)) echo "&id=$id"; ?>" method="post">
<p>Contact: <?php echo $contactSelect; ?></p>
<p>Content:<br /> <textarea name="content" rows="10" cols="50"><?php echo $row['content']; ?></textarea></p>
<input type="submit" name="butSubmit" />
</form>
<?php
	break; // SHOWFORM

	case 'LIST':
		$query = 'SELECT roompages.id, content, firstname, lastname FROM roompages, contacts WHERE contact_id = contacts.id';
		
		$results = mysql_query($query);
		
		if (!$results) {
			// display error message
		
		} else if (mysql_num_rows($results) < 1) {
			echo "<p>No records in database.</p>";
		} else {
			// display results table
			
			echo '<table><tr><td>ID</td><td>Contact Name</td><td>Content</td><td colspan="2">Options</td></tr>';
			
			while($row = mysql_fetch_array($results)) {
				echo "<tr>" . 
					"<td>{$row['id']}</td>" . 
					"<td>{$row['lastname']}, {$row['firstname']}</td>" . 
					"<td>{$row['content']}</td>" .
					"<td><a href='$me?mode=edit&id={$row['id']}'>Edit</a></td>" .
					"<td><a href='$me?mode=delete&id={$row['id']}'>Delete</a></td>" .
					"</tr>";
			}
			
			echo '</table>';
		}
	
	break;
	
	case 'DELETE':
	$query = "DELETE FROM roompages WHERE id='$id'";
	
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