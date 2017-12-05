<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>


<?php
if (!empty($_POST)) {
	// process form data
	echo '<h1>Welcome, ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . '!</h1>';
	
	echo "<p>You have registered using email address {$_POST['email']}. Thanks!</p>";
	
} else {
	// display blank form
?>

<form action="form1.php" method="post">
    <label for="firstname">First Name: <input id="firstname" name="firstname" /></label>
    <label for="lastname">Last Name: <input id="lastname" name="lastname" /></label>
    <label for="email">Email: <input id="email" name="email" /></label>
    <input type="submit" value="Submit Form" />
</form>

<?php
} // if form data present

?>
</body>
</html>
