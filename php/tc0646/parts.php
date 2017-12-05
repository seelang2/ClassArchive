<style type="text/css">

form div {
	clear: both;
	margin-bottom: 5px;
	
}

form label {
	float: left;
	margin-right: 15px;
	text-align: right;
	width: 7em;
}

</style>


<?php
require_once ('lib_functions.php');

$me = $_SERVER['PHP_SELF'];

if (isset($_GET['hamsandwich']) && $_GET['hamsandwich'] != '') $hamsandwich = strtoupper($_GET['hamsandwich']); else $hamsandwich = 'ADD';

if (isset($_GET['id']) && $_GET['id'] != '') $id = $_GET['id']; else unset($id);

?>

<p><a href="<?php echo $me; ?>?hamsandwich=add">Add new record</a> | <a href="<?php echo $me; ?>?hamsandwich=list">List Records</a></p>

<?php

/*
$dbcnx = mysql_connect('localhost','root','portable');
if (!$dbcnx) die('Error connecting to database server');

$dbh = mysql_select_db('tc646');
if (!$dbh) die('Error selecting database');
*/

if (!$dbh = db_connect('tc646', 'root', 'portable')) die('Error connecting to database or server.');

switch($hamsandwich)
{
	case 'DELETE':
		if (isset($id)) {
			$query = "DELETE FROM parts WHERE id='$id'";
			
			if (!$result = mysql_query($query)) {
				// query error
				echo 'Error: ' . mysql_error();
			} else {
				// success
				echo 'Record Deleted successfully.';
			}
		} else {
			// no id
			echo 'Error: No ID specified.';
		}
	break;
	
	case 'LIST':
		$query = "SELECT id, part_name, part_num, make, model FROM parts";
		
		$results = mysql_query($query);
		
		if (!$results) {
			// error
			echo "error selecting records";
		} else {
			// query ok, continue
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo "<p>No rows present.</p>";
			} else {
				// process results
				
				echo '<table border="0" cellpadding="0" cellspacing="0">';
				echo '<tr><td>ID</td><td>Part Name</td><td>Part Number</td><td>Make</td><td>Model</td><td>Options</td></tr>';
				
				while ($row = mysql_fetch_array($results)) {
					echo "<tr>" . 
						"<td>{$row['id']}</td>" . 
						"<td>{$row['part_name']}</td>" . 
						"<td>{$row['part_num']}</td>" . 
						"<td>{$row['make']}</td>" . 
						"<td>{$row['model']}</td>" . 
						"<td>" . 
						"<a href=\"$me?hamsandwich=edit&id={$row['id']}\">Edit</a> | " . 
						"<a href=\"$me?hamsandwich=delete&id={$row['id']}\">Delete</a>" . 
						"</td>" .
						"</tr>";
				}
				
				echo '</table>';
			} // if num rows
		} // if results
	break;
	
	case 'PROCESSEDIT':
		if (!isset($id)) {
			echo "Invalid id specified.";
			break;
		} else {
			$editrec = true;
		}
	
	case 'PROCESSADD':
		$part_name = escape($_POST['part_name']);
		$part_num = escape($_POST['part_num']);
		$make = escape($_POST['make']);
		$model = escape($_POST['model']);
		
		
		if ($editrec) $query = "UPDATE"; else $query = "INSERT INTO";
		
		$query .= " parts SET part_name = '$part_name', part_num = '$part_num', make = '$make', model = '$model'";
		
		if ($editrec) $query .= " WHERE id = '$id'";
		
		echo $query;
		
		$result = mysql_query($query);
		
		if (!$result) {
			// handle error
			echo "Error inserting record into database.<br />Error: " . mysql_error();
		} else {
			// successful entry
			echo "Record added to database.";
		}
		
	break;

	case 'EDIT':
		if (!isset($id)) {
			// no id, display error
			echo "Invalid id. No soup for you!";
			break;
		} else {
			$query = "SELECT part_name, part_num, make, model FROM parts WHERE id = '$id' LIMIT 1";
			
			if (!$result = mysql_query($query)) {
				// handle error
				echo "Invalid id. No soup for you!";
				break;
			} else {
				// process result
				if (mysql_num_rows($result) < 1) {
					// no record found
					echo "No record matches that id.";
					break;
				} else {
					$row = mysql_fetch_array($result);
					$querystring = "processedit&id=$id";
				} // if num rows
			} // if result
		} // if !isset id
	
	case 'ADD':
		// display form
		if (!isset($querystring)) $querystring = 'processadd';
		
print <<< END
<form action="$me?hamsandwich=$querystring" method="post">
	<div>
		<label for="part_name">Part Name:</label>
		<input type="text" name="part_name" value="{$row['part_name']}" size="25" maxlength="50" />
	</div>
	<div>
		<label for="part_num">Part Number:</label>
		<input type="text" name="part_num" value="{$row['part_num']}" size="25" maxlength="15" />
	</div>
	<div>
		<label for="make">Make:</label>
		<input type="text" name="make" value="{$row['make']}" size="25" maxlength="15" />
	</div>
	<div>
		<label for="model">Model:</label>
		<input type="text" name="model" value="{$row['model']}" size="25" maxlength="15" />
	</div>
	<div>
		<input type="submit" name="butSubmit" value="Enter New Record" />
	</div>
</form>
END;
	
	break;

} // switch


?>