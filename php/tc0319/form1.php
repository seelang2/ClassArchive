<?php

$showform = false;

if ( isset($_POST['firstname']) ) $firstname = $_POST['firstname']; else $showform = true;
if ( isset($_POST['lastname']) ) $lastname = $_POST['lastname']; else $showform = true;
if ( isset($_POST['email']) ) $email = $_POST['email']; else $showform = true;
if ( isset($_POST['login']) ) $login = $_POST['login']; else $showform = true;
if ( isset($_POST['password']) ) $password = $_POST['password']; else $showform = true;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php 

echo "<h1>Welcome!</h1>";
echo "<p>Today is " . date('l, F j, Y') . "</p>";

if ($showform) {

?>

<form action="form1.php" method="post">
	<p>First Name: <input type="text" name="firstname" size="20" maxlength="20" /></p>
	<p>Last Name: <input type="text" name="lastname" size="20" maxlength="25" /></p>
	<p>Email: <input type="text" name="email" size="30" maxlength="60" /></p>
	<p>Login ID: <input type="text" name="login" size="20" maxlength="12" /></p>
	<p>Password: <input type="text" name="password" size="20" maxlength="15" /></p>
	<p><input type="submit" value="Enter New User" />
</form>

<?php 
} else {

	echo "<p>First Name: $firstname</p>";
	echo "<p>Last Name: $lastname</p>";
	echo "<p>Email: $email</p>";

?>
	<p>Login ID: <?php echo $login; ?></p>
	<p>Password: <?php echo $password; ?></p>
<?php
}
?>
</body>
</html>