<?php
require('init.php');
include('header.php');

$mode = empty($_GET['mode']) ? '' : strtoupper($_GET['mode']);

// start a new order
if ($mode == 'NEW') {
	$_SESSION['orders'] = [
		'id' => null,
		'customer_id' => null,
		'competitor_id' => null,
		'original_total' => 0,
		'competitor_total' => 0,
		'adjusted_total' => 0,
		'status' => 0
	];
	
	$_SESSION['lineitems'] = [];
	/*
	order_id
	product_id
	product_name
	our_price
	competitor_price
	qty
	*/
}


switch ($mode) {
	case 'ADDCUSTOMER':
		// save order form data

		// redirect to add customer module
		header('Location: addcustomer.php');
		exit();
	break;


} // switch $mode



?>
<form action="orderprocess.php" method="post">
	<label>
		<span>Customer: </span>
		<select name="customer_id">
			<option value="">Select Customer</option>
		</select>
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?mode=addcustomer">New Customer</a>
	</label>

	<label>
		<span>Competitor: </span>
		<select name="competitor_id">
			<option value="">Select Competitor</option>
		</select>
		<a href="addcompetitor.php">New Competitor</a>
	</label>

	<fieldset class="lineitem">
		<label>
			<span>product id</span>
			<input name="product_id" />
		</label>
		<label>
			<span>product name</span>
			<input name="product_name" />
		</label>
		<label>
			<span>product price</span>
			<input name="our_price" />
		</label>
		<label>
			<span>competitor price</span>
			<input name="competitor_price" />
		</label>
		<label>
			<span>Quantity</span>
			<input name="qty" />
		</label>
	</fieldset>

	<div><input type="submit" value="Save" /></div>
</form>





