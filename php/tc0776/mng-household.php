<?php 
require_once('config.php');
include('header.php'); ?>

<p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=list">List Records</a>&nbsp;|&nbsp;
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=add">Add New Record</a>&nbsp;|&nbsp;
</p>


<?php


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
		$query = "SELECT id, acct_num, address, city, state, zip FROM households";
		
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
					 '<th>Account Number</th>' .
					 '<th>Address</th>' .
					 '<th>City</th>' .
					 '<th>State</th>' .
					 '<th>Zip</th>' .
					 '<th>Options</th>' .
					 '</tr>';
				
				$c = 1;
				while($row = mysql_fetch_array($results)) {
					echo '<tr ';
					if ($c % 2 == 0) echo 'class="evenrow"'; else echo 'class="oddrow"';
					echo '>';
					$c++;

					echo '<td>' . $row['id'] . '</td>' . 
						 '<td>' . $row['acct_num'] . '</td>' . 
						 '<td>' . $row['address'] . '</td>' . 
						 '<td>' . $row['city'] . '</td>' . 
						 '<td>' . $row['state'] . '</td>' . 
						 '<td>' . $row['zip'] . '</td>' .
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
			
			$query = "DELETE FROM households WHERE id = '$id'";
			
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
	
		$query = "SELECT acct_num, address, city, state, zip FROM households WHERE id='$id' LIMIT 1";
		
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
				<label for="acct_num">Account Number:</label>
				<input type="text" name="acct_num" value="
					<?php 
						/*
						  We use a ternary operator here to output either the $row variable
						  or a NULL to avoid any E_STRICT level warnings telling us that $row
						  is undefined. Not necessary in most cases, but is clean coding practice.
						*/
						echo (isset($row['acct_num'])) ? $row['acct_num'] : NULL; 
					?>
					" size="50" maxlength="12" />
			</div>
			<div>
				<label for="address">Address:</label>
				<input type="text" name="address" value="<?php echo $row['address']; ?>" size="50" maxlength="60" />
			</div>
			<div>
				<label for="city">City:</label>
				<input type="text" name="city" value="<?php echo $row['city']; ?>" size="50" maxlength="30" />
			</div>
			<div>
				<label for="state">State:</label>
				<input type="text" name="state" value="<?php echo $row['state']; ?>" size="50" maxlength="2" />
			</div>
			<div>
				<label for="zip">Zip Code:</label>
				<input type="text" name="zip" value="<?php echo $row['zip']; ?>" size="50" maxlength="5" />
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
	
		// validate and sanitize data to make it safe for SQL query
		//$formdata = $_POST;
		
		$validated = true;
		$errmsg = '';
		$formdata = array();
		
		// check for blank fields
		
		if (empty($_POST['acct_num'])) {
			$errmsg .= '<br />The Account Number field cannot be blank.';
			$validated = false;
		} else {
			// move sanitized value to 
			$formdata['acct_num'] = escape($_POST['acct_num']);
		}
		
		if (empty($_POST['address'])) {
			$errmsg .= '<br />The Address field cannot be blank.';
			$validated = false;
		} else {
			// move sanitized value to 
			$formdata['address'] = escape($_POST['address']);
		}
		
		if (empty($_POST['city'])) {
			$errmsg .= '<br />The City Number field cannot be blank.';
			$validated = false;
		} else {
			// move sanitized value to 
			$formdata['city'] = escape($_POST['city']);
		}
		
		if (empty($_POST['state'])) {
			$errmsg .= '<br />The State field cannot be blank.';
			$validated = false;
		} else {
			// move sanitized value to 
			$formdata['state'] = escape($_POST['state']);
		}
		
		if (empty($_POST['zip'])) {
			$errmsg .= '<br />The Zip Code field cannot be blank.';
			$validated = false;
		} else {
			// move sanitized value to 
			$formdata['zip'] = escape($_POST['zip']);
		}
		
		// check for minimum length
		if (strlen($_POST['address']) < 3) {
			$errmsg .= '<br />The Address field must be longer than 3 characters.';
			$validated = false;
		}
		
		if (!$validated) {
			echo '<p>There was a problem with your form.' . $errmsg . '<br />Please go back and try again.</p>';
			break;
		}
		
		
		if (isset($id)) { 
			$query = 'UPDATE '; 
		} else { 
			$query = 'INSERT INTO '; 
		}
		
		$query .= 'households SET ';
		
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
