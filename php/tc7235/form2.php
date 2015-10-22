<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	<style type="text/css">
	</style>
	
</head>
<body>

<?php if (empty($_GET)) : ?>

<form action="form2.php" method="get">
	<label>
		<span>First Name</span>
		<input name="firstname" />
	</label>
	
	<label>
		<span>Last Name</span>
		<input name="lastname" />
	</label>
	
	<div>
		<input type="submit" value="Contine" />
	</div>
</form>

<?php else: ?>

<h1>Welcome!</h1>
<p>Hello, <?php echo $_GET['firstname']; ?> <?php echo $_GET['lastname']; ?>!</p>

<?php endif; ?>

</body>
</html>