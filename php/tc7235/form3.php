<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	<style type="text/css">
	</style>
	
</head>
<body>

<?php

$action = empty($_GET['action']) ? 'SHOWFORM' : strtoupper($_GET['action']);

switch($action) {
	
	case 'SHOWFORM':
	?>
	
		<form action="form3.php?action=process" method="post">
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
	
	<?php
	break;
	
	case 'PROCESS':
		
		echo '<h1>Welcome!</h1>';
		echo '<p>Welcome, ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . '!</p>';

	
	break;
	
} // switch $action

?>

</body>
</html>