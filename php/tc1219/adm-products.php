<?php
require_once('config.php');

include('header.php');
?>
<p>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=list">List Records</a> |
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=showform">Add New Record</a>
</p>
<?php


$action = 'LIST';
if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

if (!empty($_GET['id'])) $id = escape($_GET['id']); else unset($id);

switch($action) {
	case 'DELETE':
		if (empty($id)) {
			// no id, don't continue
			echo '<p>Error: No id present.</p>';
		} else {
			$query = "DELETE FROM products WHERE id = '$id'";
			
			$result = @mysql_query($query);
			
			if (!$result) {
				// query error
				echo "<p>There was an error in the query:<br />$query</p>";
			} else {
				if (mysql_affected_rows() > 0) {
					echo '<p>Row was successfully deleted.</p>';
				} else {
					echo '<p>No rows were deleted.</p>';
				}
			}
		}
	break; // delete
	
	default:
	case 'LIST':
		
		$query = 'SELECT d.id, d.name AS prodname, LEFT(d.description, 10) AS description, d.sku, d.price, d.qty, c.name AS catname' . 
				 ' FROM products AS d, categories AS c' .
				 ' WHERE c.id = d.category_id' .
				 ' ORDER BY d.sku ASC';
		
		$results = @mysql_query($query);
		
		if (!$results) {
			// query error
			echo "<p>There was an error in the query:<br />$query</p>";
		} else {
			// query ok, continue
			if (mysql_num_rows($results) < 1) {
				// no rows in result set
				echo "<p>No rows present.</p>";
			} else {
				// loop through result set and display

				echo '<table border="1" cellpadding="3" cellspacing="0">';
				echo '<tr>' . 
					 '<th>ID</th>' . 
					 '<th>Product Name</th>' .
					 '<th>Description</th>' .
					 '<th>SKU</th>' .
					 '<th>Price</th>' .
					 '<th>Quantity</th>' .
					 '<th>Category</th>' .
					 '<th>Options</th>' .
					 '</tr>';
				while($row = mysql_fetch_array($results)) {
					echo '<tr>' .
						'<td>' . $row['id'] . '</td>' .
						'<td>' . $row['prodname'] . '</td>' .
//						'<td>' . substr($row['description'],0,10) . '...</td>' .
						'<td>' . $row['description'] . '...</td>' .
						'<td>' . $row['sku'] . '</td>' .
						'<td>' . $row['price'] . '</td>' .
						'<td>' . $row['qty'] . '</td>' .
						'<td>' . $row['catname'] . '</td>' .
						'<td>' . 
							'<a href="' . $_SERVER['PHP_SELF'] . '?action=edit&id=' . $row['id'] . '">Edit</a> | ' . 
							'<a href="' . $_SERVER['PHP_SELF'] . '?action=delete&id=' . $row['id'] . '">Delete</a>' . 
						 '</td>' .
						'</tr>';
				} // while
				echo '</table>';

			} // if num_rows
		} // if results
	break; // list
	
	case 'EDIT':
		if (empty($id)) {
			// no id present
			echo '<p>No id present.</p>';
		} else {
			// look up record
			$query = "SELECT name, description, sku, price, qty, category_id FROM products WHERE id = '$id' LIMIT 1";
			
			$result = @mysql_query($query);
			if (!$result || mysql_num_rows($result) == 0) {
				// query error or no matching rows in db
				echo '<p>Query error or the record could not be found.</p>';
			} else {
				// row found, get result and place in array
				$record = mysql_fetch_array($result);
			}
			
		}
	
	case 'SHOWFORM':
	
		// get categories for select box
		$query = 'SELECT id, name FROM categories';
		$catlist = @mysql_query($query);
		
	?>
		<form 
			action="<?php echo $_SERVER['PHP_SELF']; ?>?action=ProcessADD<?php if (!empty($id)) echo '&id='.$id; ?>" 
			method="post">
			<div>
				<label for="name">Name:</label>
				<input name="name" size="40" maxlength="60" value="<?php if (!empty($record['name'])) echo $record['name']; ?>" />
			</div>
			<div>
				<label for="sku">SKU:</label>
				<input name="sku" size="40" maxlength="60" value="<?php if (!empty($record['sku'])) echo $record['sku']; ?>" />
			</div>
			<div>
				<label for="price">Price:</label>
				<input name="price" size="40" maxlength="60" value="<?php if (!empty($record['price'])) echo $record['price']; ?>" />
			</div>
			<div>
				<label for="qty">Quantity:</label>
				<input name="qty" size="40" maxlength="60" value="<?php if (!empty($record['qty'])) echo $record['qty']; ?>" />
			</div>
			<div>
				<label for="category_id">Category:</label>
				<?php
				if (!$catlist) {
					// query error
					echo '<p>No Categories Defined</p>';
				} else {
					echo '<select name="category_id">';
					echo '<option value="">Please select a category</option>';
						while($catrow = mysql_fetch_array($catlist)) {
							echo '<option value="'.$catrow['id'].'"';
							if ($record['category_id'] == $catrow['id']) echo ' selected="selected"';
							echo '>'.$catrow['name'].'</option>';
						} // while
					echo '</select>';
					
				} // if catlist
				
				?>
				
			</div>
			<div>
				<label for="description">Description:</label>
				<textarea name="description" rows="10" cols="60"><?php if (!empty($record['description'])) echo $record['description']; ?></textarea>
			</div>
			<div><input type="submit" name="butSubmit" value="Save Record" /></div>
		</form>
	<?php
	break; // showform
	
	case 'PROCESSADD':
		
		// get data from form
		$name = escape($_POST['name']);
		$description = escape($_POST['description']);
		$sku = escape($_POST['sku']);
		$price = escape($_POST['price']);
		$qty = escape($_POST['qty']);
		$category_id = escape($_POST['category_id']);
		
		// validation rules
		$validated = true;
		$err_message = '';
		
		if (empty($name)) { // name must not be empty
			$validated = false;
			$err_message .= '<br />Name field cannot be blank.';
		}
		
		if (empty($description)) { // name must not be empty
			$validated = false;
			$err_message .= '<br />description field cannot be blank.';
		}
		
		if (empty($sku)) { // name must not be empty
			$validated = false;
			$err_message .= '<br />sku field cannot be blank.';
		}
		
		if (empty($price)) { // name must not be empty
			$validated = false;
			$err_message .= '<br />price field cannot be blank.';
		}
		
		if (empty($qty)) { // name must not be empty
			$validated = false;
			$err_message .= '<br />qty field cannot be blank.';
		}
		
		if (empty($category_id)) { // name must not be empty
			$validated = false;
			$err_message .= '<br />category_id field cannot be blank.';
		}
		
		// check validation state
		if (!$validated) {
			echo '<p>The following errors have occurred:';
			echo $err_message . '</p>';
			echo '<p>Please go back and correct them.</p>';
			break; // terminates case
		}
		
		if (empty($id)) $query = 'INSERT INTO '; else $query = 'UPDATE ';
		
		$query .= "products SET " .
				  "name = '" . $name . "', " .
				  "description = '" . $description . "', " .
				  "sku = '" . $sku . "', " .
				  "price = '" . $price . "', " .
				  "qty = '" . $qty . "', " .
				  "category_id = '" . $category_id . "'";
		
		if (!empty($id)) $query .= " WHERE id = '$id'";
		
		$result = @mysql_query($query);
		
		if (!$result) {
			// query error
			echo "<p>There was an error in the query:<br />$query</p>";
		} else {
			echo '<p>Record has been ';
			if (empty($id)) echo 'added.</p>'; else echo 'updated.</p>';
		}
		
	break; // process

/*
	default:
		echo '<p>Invalid action specified. No soup for you!</p>';
	break; // default
*/
} // switch

include('footer.php');
?>