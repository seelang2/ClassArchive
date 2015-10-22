<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Demo 2</title>
</head>
<body>
<?php

if (!empty($_POST['butSubmit'])) {
	// form present, process form data

	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	
	$fullname = $firstname . ' ' . $lastname;

?>

<h1>Welcome <?php echo $fullname; ?>!</h1>

<p>Today is <?php echo date('l, F j, Y'); ?></p>

<?php

} else {

?>

<form action="demo4.php" method="post">
	Firstname: <input type="text" name="fname" /><br />
	Lastname: <input type="text" name="lname" /><br />
	<input type="submit" name="butSubmit" />
</form>

<?php } ?>

</body>
</html>
