<?php 
	function sanitizeInput($myInput) {
		$myInput = trim($myInput);
		$myInput = htmlentities($myInput, ENT_QUOTES, 'UTF-8');
		return $myInput;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>A Simple Form</title>
</head>

<body>
<p><strong>Name:</strong> <?php echo sanitizeInput($_POST['name']); ?></p>
<p><strong>Email:</strong> <?php echo sanitizeInput($_POST['email']); ?></p>
<p><strong>Level:</strong> 
	<?php 
		if ( isset($_POST['level']) ) {
			echo sanitizeInput($_POST['level']);	
		}
	?>
</p>
<p><strong>Publications:</strong> 
	<?php 
		if ( isset($_POST['publications']) ) {
			echo sanitizeInput( implode(', ', $_POST['publications']) );
		}
	?>
</p>
<p><strong>How often track:</strong> <?php echo sanitizeInput($_POST['howoftentrack']); ?></p>
<p><strong>Comments:</strong></p>
<p><?php echo nl2br( sanitizeInput($_POST['comments']) ); ?></p>
</body>
</html>