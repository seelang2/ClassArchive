<?php
require_once('config.php');

include('header.php');


?>
	<div id="submenu">
    	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=list">List Records</a>&nbsp;|&nbsp;
    	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=showform">Add New Record</a>
    </div>
<?php

$action = '';
if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']); }
if (!empty($_GET['id'])) { $id = mysql_escape_string($_GET['id']); } else { unset($id); }

switch($action)
{
	
	case 'EDIT':
		// check to see if id is present
		if (empty($id)) {
			echo '<p>Invalid ID.</p>';
			break;
		}
		
		$query = "SELECT name, description, price, quantity FROM products WHERE id = '$id' ";
		$result = @mysql_query($query);
		if ( (!$result) || (mysql_num_rows($result) != 1) ) {
			// query error or invalid id number
			echo '<p>Query error or invalid ID. No soup for you! *snap*</p>';
			break;
		}
		$row = mysql_fetch_array($result);
	
	case 'SHOWFORM':
	?>
	<h1><?php if (empty($id)) { echo 'Add New'; } else { echo 'Edit';} ?> Product Form</h1>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process<?php if (!empty($id)) echo '&id='.$id; ?>" method="post">
    	<div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php if (!empty($row['name'])) echo $row['name']; ?>" />
        </div>
    	<div>
            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php if (!empty($row['description'])) echo $row['description']; ?>" />
        </div>
    	<div>
            <label for="price">Price:</label>
            <input type="text" name="price" value="<?php if (!empty($row['price'])) echo $row['price']; ?>" />
        </div>
    	<div>
            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" value="<?php if (!empty($row['quantity'])) echo $row['quantity']; ?>" />
        </div>
        <div><input type="submit" value="Continue" /></div>
    </form>
    <?php
	break; // SHOWFORM
	
	case 'PROCESS':
		// check for post data
		if (empty($_POST)) { 
			echo '<p>Error: No form data present.</p>';
			break;
		}
		
		// set up field validation
		$form_validated = true;
		$errmessage = '';
		
		$name = mysql_escape_string($_POST['name']);
		// field can't be blank
		if (empty($name)) {
			$form_validated = false;
			$errmessage .= '<br />Name cannot be blank.';
		}
		
		$description = mysql_escape_string($_POST['description']);
		// field can't be blank
		if (empty($description)) {
			$form_validated = false;
			$errmessage .= '<br />Description cannot be blank.';
		}
		
		$price = mysql_escape_string($_POST['price']);
		// field can't be blank
		if (empty($price)) {
			$form_validated = false;
			$errmessage .= '<br />Price cannot be blank.';
		}
		// field must be a number
		if (!is_numeric($price)) {
			$form_validated = false;
			$errmessage .= '<br />Price must be a number.';
		}
		
		$quantity = mysql_escape_string($_POST['quantity']);
		// field can't be blank
		if (empty($quantity)) {
			$form_validated = false;
			$errmessage .= '<br />quantity cannot be blank.';
		}
		// field must be a number greater than zero
		if ( (!is_numeric($quantity)) || ($quantity < 0) ) {
			$form_validated = false;
			$errmessage .= '<br />Quantity must be greater than zero.';
		}
		
		// confirm validation
		if (!$form_validated) {
			// display error messages
			echo '<p>The following problems were found: ' . $errmessage . 
				 '<br />Please go back and correct them.</p>';
			break;
		}
		
		// build query
		if (empty($id)) {
			$query = 'INSERT INTO ';
		} else {
			$query = 'UPDATE ';
		}
		
		$query .= 'products SET ' .
				 "name = '$name', " .
				 "description = '$description', " .
				 "price = '$price', " .
				 "quantity = '$quantity' ";
		
		if (!empty($id)) { $query .= " WHERE id = '$id' "; }
		
		// send query to db server
		$result = @mysql_query($query);
		
		// check result
		if (!$result) {
			// error encountered
			echo '<p>There was an error with the query:<br />' . $query . '</p>';
		} else {
			// success
			echo '<p>The database has been updated.</p>';
		}
	
	break; // PROCESS
	
	case 'LIST':
		
		//build query
		$query = 'SELECT id, name, price, quantity FROM products ';
		
		// send query
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error
			echo '<p>There was a query error. No soup for you!</p>';
			break; // terminate case
		}
		
		// process results - if any
		if (mysql_num_rows($results) < 1) {
			// no records in table
			echo '<p>No rows in table.</p>';
			break;
		}
		
		// build table
		echo '<table><thead><tr>' .
				'<th>ID</th>' .
				'<th>Name</th>' .
				'<th>Price</th>' .
				'<th>Quantity</th>' .
				'<th>Options</th>' .
			 '</tr></thead><tbody>';
		
		// loop through result set and display as table rows
		while ($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['name'] . '</td>' .
					'<td>' . $row['price'] . '</td>' .
					'<td>' . $row['quantity'] . '</td>' .
					'<td>' . 
						'<a href="'.$_SERVER['PHP_SELF'].'?action=edit&id='.$row['id'].'">Edit</a> | ' . 
						'<a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$row['id'].'">Delete</a>' . 
					'</td>' .
				 '</tr>';
		} // while
		
		echo '</tbody></table>';
	break; // LIST
	
	case 'DELETE':
		// make sure the id exists
		if (empty($id)) {
			echo '<p>Invalid ID.</p>';
			break;
		}
		
		// build and run delete query
		$query = "DELETE FROM products WHERE id = '$id' ";
		
		// send query to db server
		$result = @mysql_query($query);
		
		// check result
		if (!$result) {
			// error encountered
			echo '<p>There was an error with the query:<br />' . $query . '</p>';
		} else {
			// success
			echo '<p>The record has been deleted.</p>';
		}
	
	break; // DELETE
	
} // switch action


include('footer.php');