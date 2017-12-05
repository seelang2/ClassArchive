<?php

// connect to database server
$dbLink = @mysql_connect('localhost','root','xampp');
if (!$dbLink) { exit('Error connecting to database server.'); }

// select database
$dbh = @mysql_select_db('tc2909');
if (!$dbh) { exit('Error selecting database.'); }

// get the action from the query string
if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']); }
// check and retrieve id value if present
if (!empty($_GET['id'])) { $id = mysql_escape_string($_GET['id']); } else { unset($id); }

switch($action)
{
	case 'PROCESSFORM':
		// is form data present?
		if (empty($_POST)) {
			// no form data
			echo '<p>No form data present.</p>';
			break; // terminate case
		}
		
		// preprocess data
		$name = mysql_escape_string($_POST['name']);
		
		// build query
		if (empty($id)) {
			$query = 'INSERT INTO';
		} else {
			$query = 'UPDATE';
		}
		
		$query .= " librarians SET name = '$name' ";
		
		if (!empty($id)) $query .= " WHERE id = '$id' ";
		
		// send query to server
		$result = @mysql_query($query);
		// check result
		if (!$result) {
			// query error
			echo '<p>Query error. No soup for you!</p>';
			break;
		}
		
		// display user feedback - success message
		echo '<p>The record has been saved successfully.</p>';
		
	break; // PROCESSFORM
	
	case 'EDIT': // lookup a record to edit
		if (empty($id)) {
			echo '<p>Invalid id specified.</p>';
			break; // terminate case
		}
		
		$query = "SELECT name FROM librarians WHERE id = '$id' ";
		$result = @mysql_query($query);
		
		if (!$result || mysql_num_rows($result) != 1) {
			// query error
			echo '<p>Query error. No soup for you! *snap*</p>';
			break;
		}
		
		$record = mysql_fetch_array($result);
	
	case 'SHOWFORM': // display data entry form to user
	?>
		<form action="admin-libs.php?action=processform<?php if (!empty($id)) echo '&id='.$id; ?>" method="post">
        	<p>
              Name:
              <input type="text" name="name" value="<?php if (!empty($record['name'])) echo $record['name']; ?>" />
            </p>
            <p>
              <input type="submit" value="Update Database" />
            </p>
        </form>
	<?php
	break; // SHOWFORM
	
	case 'LIST': // display list of records in table
		
		// build query
		$query = "SELECT librarians.id, librarians.name FROM librarians";
		
		// send query to server
		$results = @mysql_query($query);
		if (!$results) {
			// query error
			echo '<p>Query error. No soup for you! *snap*</p>';
			break;
		}
		
		if (mysql_num_rows($results) == 0) {
			// empty table
			echo '<p>There are no records in the table.</p>';
			break;
		}
		
		// process result set
		
		?>
        <table>
        	<tbody>
            	<tr>
                	<th>ID</th>
                    <th>Name</th>
                    <th>Options</th>
                </tr>
        <?php
		
		// loop through results and display table row
		while($row = mysql_fetch_array($results)) {
			
			echo '<tr>' .
					'<td>'. $row['id'] .'</td>' .
					'<td>'. $row['name'] .'</td>' .
					'<td>' .
						'<a href="admin-libs.php?action=edit&id='.$row['id'].'">Edit</a> | ' .
						'<a href="admin-libs.php?action=delete&id='.$row['id'].'">Delete</a>' .
					'</td>' .
				 '</tr>';
			
		} // while rows
		
		echo '</tbody></table>';
		
		
	break; // LIST
	
	case 'DELETE': // delete record
		if (empty($id)) {
			echo '<p>Invalid id specified.</p>';
			break; // terminate case
		}
		
		$query = "DELETE FROM librarians WHERE id = '$id' ";
		$result = @mysql_query($query);
		// check result
		if (!$result) {
			// query error
			echo '<p>Query error. No soup for you!</p>';
			break;
		}
		
		// display user feedback - success message
		echo '<p>The record has been deleted successfully.</p>';
		
	break; // DELETE
	
} // switch



?>