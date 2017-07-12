<?php 

	$sql = "SELECT *
			FROM users 
			";
	
	$result = $conn->query($sql) or die(mysqli_error());

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Search Results</title>
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
<table>
	<tr>
      <td><strong>ID</strong></td>
      <td><strong>First Name</strong></td>
      <td><strong>Last Name</strong></td>
      <td><strong>Email</strong></td>
    </tr>
    <?php while ($row = $result->fetch_assoc()):?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['firstName']; ?></td>
          <td><?php echo $row['lastName']; ?></td>
          <td><?php echo $row['email']; ?></td>
        </tr>
    <?php endwhile;?>
</table>
</body>
</html>