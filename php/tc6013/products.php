<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
</head>
<body>


<?php

try {

	$db = new PDO('mysql:dbname=tc6013;host=localhost','root','xampp');

} catch (PDOException $e) {
	echo '<p>There was a problem connecting to the database: '.
		 $e->getMessage() . 
		 '</p>';

}

// build query
$query = 'SELECT id, name, sku, price, quantity FROM products';

// send query to server
$results = $db->query($query);

// check query response
if ($results === false) {
	// query error
	echo '<p>There was a problem with the query. <br />'.
		 'Query error: ' . $db->errorInfo()[2] . '<br />'.
		 'Query: '.$query.'</p>';
	
} else {
	// Success, process results
	
	if ($results->rowCount() == 0) {
		// no rows to display
		echo '<p>No products to display.</p>';
	} else {
		// build table
		echo '<table><thead>'.
				'<tr>'.
					'<th>ID</th>'.
					'<th>SKU</th>'.
					'<th>Product Name</th>'.
					'<th>Price</th>'.
					'<th>Qty</th>'.
				'</tr>'.
			 '</thead><tbody>';
		
		while($row = $results->fetch()) {
			echo '<tr>'.
					"<td>{$row['id']}</td>".
					'<td>'. $row['sku'] .'</td>'.
					'<td>'. $row['name'] .'</td>'.
					'<td>'. $row['price'] .'</td>'.
					'<td>'. $row['quantity'] .'</td>'.
				 '</tr>';
		} // while
		echo '</tbody></table>';
	} // if rowCount

} // if results

?>




</body>
</html>