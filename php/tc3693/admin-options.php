<?php
require_once('config.php');

include('header.php');

// look for an action parameter passed on query string
if (!empty($_GET['action'])) {
	$action = strtoupper($_GET['action']);
} else {
	$action = 'LIST'; // set action to a default action
}

// check for id parameter
if (!empty($_GET['id'])) { $id = mysql_escape_string($_GET['id']); } else { unset($id); }

switch($action) {
	
	default: // default action is to list records
	case 'LIST':
		// display records in table as a table
		
		// build query
		$query = 'SELECT options.id, options.name as optionname, options.price, categories.name as category ' . 
				 'FROM options, categories ' .
				 'WHERE options.category_id = categories.id';
		
		// send query to server
		$results = @mysql_query($query);
		
		// check results
		if (!$results) {
			// query error
			echo '<p>Query error.<br />' . $query . '</p>';
			break; // terminate case
		}
		
		// process results if any
		// are there any records?
		if (mysql_num_rows($results) == 0) {
			echo '<p>No rows in table.</p>';
			break;
		}
		
		echo '<table><tbody>';
		
		// loop through data
		while($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['optionname'] . '</td>' .
					'<td>' . $row['price'] . '</td>' .
					'<td>' . $row['category'] . '</td>' .
					'<td>' . 
						'<a href="admin-options.php?action=edit&id=' . $row['id'] . '">Edit</a>' .
						' | <a href="admin-options.php?action=delete&id=' . $row['id'] . '">Delete</a>' .
					'</td>' .
				 '</tr>';
		} // while
		
		echo '</tbody></table>';
		
	break; // LIST
	
	case 'EDIT': // edit record
		// check for id var
		if (empty($id)) {
			// invalid id
			echo '<p>Invalid id specified.</p>';
			break; // nothing else to do here
		}
		// retrieve record from table
		$query = "SELECT name, price, category_id FROM options WHERE id = '$id' ";
		$result = @mysql_query($query); // send query
		if (!$result || mysql_num_rows($result) != 1) {
			echo '<p>Invalid id or record not found.</p>'; // error
			break;
		}
		$item = mysql_fetch_array($result); // get row and store in var
		
	// this break is intentionally left blank.
	
	case 'ADD': // display blank form
		
	?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process<?php echo empty($id)?NULL:'&id='.$id; ?>" method="post">
        	<div>
            	<label for="name">Option Name:</label>
                <input type="text" id="name" name="name" 
                	value="<?php echo empty($item['name'])? NULL : $item['name']; ?>" />
            </div>
        	<div>
            	<label for="price">Price:</label>
                <input type="text" id="price" name="price" 
                	value="<?php echo empty($item['price'])? NULL : $item['price']; ?>" />
            </div>
        	<div>
            	<label for="category">Category:</label>
                <select id="category" name="category">
                <?php
				//build query
				$query = 'SELECT id, name FROM categories ORDER BY name ASC';
				// send query to server
				$results = @mysql_query($query);
				// check results
				if (!$results) {
					// query error
					echo '<p>Query error.<br />' . $query . '</p>';
					break; // terminate case
				}
				// loop through results and output option elements
				while ($row = mysql_fetch_array($results)) {
					echo '<option value="'.$row['id'].'" ';
					echo $row['id'] == $item['category_id'] ? 'selected="selected"' : NULL;
					echo '>'.$row['name'].'</option>' . "\n";
				} // while row
				?>
                </select>
            </div>
        	<div>
                <input type="submit" value="Update Database" />
            </div>
        </form>
    <?php
		
	break; // ADD
	
	case 'PROCESS': // process form data
		
		// data validation
		$validated = true; // innocent until proven guilty approach
		$validation_errors = ''; // used to hold validation error messages
		
		// sanitize form data to make it safe from injection attacks
		$name = mysql_escape_string($_POST['name']);
		$price = mysql_escape_string($_POST['price']);
		$category_id = mysql_escape_string($_POST['category']);
		
		// validation rules
		// field can't be blank
		if (empty($name)) {
			$validated = false; // invalidate form
			$validation_errors .= '<br />Name cannot be blank.'; // append validation message
		}
		
		// minimum length of 4 chars
		if (strlen($name) < 4) {
			$validated = false; // invalidate form
			$validation_errors .= '<br />Name must be at least 4 characters.'; // append validation message
		}
		
		// field can't be blank
		if (empty($category_id)) {
			$validated = false; // invalidate form
			$validation_errors .= '<br />Please select a category.'; // append validation message
		}
		
		// field must be a number
		if (!is_numeric($price)) {
			$validated = false; // invalidate form
			$validation_errors .= '<br />Price must be a number.'; // append validation message
		}
		
		// field must be a minimum value
		if ($price < 0) {
			$validated = false; // invalidate form
			$validation_errors .= '<br />Price cannot be negative.'; // append validation message
		}
		
		// validation check
		if (!$validated) {
			echo '<p>The following errors have been found:' . $validation_errors .
			'<br />Please go back and correct these errors.</p>';
			break; // terminate case
		}
		
		// build query
		if (empty($id)) {
			$query = "INSERT INTO ";
		} else {
			$query = "UPDATE ";
		}
		
		$query .= "options SET " .
				 "name = '" . $name . "', " .
				 "price = '" . $price . "', " .
				 "category_id = '" . $category_id . "' ";
	
		// non-concatenated version:
		//$query = "INSERT INTO options SET name = '{$_POST['name']}', price = '{$_POST['price']}', category_id = '{$_POST['category']}' ";
		
		if (!empty($id)) { $query .= "WHERE id = '$id' "; }
		
		// send query
		$result = @mysql_query($query);
		// check result and display feedback
		if (!$result) {
			// query error or other failure
			echo '<p>Query error.<br />' . $query . '</p>';
			break; // terminate case
		}
		// successful insert
		echo "<p>The database has been updated.</p>";
		
	break; // PROCESS
	
	case 'DELETE':
		// check for id
		if (empty($id)) {
			echo '<p>Invalid id specified.</p>';
			break; 
		}
		
		?>
        	<p>Are you sure you want to delete this record? This action cannot be undone.</p>
            <form action="admin-options.php?action=delete-confirm&id=<?php echo $id; ?>" method="post">
            	<input type="submit" value="Yes, delete it" />
            </form>
        <?php
	break;
	
	case 'DELETE-CONFIRM':
		// check for id
		if (empty($id)) {
			echo '<p>Invalid id specified.</p>';
			break; 
		}
		
		$query = "DELETE FROM options WHERE id = '$id' ";
		if (!$result = @mysql_query($query)) {
			echo '<p>Query error.<br />' . $query . '</p>';
			break;
		} 
		echo '<p>The record has been deleted.</p>';
	
	break;
	
} // switch $action

include('footer.php');
?>