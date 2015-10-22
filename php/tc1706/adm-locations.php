<?php
require_once('config.php');

include('header.php');

switch($action)
{
	// process form data
	case 'PROCESS':
		
		// initialize validation
		$validated = true;
		$errors = '';
		
		// get data from $_POST and sanitize
		if (isset($_POST['name'])) $name = escape($_POST['name']);
		if (isset($_POST['address1'])) $address1 = escape($_POST['address1']);
		if (isset($_POST['address2'])) $address2 = escape($_POST['address2']);
		if (isset($_POST['city'])) $city = escape($_POST['city']);
		if (isset($_POST['st'])) $st = escape($_POST['st']);
		if (isset($_POST['zip'])) $zip = escape($_POST['zip']);
		
		// validation rules
		
		// check for blank fields
		if (empty($name)) {
			$validated = false;
			$errors .= '<br />Name cannot be blank.';
		}
		
		if (empty($address1)) {
			$validated = false;
			$errors .= '<br />Address 1 cannot be blank.';
		}
		
		if (empty($city)) {
			$validated = false;
			$errors .= '<br />City cannot be blank.';
		}
		
		if (empty($st)) {
			$validated = false;
			$errors .= '<br />State cannot be blank.';
		}
		
		if (empty($zip)) {
			$validated = false;
			$errors .= '<br />Zip cannot be blank.';
		}
		
		// State must be 2 characters
		if (strlen($st) != 2) {
			$validated = false;
			$errors .= '<br />State must be two letters.';
		}
		
		// Zip must be 5 characters long
		if (strlen($zip) != 5) {
			$validated = false;
			$errors .= '<br />Zip code must be 5 characters.';
		}
		
		// Zip must be numeric
		if (!is_numeric($zip)) {
			$validated = false;
			$errors .= '<br />Zip code must be numeric.';
		}
		
		// check validation
		if (!$validated) {
			echo '<p>The following problems were encountered:' . 
				 $errors . '<br />Please go back and correct those fields.</p>';
			break;
		}
		
		if (empty($id))
			$query = 'INSERT INTO ';
		else
			$query = 'UPDATE ';
		
		$query .= "locations SET " .
				  "name = '$name', " .
				  "address1 = '$address1', " .
				  "address2 = '$address2', " .
				  "city = '$city', " .
				  "st = '$st', " .
				  "zip = '$zip' ";
		
		if (!empty($id)) $query .= "WHERE id = '$id' ";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo '<p>There was an error with the query: ' . mysql_error() .
			'<br />Query: ' . $query . '</p>';
			break;
		}
		
		// success
		echo '<p>The database was updated successfully.</p>';
		
	break; // PROCESS
	
	// retrieve record to edit
	case 'EDIT':
		if (empty($id)) {
			// id not set or blank
			echo '<p>Invalid record specified.</p>';
			break;
		}
		
		$query = "SELECT name, address1, address2, city, st, zip FROM locations WHERE id = '$id' ";
		$result = @mysql_query($query);
		
		if ((!$result) || (mysql_num_rows($result) != 1)) {
			// query error or wrong # rows
			echo '<p>Query error. No soup for you!</p>';
			break;
		}
		
		$record = mysql_fetch_array($result);
	
	// display form
	case 'SHOWFORM':
		
		?>
		<form 
        	action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process<?php if (isset($id)) echo '&id='.$id; ?>" 
            method="post">
        	<div>
            	<label for="name">Name:</label>
                <input name="name" id="name" value="<?php if (isset($record['name'])) echo $record['name']; ?>" />
        	</div>
        	<div>
            	<label for="address1">Address 1:</label>
                <input name="address1" id="address1" value="<?php if (isset($record['address1'])) echo $record['address1']; ?>" />
        	</div>
        	<div>
            	<label for="address2">Address 2:</label>
                <input name="address2" id="address2" value="<?php if (isset($record['address2'])) echo $record['address2']; ?>" />
        	</div>
        	<div>
            	<label for="city">City:</label>
                <input name="city" id="city" value="<?php if (isset($record['city'])) echo $record['city']; ?>" />
        	</div>
        	<div>
            	<label for="st">State:</label>
                <input name="st" id="st" value="<?php if (isset($record['st'])) echo $record['st']; ?>" />
        	</div>
        	<div>
            	<label for="zip">Zip:</label>
                <input name="zip" id="zip" value="<?php if (isset($record['zip'])) echo $record['zip']; ?>" />
        	</div>
            <div class="center">
            	<input type="submit" value="Update Database >>" />
            </div>
        </form>
		<?php
		
	break; // SHOWFORM
	
	// delete a record
	case 'DELETE':
		if (empty($id)) {
			// id not set or blank
			echo '<p>Invalid record specified.</p>';
			break;
		}
		
		$query = "DELETE FROM locations WHERE id = '$id' ";
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo '<p>There was an error with the query: ' . mysql_error() .
			'<br />Query: ' . $query . '</p>';
			break;
		}
		
		// success
		echo '<p>The database was updated successfully.</p>';
		
	break; // DELETE
	
	
	default:
	// display a table of all records in the db table
	case 'LIST':
		
		$query = "SELECT id, name, city, st FROM locations";
		
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error
			echo '<p>There was an error with the query: ' . mysql_error() .
			'<br />Query: ' . $query . '</p>';
			break;
		}
		
		if (mysql_num_rows($results) == 0) {
			// no rows present
			echo '<p>No rows present.</p>';
			break;
		}
		
		echo '<table><tbody><tr>' .
				'<th>ID</th>' .
				'<th>Name</th>' .
				'<th>City</th>' .
				'<th>State</th>' .
				'<th>Options</th>' .
			 '</tr>';
		
		while ($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['name'] . '</td>' .
					'<td>' . $row['city'] . '</td>' .
					'<td>' . $row['st'] . '</td>' .
					'<td>' .
						'<a href="'.$_SERVER['PHP_SELF'].'?action=edit&id='. $row['id'] .'">Edit</a>' . ' | ' .
						'<a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='. $row['id'] .'">Delete</a>' .
					'</td>' .
				 '</tr>';
		} // while row
		
		echo '</tbody></table>';
		
		
		
	break; // LIST
	
	
	
} // switch

include('footer.php');
?>