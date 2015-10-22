<?php
include("config.php");

if (!isset($_SESSION['name'])) {
	header("Location: http://216.180.243.58/~tc8401/login.php");
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<h1>Welcome to the main page, <?php echo $_SESSION['name']; ?>!</h1>


</body>
</html>
