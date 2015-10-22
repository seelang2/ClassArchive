<?php

require 'config.php';

include 'header.php';

/*
$dbcnx = mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) { 
	die('Error Connecting to database server');
}

$dbh = mysql_select_db('tc708');

if (!$dbh) {
	die('Error selecting database.');
}
*/

if (!$dbh = db_connect(DBNAME, DBUSER, DBPASSWORD)) {
	die("Error connecting to database or server.");
}


$mode = 'LIST';

if (isset($_GET['mode']) && !empty($_GET['mode'])) {	 $mode = strtoupper($_GET['mode']); }
if (isset($_GET['id']) && !empty($_GET['id'])) {	 $id = strtoupper($_GET['id']); }



switch($mode)
{
	
	case 'DOEDIT':
		if (empty($id)) {
			// no id present
			echo "<p>Invalid ID specified.</p>";
			break;
		} else {
			// continue
			$query = "SELECT statusname FROM relationships WHERE id = '$id'";
			
			if (!$result = mysql_query($query)) {
				// error with query
				echo "<p>Error performing query:<br />$query</p>";
			} else {
				if (mysql_num_rows($result) != 1) {
					// no rows or too many rows(?)
					echo "<p>The record could not be found. ($id)</p>";
				} else {
					// now proceed and finish
					$row = mysql_fetch_array($result);
					$newmode = "edit&id=$id";
				}
			}
		}
		
	case 'DOFORM':
		if (empty($newmode)) {
			$newmode = "add";
		}
	
?>
	<form action="mng_relationships.php?mode=<?php echo $newmode; ?>" method="post">
		<div>Status Name: <input name="statusname" type="text" size="25" maxlength="25" value="<?php echo $row['statusname']; ?>" /></div>
		<div><input name="butSubmit" type="submit" value="Enter new record" /></div>
	</form>
<?php
	break;
	
	case 'EDIT':
		
	
	case 'ADD':
		$statusname = escape($_POST['statusname']);
		
		if (!empty($id)) {
			$query = 'UPDATE';
		} else {
			$query = 'INSERT INTO';
		}
		
		$query .= " relationships SET statusname='$statusname'";
		
		if (!empty($id)) {
			$query .= " WHERE id = '$id'";
		}
		
		$result = mysql_query($query);
		
		if (!$result) {
			// we have an error
			echo "<p>Error performing query:<br />$query</p>";
		} else {
			// success
			echo "<p>Database updated.</p>";	
		}	
	
	
	break;

	case 'LIST':
	default:
	
		$query = "SELECT id, statusname FROM relationships";
		
		$results = mysql_query($query);
		
		if (!$results) {
			// error with query
			echo "<p>Error performing query:<br />$query</p>";
		} else {
			// query ok, proceed
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo "<p>No rows present.</p>";
			} else {
				// process data set
				echo "<table>";
				echo "<tr><td>ID</td><td>Status Name</td><td>Options (<a href='mng_relationships.php?mode=doform'>Add New Record</a>)</td></tr>";
				
				while($row = mysql_fetch_array($results)) {
					echo "<tr><td>" . $row['id'] . "</td>" .
						"<td>" . $row['statusname'] . "</td>" .
						
						"<td>" . 
						"<a href='mng_relationships.php?mode=doedit&id=" . $row['id'] . "'>Edit</a>" . '&nbsp;|&nbsp;' . 
						"<a href='mng_relationships.php?mode=delete&id=" . $row['id'] . "'>Delete</a>" . 
						"</td>" .
						"</tr>";
				}
				
				echo "</table>";
			
			}
		} // if results
	
	
	break;
	
	case 'DELETE':
		$query = "DELETE FROM relationships WHERE id = '$id'";
		
		if (!$result = mysql_query($query)) {
			echo "<p>Error performing query:<br />$query</p>";
		} else {
			echo "<p>Record successfully deleted.</p>";
		}
	break;

} // switch


include 'footer.php'; 
?>