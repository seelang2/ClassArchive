<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<style type="text/css">
label {
	display: block;
	margin-bottom: 0.5em;
}
</style>
</head>

<body>

<?php

// if form data present
if (!empty($_POST)) {
	// process form data
	echo '<h1>Welcome, ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . '!</h1>';
	
	echo "<p>Your login name is {$_POST['login']} and your email is {$_POST['email']}.</p>";
	
} else {
	// display blank form
?>
	<form action="adduser.php" method="post">
		<label>First Name:<input type="text" name="firstname" /></label>
        <label>Last Name:<input type="text" name="lastname" /></label>
        <label>Login:<input type="text" name="login" /></label>
        <label>Email:<input type="text" name="email" /></label>
        <input type="submit" value="Continue" />
    </form>
<?php
}
?>


</body>
</html>