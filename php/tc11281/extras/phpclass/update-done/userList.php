<?php 

	require_once('../inc/dbConnect.php');
	
	$sql = 'SELECT id, firstName, lastName, email, publications, comments, subscribe FROM users';
	
	$stmt = $conn->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_result($id, $firstName, $lastName, $email, $publications, $comments, $subscribe);
	$stmt->execute();
	$stmt->store_result();//use this so that you can access "num_rows"
	if ($stmt->error) {
		echo $stmt->errno . ": " . $stmt->error;
		exit();
	}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Public Handicapper | Admin</title>
<link href="styles-main.css" rel="stylesheet">
</head>
<body>
<div id="header"><img src="img/ph-header.png" width="739" height="135"></div>
<div id="topLine"></div>
<div id="mainContent">
<h1>User Admin</h1>
<p><?php echo $stmt->num_rows; ?> users were found:</p>
<table>
	<tr>
        <td class="header">&nbsp;</td>
        <td class="header">First Name</td>
        <td class="header">Last Name</td>
        <td class="header">Email</td>
        <td class="header">Publications</td>
        <td class="header">Comments</td>
        <td class="header">Subscribe</td>
    </tr>
    <?php while ($stmt->fetch()):?>
        <tr>
            <td><?php echo '<a href="userForm.php?id=' . $id . '">Edit</a>'; ?></td>
            <td><?php echo $firstName; ?></td>
            <td><?php echo $lastName; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $publications; ?></td>
            <td><?php echo $comments; ?></td>
            <td><?php if ($subscribe) {echo 'Yes';} else {echo 'No';} ?></td>
        </tr>
    <?php endwhile;?>
</table>
<?php 
	//close connections and free resources
	//not completely necessary as PHP is supposed to automatically close resources when the script ends,
	//but it is the "polite" thing to do, best practice...and in larger applications will keep memory usage low.
	$stmt -> close();
	$conn -> close();
?>
</div>
<div id="footer"><a href="#">FAQ</a><a href="#">Forgot Password?</a><a href="#">Change Your Email</a><a href="#">Contact Public Handicapper</a></div>
</body>
</html>
