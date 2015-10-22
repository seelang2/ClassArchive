<?php
require_once('config.php');

include('header.php');

echo '<h2>Current Course: '. $_SESSION['course_name'] . '</h2>';

switch($action)
{
	// process form data
	case 'PROCESS':
		
		// initialize validation
		$validated = true;
		$errors = '';
		
		// get data from $_POST
		$start_date = escape($_POST['start_date']);
		
		// validation rules
		
		// check for blank fields
		if (empty($start_date)) {
			$validated = false;
			$errors .= '<br />start_date cannot be blank.';
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
		
		$query .= "sessions SET start_date = '$start_date', course_id = '".$_SESSION['course_id']."' ";
		
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
		
		$query = "SELECT start_date FROM sessions WHERE id = '$id' ";
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
            	<label for="start_date">start_date:</label>
                <input name="start_date" id="start_date" value="<?php if (isset($record['start_date'])) echo $record['start_date']; ?>" />
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
		
		$query = "DELETE FROM sessions WHERE id = '$id' ";
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
		
		$query = "SELECT id, start_date FROM sessions";
		
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
				'<th>start_date</th>' .
				'<th>Options</th>' .
			 '</tr>';
		
		while ($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['start_date'] . '</td>' .
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