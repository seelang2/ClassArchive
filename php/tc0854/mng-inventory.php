<?php
require_once('config.php');

include('header.php');
?>

<?php


$mode = 'LIST';

if (!empty($_GET['mode'])) $mode = strtoupper($_GET['mode']); 

if (!empty($_GET['id'])) $id = mysql_escape_string($_GET['id']); else unset($id);

switch($mode)
{
	// process record edit
	case 'PROCESSEDIT':
		if (empty($id)) {
			// id not present, display error and break out
			echo 'Error: ID value missing.';
			break;
		}
	
	// process add from form
	case 'PROCESSADD':
		// check to see if form submitted
		if (!empty($_POST['butSubmit'])) {
			
			// basic validation
			$validated = true;
			$errmsg = '';
			
			// check that firstname ha a value
			if (empty($_POST['manufacturer_id'])) {
				$validated = false;
				$errmsg .= '<br />You must select a manufacturer.';
			}
			
			// check that lastname ha a value
			if (empty($_POST['model_number'])) {
				$validated = false;
				$errmsg .= '<br />The Model Number field cannot be blank.';
			}
			
			// check that email ha a value
			if ($_POST['type'] == 0) {
				$validated = false;
				$errmsg .= '<br />You must select a type.';
			}
			
			// check that password ha a value
			if (empty($_POST['btu'])) {
				$validated = false;
				$errmsg .= '<br />The BTU field cannot be blank.';
			}
			
			// check that login ha a value
			if (empty($_POST['afue'])) {
				$validated = false;
				$errmsg .= '<br />The AFUE field cannot be blank.';
			}
			
			// check that cost ha a value
			if ($_POST['cost'] < 0.10) {
				$validated = false;
				$errmsg .= '<br />The Cost field must be greater than $0.10.';
			}
			
			if ($validated) {
				if (empty($id)) $query = "INSERT INTO "; else $query = "UPDATE ";
				
				$query .= "inventory SET " . 
						  "btu='" . mysql_escape_string($_POST['btu']) . "', " .
						  "type='" . mysql_escape_string($_POST['type']) . "', " .
						  "afue='" . mysql_escape_string($_POST['afue']) . "', " .
						  "model_number='" . mysql_escape_string($_POST['model_number']) . "', " .
						  "manufacturer_id='" . mysql_escape_string($_POST['manufacturer_id']) . "', " .
						  "cost='" . mysql_escape_string($_POST['cost']) . "'";
				
				// $query = "INSERT INTO users SET name='{$_POST['name']}'"; <-- avoid using
				
				if (!empty($id)) $query .= " WHERE id='$id'";
				
				$result = @mysql_query($query);
				
				if (!$result) {
					// query error
					echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
				} else {
					// successfull add
					echo '<p>The database was successfully updated. Query: ' . $query . '</p>';
				
				} // if result
			} else {
				// form data not validated, display error message
				echo '<p>The following errors have been encountered: ' . $errmsg . '<br />Please go back and try again.</p>';
				echo '<pre>' . print_r($_POST, true) . '</pre>';
			}
		} // if butSubmit
	
	break; // processadd
	
	
	// edit record
	case 'EDIT':
		if (!empty($id)) {
		
			$query = "SELECT btu, type, afue, model_number, manufacturer_id, cost FROM inventory WHERE id='$id' LIMIT 1";
			
			$result = @mysql_query($query);
			if (!$result || mysql_num_rows($result) != 1) {
				// query error or no record found -display error
				echo 'Query error or no record found - no soup for you';
			} else {
				$row = mysql_fetch_array($result);
				$querystring = '?mode=processedit&id=' . $id;
			} // if result
		} // if empty id
	
	// display form
	case 'ADD':
		
		// get list of manufacturers
		$query = 'SELECT id, name FROM manufacturers';
		if (!$result = @mysql_query($query)) {
			// query error
		
		} else {
			// build select tag
			$mfg_list = '<select name="manufacturer_id"><option value="">Select a Manufacturer</option>';
			while ($list = mysql_fetch_array($result)) {
				$mfg_list .= '<option value="' . $list['id'] . '" ';
				if ($row['manufacturer_id'] == $list['id']) $mfg_list .= 'selected="selected"';
				$mfg_list .= '>' . $list['name'] . '</option>';
			}
			$mfg_list .= '</select>';
			
			$invtype_list = '<select name="type">';
			reset($inventoryTypes);
			foreach($inventoryTypes as $id => $desc) {
				$invtype_list .= '<option value="' . $id . '" ';
				if ($row['type'] == $id) $invtype_list .= 'selected="selected"';
				$invtype_list .= '>' . $desc . '</option>';
			}
			$invtype_list .= '</select>';
		}
		
		
		if (empty($querystring)) $querystring = '?mode=processadd';
?>		
		<form action="<?php echo $_SERVER['PHP_SELF'] . $querystring; ?>" method="post">
			<div><label for="manufacturer_id">Manufacturer:</label><?php echo $mfg_list; ?></div>
			<div><label for="model_number">Model Number:</label><input type="text" name="model_number" value="<?php echo $row['model_number']; ?>" size="50" /></div>
			<div><label for="type">Type:</label><?php echo $invtype_list; ?></div>
			<div><label for="btu">BTU:</label><input type="text" name="btu" value="<?php echo $row['btu']; ?>" size="50" /></div>
			<div><label for="afue">AFUE:</label><input type="text" name="afue" value="<?php echo $row['afue']; ?>" size="50" /></div>
			<div><label for="cost">Cost:</label><input type="text" name="cost" value="<?php echo $row['cost']; ?>" size="50" /></div>
			<div><input type="submit" name="butSubmit" value="Save Record" /></div>
		</form>
	
<?php	
	break; // add
	
	// list (read) records
	case 'LIST':
		// built query
		$query = "SELECT inventory.id, type, btu, afue, model_number, name, cost " .
				 "FROM inventory, manufacturers " .
				 "WHERE manufacturers.id = manufacturer_id";
		
		// send query to db
		$results = @mysql_query($query);
		
		// check response
		
		if (!$results) {
			// query error - display message
			echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
		} else {
			if (mysql_num_rows($results) < 1) {
				// no results returned
				echo '<p>No rows present.</p>';
			} else {
				// process results
				echo '<table border="0" cellpadding="3" cellspacing="0">' .
					 '<tr>' . 
					 '<th>ID</th>' .
					 '<th>Manufacturer</th>' .
					 '<th>Model #</th>' .
					 '<th>Type</th>' .
					 '<th>BTU</th>' .
					 '<th>AFUE</th>' .
					 '<th>Cost</th>' .
					 '<th>Options</th>' . 
					 '</tr>';

				while ($row = mysql_fetch_array($results)) {
					echo "<tr>" .
							"<td>" . $row['id'] . "</td>" .
							"<td>" . $row['name'] . "</td>" .
							"<td>" . $row['model_number'] . "</td>" .
							"<td>" . $inventoryTypes[$row['type']] . "</td>" .
							"<td>" . $row['btu'] . "</td>" .
							"<td>" . $row['afue'] . "</td>" .
							"<td>" . $row['cost'] . "</td>" .
							"<td>" .
								'<a href="' . $_SERVER['PHP_SELF'] . '?mode=edit&id=' . $row['id'] . '">Edit</a> | ' . 
								'<a href="' . $_SERVER['PHP_SELF'] . '?mode=delete&id=' . $row['id'] . '">Delete</a>' . 
							"</td>" .
						 "</tr>";
				}
				
				echo '</table>';

			} // if num rows
		} // if result
	break;

	// delete record
	case 'DELETE':
		if (empty($id)) {
			// id not present, display error and break out
			echo 'Error: ID value missing.';
			break;
		}
		
		$query = "DELETE FROM inventory WHERE id='$id'";
		
		if (!$result = @mysql_query($query)) {
			// error
			echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
		} else {
			// success
			echo '<p>The database was successfully updated. Query: ' . $query . '</p>';
		}
	break;

} // switch




include('footer.php');
?>