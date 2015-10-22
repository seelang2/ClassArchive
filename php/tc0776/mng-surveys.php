<?php include('header.php'); ?>

<p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List Records</a>&nbsp;|&nbsp;
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add New Record</a>&nbsp;|&nbsp;
</p>


<?php

require_once('config.php');

/*

// connect to db server
$dbcnx = @mysql_connect('localhost', 'root', 'portable');

if (!$dbcnx) exit('<p>Error connecting to database server.</p>');

// select database
$dbh = @mysql_select_db('tc776', $dbcnx);

if (!$dbh) exit('<p>Error selecting database.</p>');

*/



$mode = 'LIST'; // default setting
if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']);
if (!empty($_GET['id'])) $id = $_GET['id']; else unset($id);

switch($mode)
{
	case 'LIST':
		
		// build query
		$query = "SELECT id, name, description FROM surveys";
		
		// send query
		$results = @mysql_query($query);
		
		// check response
		if (!$results) {
			// error with query
			echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
		} else {
			// query ok, continue
			if (mysql_num_rows($results) < 1) {
				// no rows present
				echo "<p>No rows present.</p>";
			} else {
				// process results
				
				echo '<table>' . 
					 '<tr>' . 
					 '<th>ID</th>' .
					 '<th>Name</th>' .
					 '<th>Options</th>' .
					 '</tr>';
				
				$c = 1;
				while($row = mysql_fetch_array($results)) {
					echo '<tr ';
					if ($c % 2 == 0) echo 'class="evenrow"'; else echo 'class="oddrow"';
					echo '>';
					$c++;

					echo '<td>' . $row['id'] . '</td>' . 
						 '<td>' . $row['name'] . '</td>' . 
						 '<td>' .
						 	'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a> | ' .
						 	'<a href="' . $_SERVER['PHP_SELF'] . '?mode=delete&id=' . $row['id'] . '">Delete</a>' .
						 '</td>' . 
						 '</tr>';
				}
				
				echo '</table>';
				
			} // num rows
		} // if results
	
	break;
	
	case 'DELETE':
		if (!isset($id)) {
			// no id passed - display error
			echo "<p>No valid ID is present.</p>";
		} else {
			// continue with delete operation
			
			$query = "DELETE FROM surveys WHERE id = '$id'";
			
			$result = @mysql_query($query);
			if (!$result) {
				// error with query
				echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
			} else {
				if (mysql_affected_rows() < 1) {
					// no rows deleted
					echo '<p>Warning: No rows were deleted.</p>';
				} else {
					echo '<p>Record was deleted successfully.</p>';
				}
			}
		}
	break;
	
	case 'EDIT':
	
		$query = "SELECT name, description FROM surveys WHERE id='$id' LIMIT 1";
		
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			// no row located
			echo '<p>The specified record could not be found.</p>';
		} else {
			// found row
			
			$row = mysql_fetch_array($result);
			
			$querystring = '?mode=processedit&id=' . $id;
		}
	
	case 'ADD':
		
		if (!isset($querystring)) $querystring = '?mode=processadd';
?>
		<form action="<?php echo $_SERVER['PHP_SELF'] . $querystring; ?>" method="post">
			<div>
				<label for="name">Name:</label>
				<input type="text" name="name" value="<?php echo $row['name']; ?>" size="50" maxlength="60" />
			</div>
			<div>
				<label for="description">Description:</label>
				<textarea name="description" rows="4" cols="50"><?php echo $row['description']; ?></textarea>
			</div>
			<input type="submit" name="butSubmit" value="Add/Update Record" />
		</form>
<?php	
	
	break;
	
	case 'PROCESSEDIT':
	
		if (!isset($id)) {
			echo '<p>No record specified. No soup for you!</p>';
			break;
		}
	
	case 'PROCESSADD':
	
		$formdata = array();
		foreach($_POST as $key => $value) {
			$formdata[$key] = escape($value);
		}
		
		reset($_POST);
		
		if (isset($id)) { 
			$query = 'UPDATE '; 
		} else { 
			$query = 'INSERT INTO '; 
		}
		
		$query .= 'surveys SET ';
		
		$c=0;
		foreach($formdata as $column => $value) {
			if ($column != 'butSubmit') {
				if ($c > 0) $query .= ', ';
				$query .= "$column = '$value'";
				$c++;
			}
		}
		
		if (isset($id)) $query .= " WHERE id='$id'";
		
		$result = mysql_query($query);
		if (!$result) {
			// error with query
			echo "<p>Error performing query: " . mysql_error() . "<br />Query: $query</p>";
		} else {
			// successfull add
			echo "<p>Database was successfully updated.<br />Query: $query</p>";
		}
		
	break;


} // switch

include('footer.php'); 
?>