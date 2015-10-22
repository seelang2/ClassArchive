<?php
session_start(); // activate sessions

// connect to database 
try {

	$db = new PDO('mysql:dbname=tc6013;host=localhost','root','xampp');

} catch (PDOException $e) {
	echo '<p>There was a problem connecting to the database: '.
		 $e->getMessage() . 
		 '</p>';

}



// use ternary operator (instead of if/else) to assign action
$action = empty($_GET['action']) ? 'ADD': strtoupper($_GET['action']);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<style type="text/css">
	form {
		width: 500px;
		margin: auto;
		padding: 10px 20px;
		border: 1px solid #999;
	}
	form label {
		display: block;
		margin: 0 0 0.5em 0;
	}
	form span {
		display: inline-block;
		width: 25%;
	}
	</style>
</head>
<body>

<?php
// update session from post
if (!empty($_POST)) {
	$_SESSION['ordernum'] = $_POST['ordernum'];
	$_SESSION['orderdate'] = $_POST['orderdate'];
	
	// if the item list (array) doesn't exist, create it
	if (empty($_SESSION['items'])) $_SESSION['items'] = array();
	
	if (!empty($_POST['addline'])) {
		// save new line item info
		$_SESSION['items'][] = array(
			'product' => $_POST['product'],
			'qty' => $_POST['qty']
		);
	}
}

switch($action) {

	case 'ADD': // display data entry form
		// look up products
		$query = 'SELECT id, name, price FROM products';
		$products = $db->query($query);
		if ($products === false || $products->rowCount() < 1) {
			// error or no products
			echo '<p>No products available or an error encountered.</p>';
			break; // terminate case
		}
		$productList = $products->fetchAll();
		
		echo '<pre>'.print_r($productList,true).'</pre>';
		
	?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=add" method="post">
			<input type="hidden" name="customerid" value="1" />
			<input type="hidden" name="userid" value="1" />
			<label><span>Order Number:</span><input name="ordernum" value="<?php echo empty($_SESSION['ordernum'])? '': $_SESSION['ordernum']; ?>" /></label>
			<label><span>Order Date:</span><input name="orderdate" value="<?php echo empty($_SESSION['orderdate'])? '': $_SESSION['orderdate']; ?>" /></label>
			<table>
				<thead>
					<tr><th>Product</th><th>Qty</th><th>&nbsp;</th></tr>
				</thead>
				<tbody>
					<?php
					foreach($_SESSION['items'] as $line) {
						echo '<tr>' .
								'<td>'. $productList[$line['product']]['name'] .'</td>'.
								'<td>'. $line['qty'] .'</td>'.
							 '</tr>'; 
					} // foreach
					?>
					</tr>
						<td><select name="product">
						<?php
						foreach($productList as $product) {
							echo '<option value="'.$product['id'].'">'.$product['name'].'</option>';
						} // while
						?>
						</select></td>
						
						<td><input name="qty" size="5" /></td>
						
						<td><input type="submit" name="addline" value="Add" /></td>
					</tr>
				</tbody>
			</table>
			
			<input type="submit" name="savedata" value="Save" />
		</form>
	<?php

	break; // 'ADD'
	
	case 'PROCESS': // process form data
		// sanitize data
		$firstname = $db->quote($_POST['firstname']);
		$lastname = $db->quote($_POST['lastname']);
		$login = $db->quote($_POST['login']);
		$password = $db->quote($_POST['password']);
		
		// build query
		$query = 'INSERT INTO users SET '.
					"firstname = '{$firstname}', " .
					"lastname = '{$lastname}', " .
					"login = '{$login}', " .
					"password = '{$password}' ";
		
		// send query to server
		$result = $db->query($query);
		
		// check response
		if ($result === false || $result->rowCount() != 1) {
			// query error
			echo '<p>There was a problem with the query. <br />'.
				 'Query error: ' . $db->errorInfo()[2] . '<br />'.
				 'Query: '.$query.'</p>';
			
			break; // terminate case
		}
		
		// successful save, tell the user
		echo '<p>The record has been saved.</p>';
	
	break; // 'PROCESS'
	
} // switch

?>


</body>
</html>