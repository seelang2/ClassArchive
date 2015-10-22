<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
form label {
	display: block;
	margin-bottom: 0.5em;
}
</style>
</head>

<body>

<?php

if ( (!empty($_POST['firstname'])) && (!empty($_POST['lastname'])) ) {
	// process form data - display welcome message
	
	$fullname = $_POST['firstname'] . ' ' . $_POST['lastname'];
	
	echo '<h1>Welcome, '.$fullname.'!</h1>';
} else {
	// no form data - display blank form
?>
	<form action="demo2.php" method="post">
    	<label>First Name: <input type="text" name="firstname" /></label>
    	<label>Last Name: <input type="text" name="lastname" /></label>
        <input type="submit" value="Continue ->" />
    </form>

<?php
} // if form data

?>


</body>
</html>