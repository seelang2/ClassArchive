<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
	// process form data
	$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
	echo '<h1>Welcome, ' . $fullname . '!</h1>';
	
} else {
	// display form
?>

<form action="demo2.php" method="post">
	<p>First Name: <input name="firstname" type="text" /></p>
	<p>Last Name: <input name="lastname" type="text" /></p>
	<p><input type="submit" value="Continue" /></p>
</form>

<?php 
} // if
?>

</body>
</html>