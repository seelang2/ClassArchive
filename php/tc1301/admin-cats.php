<?php
/*
	admin-depts.php - categories table records management
	A simple CRUD (create/read/update/delete) application
	
	Author: Chris Langtiw (chris@sitebabble.net)
	Training Connection (www.trainingconnection.com

*/
require_once('config.php');

include('header.php'); 

// Get a mode parameter from the query string to determine which process to use
if (!empty($_GET['mode'])) { 
	$mode = strtoupper($_GET['mode']); 
} else { 
	$mode = 'LIST'; 
}

// Get the id if passed on query string and make sure the variable is not set if it's not
if (!empty($_GET['id'])) {
	$id = escape($_GET['id']);
} else {
	unset($id);
}

?>
	<h1>Categories Administration</h1>
	<p>
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List Records</a> |
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=showform">Add new record</a>
	</p>
<?php


switch($mode)
{
	case 'PROCESS':
		// set up validation
		$validated = true;
		$validation_msg = '';
		
		// get data from form
		if (empty($_POST['name'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Department name cannot be blank.';
		} else {
			$name = escape($_POST['name']);
		}
		
		if ($validated) {
			// build query
			if (empty($id)) {
				$query = "INSERT INTO ";
			} else {
				$query = "UPDATE ";
			}
			
			$query .= "categories SET name = '$name' ";
			
			if (!empty($id)) $query .= " WHERE id = '$id'";
			
			$result = @mysql_query($query);
			
			if (!$result) {
				// error
				echo '<p>There was an error in the SQL query:' .
					 mysql_error() . '<br />Query: ' . $query . '</p>';
				
			} else {
				// query worked
				echo '<p>Record was successfully updated.<br />Query: ' . $query . '</p>';
				
			} // if result
		} else {
			// form invalidated, display validation message
			echo '<p class="errormessage">The following errors were encountered: ' .
				 $validation_msg .
				 '<br />Please go back and try again.</p>';
			
		} // if validated
	
	break; // process
	
	case 'EDIT':
		
		if (empty($id)) {
			// no id present
			echo '<p>No id present.</p>';
			break;
		} else {
			// look up record to edit
			
			$query = "SELECT name FROM categories WHERE id = '$id' LIMIT 1";
			
			$result = @mysql_query($query);
			if ( (!$result) || (mysql_num_rows($result) != 1) ) {
				// query error or record not found
				echo '<p>Query error or no record found. No Soup For You!</p>';
			} else {
				// record found
				$row = mysql_fetch_array($result);
				
			}
		
		}
	
	case 'SHOWFORM':
		if (!empty($id)) {
			$extra_stuff = '&id=' . $id;
		} else {
			$extra_stuff = '';
		}
?>
		<form name="entryform" action="<?php echo $_SERVER['PHP_SELF'] . '?mode=process' . $extra_stuff; ?>" method="post">
			<div>
				<label for="name">Department Name:</label>
				<input type="text" name="name" value="<?php if (isset($row['name'])) echo $row['name']; ?>" />
			</div>
			<input type="submit" name="butSubmit" value="Enter record" />
		</form>
<?php	
	break; // showform
	
	
	case 'LIST':
		
		$query = "SELECT id, name FROM categories";
		
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error, do something
			echo '<p>There was an error in the SQL query:' .
				 mysql_error() . '<br />Query: ' . $query . '</p>';
		
		} else {
			// query ok, proceed
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo '<p>No rows in table</p>';
				
			} else {
				// display rows
				
				echo '<table><tbody>' . 
					 '<tr>' . 
					 '<th>ID</th>' . 
					 '<th>Name</th>' .
					 '<th>Options</th>' .
					 '</tr>';
					
				// loop through results and diplay row data
				while($row = mysql_fetch_array($results)) {
					
					echo '<tr>' .
						 '<td>' . $row['id'] . '</td>' .
						 '<td>' . $row['name'] . '</td>' .
						 '<td>' .
						 	'<a href="'. $_SERVER['PHP_SELF'] .'?mode=edit&id='. $row['id'] .'">Edit</a> | ' .
						 	'<a href="'. $_SERVER['PHP_SELF'] .'?mode=delete&id='. $row['id'] .'">Delete</a>' .
						 '</td>' .
						 '</tr>';
				
				} // while
				
				echo '</tbody></table>';
			
			}
		}// if results
	break; // list

	case 'DELETE':
		if (empty($id)) {
			// error
			echo '<p>No id present</p>';
		} else {
			$query = "DELETE FROM categories WHERE id = '$id'";
			
			$result = @mysql_query($query);
			if (!$result ) {
				// query error or record not found
				echo '<p>Query error or no record found. No Soup For You!</p>';
			} else {
				// record found
				echo '<p>Record was successfully deleted.</p>';
			}
		} // if empty id
		
	break; // delete

} // switch



include('footer.php');
?>