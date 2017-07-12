<?php 
	
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
	
	//go back to user list
	
?>