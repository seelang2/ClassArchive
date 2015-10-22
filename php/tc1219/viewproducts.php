<?php
require_once('config.php');

include('header.php');

if (!empty($_GET['category_id'])) $search_cat = escape($_GET['category_id']); else unset($search_cat);
if (!empty($_GET['term'])) $search_term = escape($_GET['term']); else unset($search_term);
	

?>

<div id="searchform">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
		<?php

		// get categories for select box
		$query = 'SELECT id, name FROM categories';
		$catlist = @mysql_query($query);
		if (!$catlist) {
			// query error
			echo '<p>No Categories Defined</p>';
		} else {
			echo '<select name="category_id">';
			echo '<option value="">All categories</option>';
				while($catrow = mysql_fetch_array($catlist)) {
					echo '<option value="'.$catrow['id'].'"';
					if ($search_cat == $catrow['id']) echo ' selected="selected"';
					echo '>'.$catrow['name'].'</option>';
				} // while
			echo '</select>';
		} // if catlist
		
		?>
		&nbsp;Or Enter a search term:&nbsp;
		<input name="term" value="<?php echo $search_term; ?>" />
		
		<input type="submit" name="butSubmit" value="Search" />
	</form>

</div>

<div id="resulttable">

<?php
	
	$query = 'SELECT d.id, d.name AS prodname, LEFT(d.description, 10) AS description, d.sku, d.price, d.qty, c.name AS catname' . 
			 ' FROM products AS d, categories AS c';
	$query .= ' WHERE c.id = d.category_id';
	if (!empty($search_cat)) $query .= " AND d.category_id = '".$search_cat."'";
	if (!empty($search_term)) $query .= " AND d.description LIKE '%".$search_term."%'";
	$query .= ' ORDER BY prodname ASC';
	
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
?>

</div>

<?php include('footer.php'); ?>