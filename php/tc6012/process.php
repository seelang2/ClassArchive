<?php
// get data from form
$fullname = $_GET['firstname'] . ' ' . $_GET['lastname'];
$email = $_GET['email'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
	<meta charset="UTF-8" />
</head>
<body>

	<h1>Welcome, <?php echo $fullname; ?>!</h1>
	
	<p>The email you gave us is <?php echo $email; ?>.</p>

</body>
</html>