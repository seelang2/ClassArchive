<?php 
	
	require_once('../inc/dbConnect.php');

	$sql = "DELETE FROM users
			WHERE
				id = ?
			";
			
	$stmt = $conn->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param('i', $_GET['id']);
	$stmt->execute();
	if ($stmt->error) {
		echo $stmt->errno . ": " . $stmt->error;
		exit();
	}
	
	//go back to user list
	require_once('userList.php');

?>