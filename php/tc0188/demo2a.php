<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php

$greeting = $_GET['username'];

?>

<h1>Welcome <?php echo $greeting; ?>!</h1>

<form action="demo2b.php?username=<?php echo urlencode($greeting); ?>" method="post">
	Full Name: <input type="text" name="fullname" /><br />
	Email Address: <input type="text" name="email" /><br />
	<input type="submit" value="Continue" />
</form>

</body>
</html>
