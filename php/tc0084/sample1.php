<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php


if (isset($_POST['mode']) && $_POST['mode'] != "") $mode = $_POST['mode']; else $mode = "";

switch($mode) {
	case 1:
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
echo <<<END
<p>Hello, $fname $lname!</p>
<p><a href="{$_SERVER['PHP_SELF']}">Try Again</a></p>
END;

	break;
	default:
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="mode" value="1" />
	Enter Your First Name: <input type="text" name="firstname" /><br />
	Enter Your Last Name: <input type="text" name="lastname" /><br />
	<input type="submit" name="butSubmit" value="Go" />
</form>


<?php
	break;
}
?>



</body>
</html>
