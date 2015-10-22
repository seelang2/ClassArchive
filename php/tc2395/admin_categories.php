<?php
$page_permission = 9;
require_once('config.php');

$action = 'LIST';
// get action parameter from query string
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);
// set or unset id if passed or not
if (!empty($_GET['id'])) $id = escape($_GET['id']); else unset($id);

?>
<div>
	<p>
    	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=list">List Records</a>&nbsp;|&nbsp;
    	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add">Add New Record</a>
    </p>
</div>
<?php

// get list of categories and store in array
$query = "SELECT * FROM categories";
$results = @mysql_query($query);
$categories = array();
while ($row = mysql_fetch_array($results)) {
	$categories[$row['id']] = $row;
}

switch($action)
{								
	case 'POST': // process form data
		
		// begin data validation
		$validated = true; // innocent until proven guilty
		$errormsg = ''; // placeholder for any error messages
		
		// name cannot be blank
		if (empty($_POST['name'])) {
			$validated = false;
			$errormsg .= '<br />Name field cannot be blank.';
		} else {
			$name = escape($_POST['name']); // ALWAYS sanitize data before using in query!
		}
		
		// no rule here, as value is allowed to be blank
		if (empty($_POST['parent_id'])) {
			$parent_id = NULL;
		} else {
			$parent_id = escape($_POST['parent_id']); // ALWAYS sanitize data before using in query!
		}
		
		if (empty($_POST['type'])) {
			$validated = false;
			$errormsg .= '<br />type field cannot be blank.';
		} else {
			$type = escape($_POST['type']); // ALWAYS sanitize data before using in query!
		}
		
		// confirm validation
		if (!$validated) {
			// validation fail
			echo '<p>The following errors have occurred:' .
				 $errormsg . 
				 '<br />Please go back and correct before continuing.</p>';
			break; // terminate case
		}
		
		// build query
		if (empty($id)) {
			// add new record
			$query = 'INSERT INTO ';
		} else {
			// edit existing record
			$query = 'UPDATE ';
		}
		
		$query .= 'categories SET ' .
				 "name = '$name', " .
				 "parent_id = '$parent_id', " .
				 "type = '$type' ";
		
		if (!empty($id)) $query .= " WHERE id = '$id' ";
		
		// send query to server
		$result = @mysql_query($query);
		// check result(s)
		if (!$result) {
			// query error
			echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		// display feedback
		echo '<p>The database was updated successfully.</p>';
		
	break; // POST
	
	case 'EDIT': // edit record
		if (empty($id)) {
			echo '<p>Invalid id. No soup for you! *snap*</p>';
			break; // terminate case
		}
		
		// lookup record
		$query = "SELECT * FROM categories WHERE id = '$id' ";
		
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// query error or no rows/too many rows(?!) found
			echo '<p>The record could not be found.</p>';
			//echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		$row = mysql_fetch_array($result);
	
	case 'ADD': // display new form
?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=post<?php if ($action == 'EDIT') echo "&id=$id"; ?>" method="post">
        	<div>
            	<label for="name">Category Name</label>
                <input id="name" name="name" value="<?php echo ( empty($row['name']) ) ? NULL : $row['name']; ?>" />
            </div>
        	<div>
            	<label for="parent_id">Parent Category</label>
                <input id="parent_id" name="parent_id" value="<?php echo ( empty($row['parent_id']) ) ? NULL : $row['parent_id']; ?>" />
            </div>
        	<div>
            	<label for="type">Type</label>
                <input id="type" name="type" value="<?php echo ( empty($row['type']) ) ? NULL : $row['type']; ?>" />
            </div>
            <div>
            	<input type="submit" value="Update record" />
            </div>
        </form>
<?php	
	break; // ADD
	
	case 'LIST': // list records in table
		// build query
		$query = 'SELECT * FROM categories';
		// send query to server
		$results = @mysql_query($query, $dbcnx);
		// check results
		if (!$results) {
			// query error
			echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		// process results
		if (mysql_num_rows($results) == 0) {
			// no rows present
			echo '<p>No rows present.</p>';
		} else {
			// display rows in table
			echo '<table><thead>';
			echo '<tr>' .
					'<td>ID</td>' .
					'<td>Name</td>' .
					'<td>Email</td>' .
					'<td>Password</td>' .
					'<td>Permissions</td>' .
					'<td>Options</td>' .
				 '</tr>';
			echo '</thead><tbody>';
			// loop through result rows
			while($row = mysql_fetch_array($results)) {
				echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['name'] . '</td>' .
						'<td>' . $row['email'] . '</td>' .
						'<td>' . $row['password'] . '</td>' .
						'<td>' . $PERMISSION_CODES[$row['permissions']] . '</td>' .
						'<td>' .
							'<a href="admin_categories.php?action=edit&id='.$row['id'].'">Edit</a> | ' .
							'<a href="admin_categories.php?action=delete&id='.$row['id'].
								'" onclick="return confirm(\'Are you sure you wish to delete this record?\')">Delete</a>' .
						'</td>' .
					 '</tr>';
			} // while
			echo '</tbody></table>';
			
		} // if num_rows
		
	break; // LIST
	
	case 'DELETE': // delete records
		if (empty($id)) {
			echo '<p>Invalid id. No soup for you! *snap*</p>';
			break; // terminate case
		}
		// lookup record
		$query = "DELETE FROM categories WHERE id = '$id' ";
		// send query to server
		$result = @mysql_query($query);
		// check result(s)
		if (!$result) {
			// query error
			echo '<p>Query error: ' . mysql_error($dbcnx) . '<br />' . 'Query: ' . $query . '</p>';
			break; // exit case
		}
		// display feedback
		echo '<p>The record has been successfully deleted.</p>';
		
	break; // DELETE
	
} // switch


?>