<?php 

	//prepare values for input
	foreach ($expected as $value) {
		if ( is_array(${$value}) ) {
			//if the value is an array, set it to a comma delimited list so it can be inserted into the table
			 ${$value} = implode(", ", ${$value});
		}
	}
	
	echo $subscribe;
	//exit();

	require_once('../inc/dbConnect.php');

	$sql = "INSERT INTO users (firstName,lastName,email,publications,comments,subscribe)
			VALUES (?, ?, ?, ?, ?, ?)
			";
			
	$stmt = $conn->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('sssssi', $firstName, $lastName, $email, $publications, $comments, $subscribe);
	$stmt->execute();

?>