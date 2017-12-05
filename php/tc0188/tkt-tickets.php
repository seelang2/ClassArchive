<?php 
$page_permission = 0;
require_once "tkt-config.php";

// page-specific configuration
$pagetitle = "Ticket System - Demo";

include TEMPLATE_HEADER; 

?>
<h2>Manage My Tickets</h2>
<div id="submenu">
	<a href="<?php echo $me; ?>?mode=list">List My Tickets</a> | 
	<a href="<?php echo $me; ?>?mode=addform">Enter a New Ticket</a>
</div>

<div><p><span class="statusmessage"><?php echo $statusmsg; ?></span></p></div>

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

	$query = "SELECT id, owner_id, subject, support_type_id, status FROM tickets WHERE id = '$id' LIMIT 1";
	
	$result = @mysql_query($query);
	if (!$result) {
		echo "<p><strong>Error: </strong>Specified record does not exist in database.</p>";
		break;
	}
	
	$row = mysql_fetch_array($result);
	
	$buttontext = "Edit User Record";


case 'ADDFORM':
	// display data entry form

	if ($buttontext == '') $buttontext = "Add New Ticket Record";

?>

<div style="margin:0 auto; width:80%;">

<form action="<?php echo $me; ?>?mode=processform" method="post">
	<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	<input type="hidden" name="owner_id" value="<?php echo $_SESSION['UID']; ?>" />

	<p>Support Type:<br />
	<select name="support_type_id">
<?php
	$query = "SELECT id, name FROM support_types";
	$result = @mysql_query($query);
	
	while ($tmp = @mysql_fetch_array($result)) {
		echo '<option value="' . $tmp['id'] . '"' . 
		( $tmp['id'] == $row['support_type_id'] ? ' selected="selected"' : '' ) . 
		'>' . $tmp['name'] . '</option>';
	}

?>
	</select></p>

	<p>Ticket Status:<br />
	<select name="status">
<?php
	for($c = 0; $c < count($tkt_status) ; $c++) {
		echo '<option value="' . $c . '"' . 
		( $c == $row['status'] ? ' selected="selected"' : '' ) . 
		'>' . $tkt_status[$c] . '</option>';
	}
?>	
	</select></p>

	<p>Ticket Details:<br />
	<textarea name="subject" cols="70" rows="10"><?php echo $row['subject']; ?></textarea>
	</p>
	
	<p>
	<input type="submit" value="<?php echo $buttontext; ?>" />
	</p>
</form>

</div>

<?php

break;

case 'PROCESSFORM':
	if (isset($_POST['id']) && $_POST['id'] != '') $id = escape($_POST['id']); else $id = '';
	if (isset($_POST['owner_id']) && $_POST['owner_id'] != '') $owner_id = escape($_POST['owner_id']); else $validated = false;
	if (isset($_POST['subject']) && $_POST['subject'] != '') $subject = escape($_POST['subject']); else $validated = false;
	if (isset($_POST['support_type_id']) && $_POST['support_type_id'] != '') $support_type_id = escape($_POST['support_type_id']); else $validated = false;
	if (isset($_POST['status']) && $_POST['status'] != '') $status = escape($_POST['status']); else $status = 0;
	
	if (!$validated) {
		// display error message and allow user to go back
		echo "<p><strong>Error: </strong>One or more fields in the form is blank. None of the form fields may be blank."
			. " Please go back and enter in all required information.</p>";
			
	} else {
		// NOW process form data
		if ($id == '') $query = "INSERT INTO "; else $query = "UPDATE ";
		
		$query .= "tickets SET owner_id = '$owner_id', subject = '$subject', support_type_id = '$support_type_id', status = '$status'";
		
		if ($id != '') $query .= " WHERE id = '$id'"; 
		
		$result = @mysql_query($query);
		
		if (!$result)  echo '<p><strong>Error: </strong>Error performing query: ' . mysql_error() . "<br />Query: $query" . '</p>';
		else echo "<p>Record successfully " . ( $id == '' ? "added to" : "edited in" ) . " database table.<br />Query: $query.</p>";
	}

break;

case 'DELETE':
	if (isset($_GET['id']) && $_GET['id'] != '') $id = $_GET['id'];  else $validated = false;

	if (!$validated) {
		// display error message and stop processing
		echo "<p><strong>Error: </strong>Invalid record ID.</p>";
		break;
	} else {
		
		$query = "DELETE FROM tickets WHERE id = '$id'";
		
		if (!@mysql_query($query)) echo '<p><strong>Error: </strong>Error performing query: ' . mysql_error() . 
		"<br />Query: $query" . '</p>';
		else echo "<p>Record successfully deleted from database table.</p>";
		
	}
	
break;

case 'LIST':
	$query = "SELECT t.id, left(subject, 20) AS subject, s.name, status FROM tickets AS T, support_types AS S WHERE support_type_id = s.id";
	
	$result = @mysql_query($query);
	
	if (!mysql_num_rows($result)) echo '<p>No rows present.</p>';
	else {
		echo '<table class="list">' . 
			'<tr><td>ID</td><td>Subject</td><td>Support Type</td><td>Status</td><td colspan="2">Options</td></tr>';
		while ($row = mysql_fetch_array($result)) {
			// display row

			echo '<tr>' . 
				'<td>' . $row['id'] . '</td>' . 
				'<td>' . $row['subject'] . '... </td>' .
				'<td>' . $row['name'] . '</td>' .
				'<td>' . $tkt_status[$row['status']] . '</td>' .
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