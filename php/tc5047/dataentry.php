<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php

if (empty($_GET)) {
	// display blank form
?>
	<form action="dataentry.php" method="get">
    	<label for="firstname">
        	First Name: 
            <input id="firstname" name="firstname" type="text" />
        </label>
        <label>Last Name: <input name="lastname" type="text" /></label>
    	
        <div><input type="submit" /></div>
    </form>

<?php
} else {
	// process form data
	$fullname = $_GET['firstname'] . ' ' . $_GET['lastname'];
	
	echo '<h1>Welcome, ' . $fullname . '!</h1>';
}


?>

</body>
</html>