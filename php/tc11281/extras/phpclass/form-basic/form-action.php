<?php
// let's make our debug tool reusable
function dumpvar($data) {
	return '<pre>'.print_r($data, true).'</pre>';
}

// NEVER trust user input. Always sanitize before using it
function sanitize($input) {
	$output = trim($input); // get rid of whitespace characters
	$output = htmlentities($output, ENT_QUOTES, 'UTF-8');
	return $output;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>A Simple Form</title>
</head>

<body>
<?php

echo dumpvar($_POST);

if (!empty($x)) echo $x;



?>

<p><strong>Name:</strong><?php echo sanitize($_POST['name']); ?></p>
<p><strong>Email:</strong><?php echo sanitize($_POST['email']); ?></p>
<p><strong>Level:</strong><?php 
if (!empty($_POST['level'])) echo sanitize($_POST['level']); 
?></p>
<p><strong>Publications:</strong><?php 
if (!empty($_POST['publications'])) {
	echo sanitize(implode(', ', $_POST['publications']));
}
?></p>
<p><strong>How often track:</strong><?php 
if (!empty($_POST['howoftentrack'])) echo sanitize($_POST['howoftentrack']); 
?></p>
<p><strong>Comments:</strong><?php 
if (!empty($_POST['comments'])) echo nl2br(sanitize($_POST['comments'])); 
?></p>
</body>
</html>