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
		if (isset($_POST['description'])) $description = escape($_POST['description']);
		if (isset($_POST['cme'])) $cme = escape($_POST['cme']);
		if (isset($_POST['category_id'])) $category_id = escape($_POST['category_id']);
		
		// validation rules
		
		// check for blank fields
		if (empty($name)) {
			$validated = false;
			$errors .= '<br />Name cannot be blank.';
		}
		
		if (empty($description)) {
			$validated = false;
			$errors .= '<br />Description cannot be blank.';
		}
		
		// CME must be numeric
		if (!is_numeric($cme)) {
			$validated = false;
			$errors .= '<br />CMEs must be numeric.';
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
		
		$query .= "courses SET " .
				  "name = '$name', " .
				  "description = '$description', " .
				  "cme = '$cme' ";
		
		if (!empty($id)) $query .= "WHERE id = '$id' ";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo '<p>There was an error with the query: ' . mysql_error() .
			'<br />Query: ' . $query . '</p>';
			break;
		}
		
		if (empty($id))
			$rowID = mysql_insert_id();
		else
			$rowID = $id;
		
		// insert into c2c link table
		if (empty($id))
			$query = 'INSERT INTO ';
		else
			$query = 'UPDATE ';
		
		$query .= "c2c SET course_id = '$rowID', category_id = '$category_id'";
		
		if (!empty($id)) $query .= "WHERE course_id = '$rowID ";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			
			// we should delete the original record IF it was a new record being created
			
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
		
		$query = "SELECT courses.id, courses.name, courses.cme, categories.name AS category ".
				 "FROM courses, c2c, categories " .
				 "WHERE courses.id = c2c.course_id " .
				 "AND c2c.category_id = categories.id " .
				 "AND courses.id = '$id' ";
		$result = @mysql_query($query);
		
		if ((!$result) || (mysql_num_rows($result) != 1)) {
			// query error or wrong # rows
			echo '<p>Query error. No soup for you!</p>';
			break;
		}
		
		$record = mysql_fetch_array($result);
		
		// store course info in session
		$_SESSION['course_id'] = $record['id'];
		$_SESSION['course_name'] = $record['name'];
		
		
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
            	<label for="description">Description:</label>
                <textarea name="description" id="description" rows="6" cols="30">
				<?php if (isset($record['description'])) echo $record['description']; ?>
                </textarea>
        	</div>
        	<div>
            	<label for="cme">CME:</label>
                <input name="cme" id="cme" value="<?php if (isset($record['cme'])) echo $record['cme']; ?>" />
        	</div>
        	<div>
            	<label for="category_id">Category:</label>
                <select id="category_id" name="category_id" size="1">
		<?php
			
			// retrieve category list
			$query = "SELECT id, name FROM categories";
			$results = @mysql_query($query);
			
			if ((!$results) || (mysql_num_rows($results) < 1)) {
				// query error or wrong # rows
				echo '<p>Query error or no categories</p>';
				break;
			}
			
			// loop through result rows and display as options
			while ($row = mysql_fetch_array($results)) {
				echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
			}
			
		?>
        		</select>
            </div>
            <div class="center">
            	<input type="submit" value="Update Database >>" />
            </div>
        </form>
		
        <p>
        <a href="adm_sessions.php?action=list">View Sessions Associated With This Course</a>
        </p>
		
		<?php
		
		
	break; // SHOWFORM
	
	// delete a record
	case 'DELETE':
		if (empty($id)) {
			// id not set or blank
			echo '<p>Invalid record specified.</p>';
			break;
		}
		
		$query = "DELETE FROM courses WHERE id = '$id' ";
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
		
		$query = "SELECT courses.id, courses.name, courses.cme, categories.name AS category ".
				 "FROM courses, c2c, categories " .
				 "WHERE courses.id = c2c.course_id " .
				 "AND c2c.category_id = categories.id ";
		
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
				'<th>CME</th>' .
				'<th>Category</th>' .
				'<th>Options</th>' .
			 '</tr>';
		
		while ($row = mysql_fetch_array($results)) {
			echo '<tr>' .
					'<td>' . $row['id'] . '</td>' .
					'<td>' . $row['name'] . '</td>' .
					'<td>' . $row['cme'] . '</td>' .
					'<td>' . $row['category'] . '</td>' .
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