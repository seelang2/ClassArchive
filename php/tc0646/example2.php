<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Example 2</title>
</head>
<body>


<?php
if (isset($_POST['butSubmit'])) {
	// process form (display contents)
?>
<h1>Welcome <?php echo $_POST['firstname']; ?> <?php echo $_POST['lastname']; ?>!</h1>

<?php
} else {
	// display form
?>
<form action="example2.php" method="post">
	<p>
		First name: 
		<input type="text" name="firstname" size="40" maxlength="50" />
		<br />
		Last name: 
		<input type="text" name="lastname" size="40" maxlength="50" />
		<br />
		<input type="submit" name="butSubmit" value="Continue" />
	</p>
</form>

<?php
}
?>

</body>
</html>
