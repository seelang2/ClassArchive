<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Multipurpose page demo</title>
	
	<style type="text/css"></style>
</head>
<body>

<?php
if (!empty($_GET['formstep'])) {
	// form data exists, process data
?>

<h1>Welcome!</h1>
<p>Glad you could make it, <?php echo $_GET['firstname']. ' ' .$_GET['lastname']; ?>!</p>

<?php

} else { 
	// form data does NOT exist, display blank form
?>


<form action="mppage.php" method="get">
	<input type="hidden" name="formstep" value="1" />
	<div>
		<label>First Name: <input name="firstname" /></label>
	</div>

	<div>
		<label>Last Name: <input name="lastname" /></label>
	</div>

	<div><input type="submit" /></div>
</form>

<?php } ?>



</body>
</html>	