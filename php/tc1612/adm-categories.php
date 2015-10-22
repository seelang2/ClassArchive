<?php
// set page title
$pageTitle = 'Manage Categories';

require_once('config.php');

include('header.php');

$action = 'LIST';
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);
if (!empty($_GET['id'])) $id = escape($_GET['id']); else unset($id);


switch($action)
{
	case 'PROCESS':
		
		// set up data validation
		$validated = true;
		$errmsg = '';
		
		// validate non-empty field
		if (empty($_POST['name'])) {
			// invalidate form and append error message
			$validated = false;
			$errmsg .= '<br />The name field cannot be blank.';
		} else {
			// retrieve data from field and sanitize data
			$name = escape($_POST['name']);
		}
		
		if (!$validated) {
			// show errors and terminate case
			echo '<p>The following error have been encountered: ' .
				 $errmsg .
				 '<br />Please go back and correct these errors.</p>';
			break;
		}
		
		// build query
		if (empty($id)) {
			$query = "INSERT INTO ";
		} else {
			$query = "UPDATE ";
		}
		
		$query .= "categories SET name = '$name'";
		
		if (!empty($id)) $query .= " WHERE id = '".$id."'"; // or use " WHERE id = '$id'"
		
		$result = @mysql_query($query);
		if (!$result) {
			// error
			echo '<p>Error</p>';
		} else {
			// success
			echo '<p>The database has been updated.</p>';
		}
	
	break; // PROCESS
	
	case 'EDIT':
		// check for valid id
		if (empty($id)) {
			echo '<p>Invalid id specified.</p>';
			break;
		}
		
		//$query = "SELECT name FROM categories WHERE id = '$id'"; // interpolated version
		//$query = 'SELECT name FROM categories WHERE id = \''.$id.'\''; // using escaped quotes
		$query = "SELECT name FROM categories WHERE id = '".$id."' LIMIT 1"; // concatenated quotes
		
		$result = @mysql_query($query);
		if ( ($result == false) || (mysql_num_rows($result) != 1) ) {
			// query error or no record found
			echo '<p>Query error, no soup for you!</p>';
		} else {
			// retrieve row record
			$row = mysql_fetch_array($result);
			
		} // if result
	
	case 'ADD':
		
		//include form page
		include('inc_catform.php');
		
		
	break; // ADD
	
	case 'LIST':
		// build query
		$query = "SELECT id, name FROM categories";
		
		// send query
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error
			echo '<p>The following SQL error has occurred: <br />' . mysql_error() .
				 '<br />Query: ' . $query . '</p>';
		} else {
			// query ok, continue
			if (mysql_num_rows($results) == 0) {
				// no rows present
				echo '<p>No records in table.</p>';
			} else {
				// display table
				echo '<table  border="0" cellpadding="3" cellspacing="0">' . "\n" .
					 '<tr>' .
						 '<th>ID</th>' .
						 '<th>Name</th>' .
						 '<th>Options</th>' .
					 '</tr>' . "\n";
				
				$r = 1;
				// loop through the rows in the the result set
				while($row = mysql_fetch_array($results)) {
					if ($r % 2 == 0) {
						$bgcolor = '#eeeeee';
					} else {
						$bgcolor = '#cccccc';
					}
					
					$r++;	
					echo '<tr style="'.$bgcolor.'">' .
							 '<td>' . $row['id'] . '</td>' .
							 '<td>' . $row['name'] . '</td>' .
							 '<td>' .
							 	'<a href="adm-categories.php?action=edit&id='.$row['id'].'">Edit</a> | ' .
							 	'<a href="adm-categories.php?action=delete&id='.$row['id'].'">Delete</a>' .
							 '</td>' .
						 '</tr>';
				} // while row
				
				echo '</table>';
			}
		} // if results
	
	break; // LIST
	
	case 'DELETE':
		// check for valid id
		if (empty($id)) {
			echo '<p>Invalid id specified.</p>';
			break;
		}
		
		$query = "DELETE FROM categories WHERE id = '$id'";
		
		$result = @mysql_query($query);
		if (!$result) {
			// error
			echo '<p>Error</p>';
		} else {
			// success
			echo '<p>The record has been deleted.</p>';
		}
	break; // DELETE
	
} // switch action



include('footer.php');
?>