<?php 

	//prepare values for input
	foreach ($expected as $value) {
		if ( is_array(${$value}) ) {
			//if the value is an array, set it to a comma delimited list so it can be inserted into the table
			 ${$value} = implode(", ", ${$value});
		}
	}
	
	require_once('../inc/dbConnect.php');

	$sql = "";
			
	$stmt = $conn->stmt_init();
	$stmt->prepare($sql);
	//bind params here
	$stmt->execute();
	if ($stmt->error) {
		echo $stmt->errno . ": " . $stmt->error;
		exit();
	}

?>