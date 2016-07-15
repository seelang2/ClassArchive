<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	</style>
</head>
<body>

<?php
// is there form data present?
if (empty($_POST)) {
	// no form data, display blank form
?>
	<!-- form is in the if block, 
	so only displays if condition is true -->
	<form action="process.php" method="post">
		<label>
			<span>First Name:</span>
			<input type="text" name="firstname" />
		</label>
		<label>
			<span>Last Name:</span>
			<input type="text" name="lastname" />
		</label>
		<div><input type="submit" /></div>
	</form>
<?php
} else {
	// process form data
	echo '<h1>Welcome '. 
		 $_POST['firstname'] . ' ' . 
		 $_POST['lastname'] . '!</h1>';
}

?>

</body>
</html>