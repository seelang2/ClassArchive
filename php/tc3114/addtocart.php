<?php
require_once('config.php');

//echo '<pre>'.print_r($_POST, true).'</pre>';

// is there a cart?
if (empty($_COOKIE['refnum'])) {
	// no cart, create a new cart
	$orderdate = time();
	$refid = md5(microtime());
	$clientid = empty($_SESSION['clientid']) ? 0 : $_SESSION['clientid'];
	
	$query = "INSERT INTO orders SET " .
				"refid = '$refid', " .
				"orderdate = '$orderdate', " .
				"client_id = '$clientid', " .
				"type = '0' ";
	
	if (!$result = @mysql_query($query)) {
		// query error
		redirect('dberror.php');
	} else {
		// query worked, continue
		// store refid in cookie for later
		setcookie('refnum', $refid, time() + 86400);
		$orderid = mysql_insert_id();
	}
} else {
	// find cart
	$query = "SELECT id FROM orders WHERE refid = '".escape($_COOKIE['refnum'])."'";
	$result = @mysql_query($query);
	if (!$result || mysql_num_rows($result) != 1) {
		redirect('dberror.php');
	} else {
		$row = mysql_fetch_array($result);
		$orderid = $row['id'];
	}
}

// add item to cart
$query = "INSERT INTO items SET " .
			"order_id = '$orderid', ".
			"product_id = '".escape($_POST['productid'])."', ".
			"qty = '".escape($_POST['qty'])."' ";

if (!$result = @mysql_query($query)) {
	// query error
	redirect('dberror.php');
} else {
	$itemid = mysql_insert_id();
	
	// loop through option values and add to itemvalues
	foreach($_POST['optionvalue'] as $value) {
		$query = "INSERT INTO itemvalues SET ".
					"item_id = '$itemid', ".
					"value_id = '".escape($value)."' ";
		
		if (!$result = @mysql_query($query)) {
			// query error
			redirect('dberror.php');
		}
	} // foreach optionvalue
}

$query = "SELECT count(id) AS count FROM items WHERE order_id = '$orderid' ";
$result = @mysql_query($query);
if (!$result || mysql_num_rows($result) != 1) {
	redirect('dberror.php');
} else {
	$row = mysql_fetch_array($result);
	setcookie('cartcount', $row['count']);
}

// whole thing worked. redirect to new page
redirect('browse.php');

?>