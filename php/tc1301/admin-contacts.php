<?php
/*
	admin-depts.php - contacts table records management
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
	<h1>Contacts Administration</h1>
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
		
		// get data from form and validate fields
		if (empty($_POST['firstname'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />First name cannot be blank.';
		} else {
			$firstname = escape($_POST['firstname']);
		}
		
		if (empty($_POST['lastname'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Last name cannot be blank.';
		} else {
			$lastname = escape($_POST['lastname']);
		}
		
		if (empty($_POST['homephone'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Home Phone cannot be blank.';
		} else {
			$homephone = escape($_POST['homephone']);
		}
		
		if (empty($_POST['workphone'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Work Phone cannot be blank.';
		} else {
			$workphone = escape($_POST['workphone']);
		}
		
		if (empty($_POST['email'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Email cannot be blank.';
		} else {
			$email = escape($_POST['email']);
		}
		
		if (empty($_POST['login'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />login cannot be blank.';
		} else {
			$login = escape($_POST['login']);
		}
		
		if (empty($_POST['password'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />password cannot be blank.';
		} else {
			$password = escape($_POST['password']);
		}
		
		if (empty($_POST['dept_id'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Department must be selected.';
		} else {
			$dept_id = escape($_POST['dept_id']);
		}
		
		if (empty($_POST['type'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Type cannot be blank.';
		} else {
			$type = escape($_POST['type']);
		}
		
		if ($validated) {
			// build query
			if (empty($id)) {
				$query = "INSERT INTO ";
			} else {
				$query = "UPDATE ";
			}
			
			$query .= "contacts SET " . 
					  "firstname = '$firstname', " .
					  "lastname = '$lastname', " .
					  "homephone = '$homephone', " .
					  "workphone = '$workphone', " .
					  "email = '$email', " .
					  "login = '$login', " .
					  "password = '$password', " .
					  "dept_id = '$dept_id', " .
					  "type = '$type' ";
			
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
			
			$query = "SELECT * FROM contacts WHERE id = '$id' LIMIT 1";
			
			$result = @mysql_query($query);
			if ( (!$result) || (mysql_num_rows($result) != 1) ) {
				// query error or record not found
				echo '<p>Query error or no record found. No Soup For You!</p>';
			} else {
				// record found
				$row = mysql_fetch_array($result);
				
			}
			
			// get categories for this contact
			$query = "SELECT id, name FROM categories, c2c " .
					 " WHERE contact_id = '$id' " .
					 " AND category_id = id " .
					 " LIMIT 1";

			$result = @mysql_query($query);
			$contact_cats = array();
			while ($tempcat = mysql_fetch_array($result)) {
				$contact_cats[] = $tempcat['id'];
			}
		
		}
	
	case 'SHOWFORM':
		if (!empty($id)) {
			$extra_stuff = '&id=' . $id;
		} else {
			$extra_stuff = '';
		}
		
		// need to define contact category as empty array if doesn't exist (on add)
		if (!isset($contact_cats)) $contact_cats = array();
		
		// get department list
		$query = 'SELECT id, name FROM departments';
		$dept_set = @mysql_query($query);
		
		// get category list
		$query = 'SELECT id, name FROM categories';
		$cat_set = @mysql_query($query);
		
		
?>
		<form name="entryform" action="<?php echo $_SERVER['PHP_SELF'] . '?mode=process' . $extra_stuff; ?>" method="post">
			<div>
				<label for="firstname">First Name:</label>
				<input type="text" name="firstname" value="<?php if (isset($row['firstname'])) echo $row['firstname']; ?>" />
			</div>
			<div>
				<label for="lastname">Last Name:</label>
				<input type="text" name="lastname" value="<?php if (isset($row['lastname'])) echo $row['lastname']; ?>" />
			</div>
			<div>
				<label for="homephone">Home Phone:</label>
				<input type="text" name="homephone" value="<?php if (isset($row['homephone'])) echo $row['homephone']; ?>" />
			</div>
			<div>
				<label for="workphone">Work Phone:</label>
				<input type="text" name="workphone" value="<?php if (isset($row['workphone'])) echo $row['workphone']; ?>" />
			</div>
			<div>
				<label for="email">Email:</label>
				<input type="text" name="email" value="<?php if (isset($row['email'])) echo $row['email']; ?>" />
			</div>
			<div>
				<label for="login">Login:</label>
				<input type="text" name="login" value="<?php if (isset($row['login'])) echo $row['login']; ?>" />
			</div>
			<div>
				<label for="password">Password:</label>
				<input type="text" name="password" value="<?php if (isset($row['password'])) echo $row['password']; ?>" />
			</div>
			<div>
				<label for="dept_id">Department:</label>
				<select name="dept_id"><option value="">Select one:</option>
					<?php
						while ($dept_row = mysql_fetch_array($dept_set)) {
							echo '<option value="'. $dept_row['id'] .'"';
							if ($row['dept_id'] == $dept_row['id']) echo ' selected="selected"';
							echo '>'. $dept_row['name'] .'</option>';
							echo '<!-- '.$row['dept_id'].' -->';
						}
					?>
				</select>
			</div>
			<div>
				<label for="type">Type:</label>
				<select name="type"><option value="">Select one:</option>
					<?php
						foreach($contact_types as $key => $label) {
							echo '<option value="'. $key .'"';
							if ($row['type'] == $key) echo ' selected="selected"';
							echo '>'. $label .'</option>';
							echo '<!-- '.$row['type'].' -->';
						}
					?>
				</select>
			</div>



<!--			<div>
				<label for="cats[]">Categories:</label>
				<select name="cats[]" multiple="multiple"><option value="">Select one:</option>
					<?php
						while ($cat_row = mysql_fetch_array($cat_set)) {
							echo '<option value="'. $dept_row['id'] .'"';
							if (in_array($cat_row['id'],$contact_cats)) echo ' selected="selected"';
							echo '>'. $dept_row['name'] .'</option>';
							echo '<!-- '.$row['dept_id'].' -->';
						}
					?>
				</select>
			</div>
-->
			<input type="submit" name="butSubmit" value="Enter record" />
		</form>
		
		<hr />
		
<?php	
		// display addresses for this contact
		include('list_addresses.php');
		
		
	break; // showform
	
	
	case 'LIST':
		
		$query = "SELECT c.id, firstname, lastname, homephone, workphone, type, name AS department " .
				 "FROM contacts AS c, departments AS d " .
				 "WHERE c.dept_id = d.id " .
				 "ORDER BY lastname ASC";
		
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
					 '<th>Home Phone</th>' .
					 '<th>Work Phone</th>' .
					 '<th>Type</th>' .
					 '<th>Department</th>' .
					 '<th>Options</th>' .
					 '</tr>';
					
				// loop through results and diplay row data
				while($row = mysql_fetch_array($results)) {
					
					echo '<tr>' .
						 '<td>' . $row['id'] . '</td>' .
						 '<td>' . $row['lastname'] . ', ' . $row['firstname'] . '</td>' .
						 '<td>' . $row['homephone'] . '</td>' .
						 '<td>' . $row['workphone'] . '</td>' .
						 '<td>' . $contact_types[$row['type']] . '</td>' .
						 '<td>' . $row['department'] . '</td>' .
						 '<td>' .
						 	'<a href="'. $_SERVER['PHP_SELF'] .'?mode=edit&id='. $row['id'] .'">Edit/View</a> | ' .
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
			$query = "DELETE FROM contacts WHERE id = '$id'";
			
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