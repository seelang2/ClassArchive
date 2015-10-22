<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>

<?php

$me = $_SERVER['PHP_SELF'];

$greeting = $_GET['username'];

if (isset($_POST['fullname']) && $_POST['fullname'] != '' && isset($_POST['email']) && $_POST['email'] != '') {
	// process and display form data

	$fname = $_POST['fullname'];
	$addr = $_POST['email'];

?>

<p>Fullname: <?php echo $fname; ?></p>
<p>Email Address: <?php echo $addr; ?></p>

<p>Thank you <?php echo $greeting; ?>!</p>


<?php

} else {
	// display form
?>

<h1>Welcome <?php echo $greeting; ?>!</h1>

<form action="<?php echo $me; ?>?username=<?php echo urlencode($greeting); ?>" method="post">
	Full Name: <input type="text" name="fullname" /><br />
	Email Address: <input type="text" name="email" /><br />
	<input type="submit" value="Continue" />
</form>

<?php
}

?>

</body>
</html>