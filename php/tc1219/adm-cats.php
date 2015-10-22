<?php
require_once('config.php');

include('header.php');

/*
$dbcnx = @mysql_connect('localhost','root','portable');

if (!$dbcnx) exit('Error connecting to database server.');

$dbh = @mysql_select_db('tc1219');

if (!$dbh) exit('Error selecting database.');
*/
?>
<p>
	<a href="adm-cats.php?action=list">List Records</a> |
	<a href="adm-cats.php?action=showform">Add New Record</a>
</p>
<?php


$action = 'LIST';
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

if (!empty($_GET['id'])) $id = mysql_escape_string($_GET['id']); else unset($id);

switch($action) {
	case 'DELETE':
		if (empty($id)) {
			// no id, don't continue
			echo '<p>Error: No id present.</p>';
		} else {
			$query = "DELETE FROM categories WHERE id = '$id'";
			
			$result = @mysql_query($query);
			
			if (!$result) {
				// query error
				echo "<p>There was an error in the query:<br />$query</p>";
			} else {
				if (mysql_affected_rows() > 0) {
					echo '<p>Row was successfully deleted.</p>';
				} else {
					echo '<p>No rows were deleted.</p>';
				}
			}
		}
	break; // delete
	
	default:
	case 'LIST':
		
		$query = 'SELECT id, name FROM categories';
		
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error
			echo "<p>There was an error in the query:<br />$query</p>";
		} else {
			// query ok, continue
			if (mysql_num_rows($results) < 1) {
				// no rows in result set
				echo "<p>No rows present.</p>";
			} else {
				// loop through result set and display

				echo '<table border="1" cellpadding="3" cellspacing="0">';
				echo '<tr>' . 
					 '<th>ID</th>' . 
					 '<th>Name</th>' .
					 '<th>Options</th>' .
					 '</tr>';
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['name'] . '</td>' .
						'<td>' . 
							'<a href="' . $_SERVER['PHP_SELF'] . '?action=edit&id=' . $row['id'] . '">Edit</a> | ' . 
							'<a href="' . $_SERVER['PHP_SELF'] . '?action=delete&id=' . $row['id'] . '">Delete</a>' . 
						 '</td>' .
						'</tr>';
				} // while
				echo '</table>';

			} // if num_rows
		} // if results
	break; // list
	
	case 'EDIT':
		if (empty($id)) {
			// no id present
			echo '<p>No id present.</p>';
		} else {
			// look up record
			$query = "SELECT name FROM categories WHERE id = '$id' LIMIT 1";
			
			$result = @mysql_query($query);
			if (!$result || mysql_num_rows($result) == 0) {
				// query error or no matching rows in db
				echo '<p>Query error or the record could not be found.</p>';
			} else {
				// row found, get result and place in array
				$record = mysql_fetch_array($result);
			}
			
		}
	
	case 'SHOWFORM':
	?>
		<form 
			action="<?php echo $_SERVER['PHP_SELF']; ?>?action=ProcessADD<?php if (!empty($id)) echo '&id='.$id; ?>" 
			method="post">
			<div>
				<label for="name">Name:</label>
				<input name="name" size="40" maxlength="60" value="<?php if (!empty($record['name'])) echo $record['name']; ?>" />
			</div>
			<div><input type="submit" name="butSubmit" value="Save Record" /></div>
		</form>
	<?php
	break; // showform
	
	case 'PROCESSADD':
		
		// get data from form
		$name = mysql_escape_string($_POST['name']);
		
		// validation rules
		$validated = true;
		$err_message = '';
		
		if (empty($name)) { // name must not be empty
			$validated = false;
			$err_message .= '<br />Name field cannot be blank.';
		}
		
		// check validation state
		if (!$validated) {
			echo '<p>The following errors have occurred:';
			echo $err_message . '</p>';
			echo '<p>Please go back and correct them.</p>';
			break; // terminates case
		}
		
		if (empty($id)) $query = 'INSERT INTO '; else $query = 'UPDATE ';
		
		$query .= "categories SET name = '" . $name . "'";
		
		if (!empty($id)) $query .= " WHERE id = '$id'";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo "<p>There was an error in the query:<br />$query</p>";
		} else {
			echo '<p>Record has been ';
			if (empty($id)) echo 'added.</p>'; else echo 'updated.</p>';
		}
		
	break; // process

/*
	default:
		echo '<p>Invalid action specified. No soup for you!</p>';
	break; // default
*/
} // switch

include('footer.php');
?>