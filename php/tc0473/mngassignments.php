<?php
require_once 'config.php';

// additional template parameters can go here
$pagetitle = 'Assignment Manager Page';
$pageheading = 'Assignment Manager';
$page_extra_head_content = '';

//$showDefaultSubMenu = false;	

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
	if (isset($_POST['date_assigned']) && $_POST['date_assigned'] != '') 
		$date_assigned = escape($_POST['date_assigned']);
	else $errmsg .= '<br />The contact_id may not be blank.';

	if (isset($_POST['contact_id']) && $_POST['contact_id'] != '') 
		$contact_id = escape($_POST['contact_id']);
	else $errmsg .= '<br />The contact_id may not be blank.';

	if (isset($_POST['subject_id']) && $_POST['subject_id'] != '') 
		$subject_id = escape($_POST['subject_id']);
	else $errmsg .= '<br />The subject_id may not be blank.';

	if (isset($_POST['due_date']) && $_POST['due_date'] != '') 
		$due_date = escape($_POST['due_date']);
	else $errmsg .= '<br />The due_date may not be blank.';

	if (isset($_POST['assignment']) && $_POST['assignment'] != '') 
		$assignment = escape($_POST['assignment']);
	else $errmsg .= '<br />The assignment may not be blank.';

	if ($errmsg != '') $validated = false;
	if (!$validated) {
		// display error message
		echo "<p>$errmsg</p>";
	} else {
		if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
		$query .= "assignments SET " . 
				  "date_assigned='$date_assigned', " .
				  "contact_id='$contact_id', " .
				  "subject_id='$subject_id', " .
				  "due_date='$due_date', " .
				  "assignment='$assignment'";
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
		$query = "SELECT * FROM assignments WHERE id='$id'";
		
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

		$query = 'SELECT id, name FROM subjects';
		if (!$results = mysql_query($query)) {
			// display error message
		} else {
			$subjectSelect = '<select name="subject_id"><option value="">Please select a subject</option>';
			
			while($temprow = mysql_fetch_array($results)) {
				$subjectSelect .= '<option';
				if ($temprow[id] == $row['subject_id']) $subjectSelect .= ' selected="selected"';
				$subjectSelect .= ' value="' . $temprow[id] . '">' . $temprow['name'] . '</option>';
			}
			
			$subjectSelect .= '</select>';
		}

	// display form
?>
<form action="<?php echo $me; ?>?mode=process<?php if (isset($id)) echo "&id=$id"; ?>" method="post">
<div><label for="">Assignment Date:</label> <input type="text" name="date_assigned" value="<?php if (isset($row)) echo $row['date_assigned']; else echo date('Y-m-d'); ?>" /></div>
<div><label for="">Contact:</label> <?php echo $contactSelect; ?></div>
<div><label for="">Subject:</label> <?php echo $subjectSelect; ?></div>
<div><label for="">Date Due:</label> <input type="text" name="due_date" value="<?php if (isset($row)) echo $row['due_date']; else echo date('Y-m-d', time() + (60 * 60 *24)); ?>" /></div>
<div><label for="">Assignment:</label> <textarea name="assignment" rows="10" cols="35"><?php echo $row['assignment']; ?></textarea></div>
<input type="submit" name="butSubmit" />
</form>
<?php
	break; // SHOWFORM

	case 'LIST':
		$query = 'SELECT assignments.id, date_assigned, due_date, assignment, firstname, lastname, name FROM assignments, contacts, subjects WHERE contact_id = contacts.id AND subject_id = subjects.id ORDER BY date_assigned ASC';
		
		echo "\n<!-- $query -->\n";
		$results = mysql_query($query);
		
		if (!$results) {
			// display error message
			echo "<p>Error running query $query<br />MySQL Error: " . mysql_error() . '</p>';
		} else if (mysql_num_rows($results) < 1) {
			echo "<p>No records in database.</p>";
		} else {
			// display results table
			
			echo '<table><tr><td>ID</td><td>Contact</td><td>Date</td><td>Subject</td><td>Due Date</td><td>Assignment</td><td colspan="2">Options</td></tr>';
			
			while($row = mysql_fetch_array($results)) {
				echo "<tr>" . 
					"<td>{$row['id']}</td>" . 
					"<td>{$row['lastname']}, {$row['firstname']}</td>" .
					"<td>{$row['date_assigned']}</td>" .
					"<td>{$row['name']}</td>" .
					"<td>{$row['due_date']}</td>" .
					"<td>{$row['assignment']}</td>" .
					"<td><a href='$me?mode=edit&id={$row['id']}'>Edit</a></td>" .
					"<td><a href='$me?mode=delete&id={$row['id']}'>Delete</a></td>" .
					"</tr>";
			}
			
			echo '</table>';
		}
	
	break;
	
	case 'DELETE':
	$query = "DELETE FROM assignments WHERE id='$id'";
	
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