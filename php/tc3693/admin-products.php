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
		$query = 'SELECT products.id, products.name as productname, products.price, categories.name as category ' . 
				 'FROM products, categories ' .
				 'WHERE products.category_id = categories.id';
		
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
					'<td>' . $row['productname'] . '</td>' .
					'<td>' . $row['price'] . '</td>' .
					'<td>' . $row['category'] . '</td>' .
					'<td>' . 
						'<a href="'.$_SERVER['PHP_SELF'].'?action=edit&id=' . $row['id'] . '">Edit</a>' .
						' | <a href="'.$_SERVER['PHP_SELF'].'?action=delete&id=' . $row['id'] . '">Delete</a>' .
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
		$query = "SELECT name, price, description, category_id FROM products WHERE id = '$id' ";
		$result = @mysql_query($query); // send query
		if (!$result || mysql_num_rows($result) != 1) {
			echo '<p>Invalid id or record not found.</p>'; // error
			break;
		}
		$item = mysql_fetch_array($result); // get row and store in var
		
	// this break is intentionally left blank.
	
	case 'ADD': // display blank form
		
	?>
        <h2>Add/Edit Product</h2>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=process<?php echo empty($id)?NULL:'&id='.$id; ?>" method="post">
        	<div>
            	<label for="name">Product Name:</label>
                <input type="text" id="name" name="name" 
                	value="<?php echo empty($item['name'])? NULL : $item['name']; ?>" />
            </div>
        	<div>
            	<label for="description">Description:</label>
                <textarea id="description" name="description" ><?php echo empty($item['description'])? NULL : $item['description']; ?></textarea>
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
            
            <!-- options -->
            <h2>Options</h2>
            <div>
            <?php
			$productOptions = array(); // array to store procut option combo list
			
			// if $id not set a query error will occur with new record
			if (empty($id)) $id = -1;
			
			$query = "SELECT 
						options.id AS optionid, 
						options.name AS optionname, 
						products.id AS productid 
					  FROM options 
					  LEFT JOIN p2o ON p2o.option_id = options.id 
					  LEFT JOIN products ON p2o.product_id = $id";
			$results = @mysql_query($query);
			if (!$results) {
				echo '<p>Query error.<br />' . $query . '</p>';
				break; // terminate case
			}
			// loop through result set and build array
			while ($row = mysql_fetch_array($results, MYSQL_ASSOC)) {
				$productOptions[] = $row;
			} // while
			//echo '<pre>' . print_r($productOptions, true) . '</pre>';
			
			foreach($productOptions as $row) {
				?>
                <div>
                    <label>
                        <input type="checkbox" name="options[]" 
                        	<?php echo $row['productid'] == $id ? ' checked="checked" ' : NULL; ?>
                            value="<?php echo $row['optionid']; ?>" />&nbsp;
                        <?php echo $row['optionname']; ?>
                    </label>
                </div>
				<?php
			}
			?>
            
            </div>
            
            
        	<div>
                <input type="submit" value="Update Database" />
            </div>
        </form>
    <?php
		
	break; // ADD
	
	case 'PROCESS': // process form data
		
		// sanitize form data to make it safe from injection attacks
		$name = mysql_escape_string($_POST['name']);
		$description = mysql_escape_string($_POST['description']);
		$price = mysql_escape_string($_POST['price']);
		$category_id = mysql_escape_string($_POST['category']);
		
		
		// build query
		if (empty($id)) {
			$query = "INSERT INTO ";
		} else {
			$query = "UPDATE ";
		}
		
		$query .= "products SET " .
				 "name = '" . $name . "', " .
				 "price = '" . $price . "', " .
				 "description = '" . $description . "', " .
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
		// successful db update
		
		// if this is an edit, delete any existing P2O records for this product
		if (!empty($id)) {
			$query = "DELETE FROM p2o WHERE product_id = '$id'";
			// send query
			$result = @mysql_query($query);
			// check result and display feedback
			if (!$result) {
				// query error or other failure
				echo '<p>Query error.<br />' . $query . '</p>';
				break; // terminate case
			}
		} 
		
		// grab last insert id if this is an insert
		if (empty($id)) {
			$id = mysql_insert_id(); 
		}
		
		// build query
		$query = "INSERT INTO `p2o` (`id`, `product_id`, `option_id`) VALUES ";
		$c = 1;
		// loop through posted options and insert into p2o table
		foreach($_POST['options'] as $optionid) {
			$query .= $c > 1 ? ',' : '';
			$query .= "(NULL, '$id', '$optionid')";
			$c++;
		}
		
		echo "<p>$query</p>";
		
		// send query
		$result = @mysql_query($query);
		// check result and display feedback
		if (!$result) {
			// query error or other failure
			echo '<p>Query error.<br />' . $query . '</p>';
			break; // terminate case
		}
		
		// finished
		echo "<p>The database has been updated.</p>";

		//echo '<pre>' . print_r($_POST, true) . '</pre>';
		
	break; // PROCESS
	
	case 'DELETE':
		// check for id
		if (empty($id)) {
			echo '<p>Invalid id specified.</p>';
			break; 
		}
		
		?>
        	<p>Are you sure you want to delete this record? This action cannot be undone.</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete-confirm&id=<?php echo $id; ?>" method="post">
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
		
		$query = "DELETE FROM products WHERE id = '$id' ";
		if (!$result = @mysql_query($query)) {
			echo '<p>Query error.<br />' . $query . '</p>';
			break;
		} 
		echo '<p>The record has been deleted.</p>';
	
	break;
	
} // switch $action

include('footer.php');
?>