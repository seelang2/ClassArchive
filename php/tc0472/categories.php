<?php
/**********************************************************
categories.php - category management script
Training Connection Class #472 Nov 5-7, 2002
Instructor: Chris Langtiw seelang2@gmail.com

**********************************************************/
// load config file
require_once('config.php');

// include template header
include ('header.php');
?>
<!-- sub-menu -->
<p><a href="<?php echo $me; ?>?mode=add">Add new Category</a> | <a href="<?php echo $me; ?>?mode=list">List Categories</a></p>

<?php
$mode = 'LIST';			// set default option to LIST records
$validated = true;		// initial validation flag setting
$errmsg = '';			// set error message as empty initially

// get script processing mode and convert to uppercase to avoid inconsistency issues
if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = strtoupper($_GET['mode']);

// do some form validation
if ($mode == 'PROCESS' && isset($_POST['submit'])) {
	if (isset($_POST['name']) && $_POST['name'] != '') $name = escape($_POST['name']); else $validated = false;

} else $validated = false;

// if we're trying to process the form data and we flunked validation switch to ADD mode and display an error message
if ($mode == 'PROCESS' && !$validated) {
	$mode = 'ADD';
	$errmsg = '<p class="error">One or more required fields are blank.</p>';
}

switch($mode)
{
	case 'PROCESS':
		if (isset($_GET['id']) && $_GET['id'] != '') $id = escape($_GET['id']); else unset($id);
		
		if (isset($id)) $query = 'UPDATE'; else $query = 'INSERT INTO';
		
		$query .= " categories SET name='$name'";
		
		if (isset($id)) $query .= " WHERE id = '$id'";
		
		echo "<p>Query: $query</p>";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// display an error message
			echo "<p>Error inserting record into database<br />Query: $query</p>";
		} else {
			// everything's ok
			echo "<p>Successfully entered record into database.</p>";
		}
	
//	break;
	
	case 'LIST':
	
		$query = "SELECT id, name FROM categories";
		
		$results = mysql_query($query);
		if (!$results) {
			if (mysql_num_rows($results) < 1) {
				echo "<p>No rows found.</p>";
			} else {
				echo "<p>There was an error running the query $query</p>";
			}
		} else {
			// process result set
			
			echo '<table border="0" cellpadding="3" cellspacing="0"><tr><td>ID</td><td>Category Name</td><td>Options</td></tr>';
			
			while($row = mysql_fetch_array($results)) {
				echo "<tr><td>{$row['id']}</td><td>" . $row['name'] . '</td>' .
					'<td><a href="' . $me . '?mode=edit&id=' . $row['id'] . '">Edit</a> ' .
					'<a href="' . $me . '?mode=delete&id=' . $row['id'] . '">Delete</a>' .
					'</td></tr>';
			
			}
			
			echo '</table>';
		}
	break;
	
	case 'EDIT':
		if (isset($_GET['id']) && $_GET['id'] != '') $id = escape($_GET['id']); else $id = false;
		
		if ($id === false) {
			// display error message
			echo '<p>Invalid id or id not present</p>';	
		} else {
			// continue as planned
			$query = "SELECT name FROM categories WHERE id = '$id'";
			
//			echo "<p>Query used: $query</p>";
			
			$result = mysql_query($query);
			
			if (!$result) {
				// display error messasge
				echo '<p>The requested record could not be found.</p>';
			} else {
				// continue processing
				$row = mysql_fetch_array($result);
				$qsappend = "&id=$id";
			
//				echo '<pre>' . print_r($row, true) . '</pre>';
			}
		}
	
	case 'ADD':
?>
<h1>Add New Category</h1>
<?php echo $errmsg; ?>

<form action="<?php echo $me; ?>?mode=process<?php echo $qsappend; ?>" method="post">
	<div><label for="name">Category Name:</label> <input type="text" name="name" value="<?php echo $row['name']; ?>" /></div>
	<input type="submit" name="submit" value="Continue" />
</form>


<?php
	break;
	
	case 'DELETE':
		if (isset($_GET['id']) && $_GET['id'] != '') $id = escape($_GET['id']); else $id = false;
		
		if ($id === false) {
			// display error message
			echo '<p>Invalid id or id not present</p>';	
		} else {
			// continue as planned
			$query = "DELETE FROM categories WHERE id = '$id'";
			
//			echo "<p>Query used: $query</p>";
			
			$result = mysql_query($query);
			
			if (!$result) {
				// display error messasge
				echo '<p>The requested record could not be found.</p>';
			} else {
				// continue processing
				echo '<p>The record was deleted successfully.</p>';
			}
		}
	
	break;
	
	default:
		echo "<p>Invalid action. No soup for you!</p>";
} // switch

include ('footer.php');
?>