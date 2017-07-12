<?php
require('mysql-init.php'); // application init

// set up query
$query = 'SELECT id, firstname, lastname, email, phone, company FROM contacts';

// send query to database server
$results = $db->query($query);



?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<style type="text/css">
table td {
	background-color: #F3F3F3;
	border: medium none;
	padding: 10px;
	text-align: center;
}
</style>
</head>

<body>
<?php

if (!$results) {
    // query error. display feedback
    echo '<p>Query error. query: '. $query . '</p>';
} else {
    // is there data?
    if ($results->num_rows == 0) {
        echo '<p>No data in table.</p>';
    } else {
        // build table
?>
<table>
	<tr>
        <td><strong>ID</strong></td>
        <td><strong>First Name</strong></td>
        <td><strong>Last Name</strong></td>
        <td><strong>Email</strong></td>
        <td><strong>Phone</strong></td>
        <td><strong>Company</strong></td>
    </tr>
<?php
    // loop through data rows and build table rows
    while ($row = $results->fetch_assoc()) {
        echo '<tr>' .
                '<td>'. $row['id'] .'</td>' .
                '<td>'. $row['firstname'] .'</td>' .
                '<td>'. $row['lastname'] .'</td>' .
                '<td>'. $row['email'] .'</td>' .
                '<td>'. $row['phone'] .'</td>' .
                '<td>'. $row['company'] .'</td>' .
             '</tr>';
    } // while
?>
</table>
<?php
    } // if num_rows
} // if $results
?>




</body>
</html>