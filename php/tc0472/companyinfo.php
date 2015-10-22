<?php
/**********************************************************
companyinfo.php - company info management script
Training Connection Class #472 Nov 5-7, 2002
Instructor: Chris Langtiw seelang2@gmail.com

**********************************************************/

require_once('config.php');

include ('header.php');
?>

<p><a href="<?php echo $me; ?>?mode=add">Add new Company</a> <a href="<?php echo $me; ?>?mode=list">List Companies</a></p>

<?php
$mode = 'LIST';			// set default option to LIST records
$validated = true;		// initial validation flag setting
$errmsg = '';			// set error message as empty initially

// get script processing mode and convert to uppercase to avoid inconsistency issues
if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = strtoupper($_GET['mode']);

// do some form validation
if ($mode == 'PROCESS' && isset($_POST['submit'])) {
	if (isset($_POST['name']) && $_POST['name'] != '') $name = escape($_POST['name']); else $validated = false;
	if (isset($_POST['address1']) && $_POST['address1'] != '') $address1 = escape($_POST['address1']); else $validated = false;
	if (isset($_POST['address2']) && $_POST['address2'] != '') $address2 = escape($_POST['address2']); else $address2 = '';
	if (isset($_POST['city']) && $_POST['city'] != '') $city = escape($_POST['city']); else $validated = false;
	if (isset($_POST['state']) && $_POST['state'] != '') $state = escape($_POST['state']); else $validated = false;
	if (isset($_POST['zip']) && $_POST['state'] != '') $state = escape($_POST['state']); else $validated = false;
	if (isset($_POST['url']) && $_POST['url'] != '') $url = escape($_POST['url']); else $url = '';
	if (isset($_POST['cats'])) $cats = $_POST['cats']; else $cats = array();
	
//echo '<pre>' . print_r($cats, true) . '</pre>'; exit;
} else $validated = false;

// if we're trying to process the form data and we flunked validation switch to ADD mode and display an error message
if ($mode == 'PROCESS' && !$validated) {
	$mode = 'ADD';
	$errmsg = '<p>One or more required fields are blank.</p>';
}

switch($mode)
{
	case 'PROCESS':
		if (isset($_GET['id']) && $_GET['id'] != '') $id = escape($_GET['id']); else unset($id);
		
		if (isset($id)) $query = 'UPDATE'; else $query = 'INSERT INTO';
		
		$query .= " company_info SET " . 
					"name='$name'," . 
					"address1='$address1'," . 
					"address2='$address2'," . 
					"city='$city'," . 
					"state='$state'," . 
					"zip='$zip'," . 
					"url='$url'"
		;
		
		if (isset($id)) $query .= " WHERE id = '$id'";
		
		echo "<p>Query: $query</p>";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// display an error message
			echo "<p>Error inserting record into database<br />Query: $query</p>";
		} else {
			// get new company record id
			if (!isset($id)) {
				// Handle an INSERT C2C
				
				// get company info record inserted id
				$id = mysql_insert_id();
				
				foreach($cats as $cat_id) {
					$query = "INSERT INTO companies_to_categories SET company_id = '$id', category_id = '$cat_id'";
					$result = mysql_query($query);
					if (!$result) {
						// Error occurred - remove existing cat records for this company
						$query = "DELETE FROM companies_to_categories WHERE company_id = '$id'";
						$result = mysql_query($query);
						if (!$result) {
							// now we're screwed - contact the admin to clean this up
							echo "An error has occurred. Please contact the system administrator.";
							break;
						} else {
							// Now remove the parent company record
							$query = "DELETE FROM company_info WHERE id = '$id'";
							$result = mysql_query($query);
							if (!$result) {
								// alas, screwed again.
								echo "An error has occurred. Please contact the system administrator.";
								break;
							} else {
								// display friendlier error message
								echo 'Unable to add company record into database.';
								break;
							}
						}
					} // initial error
				}
			
			} else {
				// Handle and UPDATE C2C
			
				// first delete any existing category records for this company
				$query = "DELETE FROM companies_to_categories WHERE company_id = '$id'";
				$result = mysql_query($query);
				if (!$result) {
					// handle error
					echo 'Unable to update company category info.';
				} else {
					// now add the newly updated categories
					foreach($cats as $cat_id) {
						$query = "INSERT INTO companies_to_categories SET company_id = '$id', category_id = '$cat_id'";
						$result = mysql_query($query);
						if (!$result) {
							echo 'Unable to update company category info.';
							break; // drop out of loop
						} 
					} // foreach category 
				} // if delete query result set ok
			} // if update or insert into
		} // if company info insert ok
	
	// NO BREAK for case PROCESS
	
	case 'LIST':
	
		$query = "SELECT a.id, a.name, a.city, a.state FROM company_info AS a";
		
		$results = mysql_query($query);
		if (!$results) {
			echo "<p>There was an error running the query $query</p>";
		} else {
			if (mysql_num_rows($results) < 1) {
				echo "<p>No rows found.</p>";
			} else {
				// process result set
				
				echo '<table border="0" cellpadding="3" cellspacing="0"><tr>' .
					'<td>ID</td>' . 
					'<td>Company Name</td>' .
					'<td>City</td>' . 
					'<td>State</td>' . 
					'<td>Options</td>' . 
					'</tr>';
				
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						'<td>' . $row['id'] . '</td>' . 
						'<td>' . $row['name'] . '</td>' .
						'<td>' . $row['city'] . '</td>' .
						'<td>' . $row['state'] . '</td>' .
						'<td><a href="' . $me . '?mode=edit&id=' . $row['id'] . '">Edit</a> ' .
						'<a href="' . $me . '?mode=delete&id=' . $row['id'] . '">Delete</a>' .
						'</td></tr>';
				
				}
				
				echo '</table>';
			}
		}
	break; // case LIST
	
	case 'EDIT':
		if (isset($_GET['id']) && $_GET['id'] != '') $id = escape($_GET['id']); else $id = false;
		
		if ($id === false) {
			// display error message
			echo '<p>Invalid id or id not present</p>';	
		} else {
			// continue as planned
			$query = "SELECT name, address1, address2, city, state, zip, url FROM company_info WHERE id = '$id'";
			
//			echo "<p>Query used: $query</p>";
			
			$result = mysql_query($query);
			
			if (!$result) {
				// display error messasge
				echo '<p>The requested record could not be found.</p>';
			} else {
				// continue processing
				$row = mysql_fetch_array($result);
				$qsappend = "&id=$id";
				
				$query = "SELECT category_id FROM companies_to_categories WHERE company_id = '$id'";
				$results = mysql_query($query);
				
				$selectedcats = array();
				
				if (mysql_num_rows($results) > 0) {
					while ($tmp = mysql_fetch_array($results)) {
						$selectedcats[] = $tmp[0];
					}
				}
				
				
//				echo '<pre>' . print_r($selectedcats, true) . '</pre>';
			}
		}
	
	case 'ADD':
?>
<h2>Add New Company</h2>
<?php echo $errmsg; ?>

<form action="<?php echo $me; ?>?mode=process<?php echo $qsappend; ?>" method="post">
	<div><label for="name">Company Name:</label><input type="text" name="name" value="<?php echo $row['name']; ?>" /></div>
	<div><label for="address1">Address 1:</label><input type="text" name="address1" value="<?php echo $row['address1']; ?>" /></div>
	<div><label for="address2">Address 2:</label><input type="text" name="address2" value="<?php echo $row['address2']; ?>" /></div>
	<div><label for="city">City:</label><input type="text" name="city" value="<?php echo $row['city']; ?>" /></div>
	<div><label for="state">State:</label><input type="text" name="state" value="<?php echo $row['state']; ?>" /></div>
	<div><label for="zip">Zip:</label><input type="text" name="zip" value="<?php echo $row['zip']; ?>" /></div>
	<div><label for="url">URL:</label><input type="text" name="url" value="<?php echo $row['url']; ?>" /></div>

	<div><label for="cats[]">Categories:</label>
<?php

	$query = "SELECT id, name FROM categories";
	$results = mysql_query($query);
	if (!$results) {
		// error with query
		
	} else {
		if (mysql_num_rows($results) < 1) {
			// no cats
		} else {
			// build select
			echo '<select name="cats[]" size="4" multiple="multiple" id="selectitem">';
			
				while ($row = mysql_fetch_array($results)) {
					echo '<option';
					if (isset($selectedcats)) if (in_array($row['id'], $selectedcats)) echo ' selected="selected"';
					echo ' value="' . $row['id'] . '">' . $row['name'] . '</option>';
				
				}
			echo '</select>';
		
		}
	}

?>
	</div>
	<div><input type="submit" name="submit" value="Continue" /></div>
</form>


<?php
	break; // case ADD
	
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
	
	break; // case DELETE
	
	default:
		echo "<p>Invalid action. No soup for you!</p>";
} // switch

include ('footer.php');
?>