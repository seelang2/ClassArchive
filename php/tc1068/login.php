<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<?php

$errmsg = '';
switch($_GET['status'])
{
	case '2':
		$errmsg = 'The password is incorrect.';
	break;
	
	case '3':
		$errmsg = 'You do not have permission to view this page.';
	break;
	
	default:
		$errmsg = '';
	break;
}


?>

<body>
	
	<h1>Members Log in here</h1>
	
	<p>Enter the login and password below.</p>
	
	<?php echo "<p>$errmsg</p>"; ?>
	<form action="/content.php" method="post">
		<div>
			<label for="login">Login:</label>
			<input type="text" name="login" />
		</div>
		<div>
			<label for="password">Password:</label>
			<input type="password" name="password" />
		</div>
		<input type="submit" name="butSubmit" value="Log in >>>" />
	</form>


</body>
</html>
