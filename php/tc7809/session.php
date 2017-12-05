<?php

// initialize sessions
session_start();


if (!empty($_POST['text'])) {
	// store the data from POST into SESSION
	$_SESSION['data'] = $_POST['text'];

} else {
	// read data in from session
	$data = empty($_SESSION['data']) ? '': $_SESSION['data'];

}


?>
<!doctype HTML>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Sample form</title>
	
	<style type="text/css">
	body {
		font-family: Verdana, Arial, sans-serif;
	}
	
	label {
		display: block;
		margin-bottom: 0.5em;
	}
	
	label span, label input {
		display: inline-block;
	}
	
	label span {
		width: 75px;
	}
	</style>
</head>
<body>

<h2>Text</h2>
<form id="theform" action="session.php" method="POST">
	<label>
		<span>Name:</span>
		<textarea name="text"><?php echo $_SESSION['data']; ?></textarea>
	</label>
	<div><input type="submit" /></div>
</form>

<div id="results"></div>

<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>