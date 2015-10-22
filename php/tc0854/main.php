<?php
require_once('config.php');


include('header.php');

// set mfr_id
if (isset($_POST['butMfr'])) {
	$_SESSION['mfr_id'] = mysql_escape_string($_POST['mfr_id']);
}

// set type_id
if (isset($_POST['butType'])) {
	$_SESSION['type_id'] = mysql_escape_string($_POST['type_id']);
}

		// get list of manufacturers
		$query = 'SELECT id, name FROM manufacturers';
		if (!$result = @mysql_query($query)) {
			// query error
		
		} else {
			// build select tag
			$mfg_list = '<select name="mfr_id"><option value="ALL">All Manufacturers</option>';
			while ($list = mysql_fetch_array($result)) {
				$mfg_list .= '<option value="' . $list['id'] . '" ';
				if ($_SESSION['mfr_id'] == $list['id']) $mfg_list .= 'selected="selected"';
				$mfg_list .= '>' . $list['name'] . '</option>';
			}
			$mfg_list .= '</select>';
		}

// get list of types for selected manufacturer
if (isset($_SESSION['mfr_id'])) {
	$query = "SELECT DISTINCT type FROM inventory ";

	if ($_SESSION['mfr_id'] != 'ALL') $query .= "WHERE manufacturer_id = '" . mysql_escape_string($_SESSION['mfr_id']) . "'";

	if (!$results = @mysql_query($query)) {
		// query error
	
	} else {
		// build select tag
		$mfr_types = '<select name="type_id"><option value="ALL">All types</option>';
		while ($list = mysql_fetch_array($results)) {
			$mfr_types .= '<option value="' . $list['type'] . '" ';
			if ($_SESSION['type_id'] == $list['type']) $mfr_types .= 'selected="selected"';
			$mfr_types .= '>' . $inventoryTypes[$list['type']] . '</option>';
		}
	}

}

// get inventory list for specified criteria
if (isset($_SESSION['mfr_id']) && isset($_SESSION['type_id'])) {
	// get item list
	$query = "SELECT DISTINCT inventory.id, type, btu, afue, name, model_number, cost " .
			 "FROM inventory, manufacturers WHERE manufacturers.id = inventory.manufacturer_id";

		if ($_SESSION['mfr_id'] != 'ALL') $query .= " AND manufacturer_id = '" . $_SESSION['mfr_id'] . "'";
		
		if ($_SESSION['type_id'] != 'ALL') $query .= " AND type = '" . $_SESSION['type_id'] . "'";
		
		$query .= " ORDER BY name ASC, model_number ASC";

	//echo "<p>$query</p>";

	// send query to db
	$results = @mysql_query($query);
	
	// check response
	
	if (!$results) {
		// query error - display message
		echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
	} else {
		if (mysql_num_rows($results) < 1) {
			// no results returned
			$itemlist = '<p>No rows present.</p>';
		} else {
			// process results
			$itemlist =  '<table border="0" cellpadding="3" cellspacing="0">' .
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
				$itemlist .= "<tr>" .
						"<td>" . $row['id'] . "</td>" .
						"<td>" . $row['name'] . "</td>" .
						"<td>" . $row['model_number'] . "</td>" .
						"<td>" . $inventoryTypes[$row['type']] . "</td>" .
						"<td>" . $row['btu'] . "</td>" .
						"<td>" . $row['afue'] . "</td>" .
						"<td>" . $row['cost'] . "</td>" .
							"<td>" .
								'<a href="' . $_SERVER['PHP_SELF'] . '?additem=' . $row['id'] . '">Add to purchase list</a>' . 
							"</td>" .
					 "</tr>";
			}
			
			$itemlist .= '</table>';

		} // if num rows
	} // if result

}

// add item to purchase list
if (!empty($_GET['additem'])) {
	$query = "INSERT INTO purchases SET " .
			 "user_id = '" . mysql_escape_string($_SESSION['userid']) . "', " .
			 "item_id = '" . mysql_escape_string($_GET['additem']) . "'";
	
	$result = @mysql_query($query);
	
	if (!$result) {
		// query error
		echo '<p>There was a problem with the query: ' . mysql_error() . '<br />Query used: ' . $query . '</p>';
	} else {
		// successfull add
		echo '<p>The database was successfully updated. Query: ' . $query . '</p>';
	
	} // if result
} // additem





?>

<h1>Main Page</h1>

<div>
	<form id="mfrform" name="mfrform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		Manufacturer: <?php echo $mfg_list; ?> 
		<input type="submit" name="butMfr" value="GO" />
	</form>
</div>

<div>
	<form id="typeform" name="typeform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		Equipment Type: <?php echo $mfr_types; ?> 
		<input type="submit" name="butType" value="GO" />
	</form>
</div>

<div>
	<?php echo $itemlist; ?>
</div>


<?php
include('footer.php');
?>