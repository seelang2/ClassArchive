<?php
require_once('config.php');

/*
$dbcnx = mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) exit('Error connecting to database server.');

$dbh = mysql_select_db('tc1003');

if (!$dbh) exit('Error selecting database.');
*/

function listRecords() {
		$query = 'SELECT id, name FROM categories';
		
		if (!$results = mysql_query($query)) {
			// query error
			echo "Error processing query $query";
		} else {
			if (mysql_num_rows($results) < 1) {
				echo '<p>No rows present.</p>';
			} else {
				// process result set
				
				echo '<table cellpadding="3" cellspacing="0">';
				echo '<tr><th>ID</th><th>Category Name</th><th>Options</th></tr>';
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['name'] . '</td>' .
						'<td>' . 
						'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a> | ' .
						'<a href="' . $_SERVER['PHP_SELF'] . '?mode=delete&id=' . $row['id'] . '">Delete</a>' .
						'</td>' .
						'</tr>';
				}
				echo '</table>';
			}
		}
}


$mode = 'LIST';
if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']);
if (!empty($_GET['id'])) $id = mysql_real_escape_string($_GET['id']); else unset($id);

include('header.php');

?>

<p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List records</a> | 
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add new record</a>
</p>

<?php

switch($mode)
{
	case 'LIST':
		listRecords();
	break;
	
	case 'UPDATE':
		if (!isset($id)) {
			// error
			echo 'No id present.';
			break;
		}
	
	case 'INSERT':
		if (isset($_POST['butSubmit'])) {
			// processing form data
			
			$validated = true;
			$errmsg = '';
			
			// run validation rules
			if (!empty($_POST['name'])) { 
				$name = mysql_real_escape_string($_POST['name']);
			} else {
				$validated = false;
				$errmsg .= 'The name field cannot be blank.<br />';
			}
			
			if ($validated) {
				
				if (isset($id)) $query = 'UPDATE '; else $query = 'INSERT INTO ';
				
				$query .= "categories SET name = '$name'";
				
				if (isset($id)) $query .= "WHERE id = '$id'";
				
				$result = mysql_query($query);
				if (!$result || mysql_affected_rows() < 1) {
					// error occurred
					echo "Error processing query $query";
				} else {
					// process results
					echo 'Record successfully updated.';
					listRecords();
				}
				
			} else {
				// validation failed
				echo "The following error(s) have occurred:<br />$errmsg";
			}
				
		} else {
			// no form data posted
			echo '<p>Error: No form data present.</p>';
		}
	break;
	
	case 'EDIT':
		if (!isset($id)) {
			// error
			echo 'No ID specified.';
			redirect($base_url . $_SERVER['PHP_SELF']);
		} else {
			$query = "SELECT name FROM categories WHERE id = '$id'";
			$result = mysql_query($query);
			if (!$result || mysql_num_rows($result) != 1) {
				// error
				echo "Error processing query $query";
				break;
			} else {
				$row = mysql_fetch_array($result);
				$newmode = 'update&id=' . $id;
			}
		}
	
	case 'ADD':
		// display entry form
		if (!isset($newmode)) $newmode = 'insert';
		
?>		
		<h1>Add New Record</h1>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=<?php echo $newmode; ?>" method="post">
			Category Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" size="50" maxlength="100" /><br />
			<input name="butSubmit" type="submit" value="Enter Record" />
		</form>

<?php
	break;

	case 'DELETE':
		if (!isset($id)) {
			// no id present, display error
			echo 'No id present.';
		} else {
			// process delete
			$query = "DELETE FROM categories WHERE id = '$id'";
			if (!$result = mysql_query($query)) {
				// error during delete
				echo "Error processing query $query";
			} else {
				// successful delete
				echo 'Record successfully deleted.';
				listRecords();
			}
		}
	break;

}






include('footer.php');
?>