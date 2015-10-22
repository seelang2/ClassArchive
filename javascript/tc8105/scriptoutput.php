<?php

// do database stuff here..
$contactData = array(
	array('firstname' => 'John1', 'lastname' => 'Doe', 'age' => 32),
	array('firstname' => 'John2', 'lastname' => 'Doe', 'age' => 32),
	array('firstname' => 'John3', 'lastname' => 'Doe', 'age' => 32),
	array('firstname' => 'John4', 'lastname' => 'Doe', 'age' => 32),
	array('firstname' => 'John5', 'lastname' => 'Doe', 'age' => 32)
);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<style type="text/css">
	</style>
</head>
<body>

<div id="target"></div>

<script type="text/javascript" src="jquery-1.11.3.js"></script>
<?php
// create script with data in global scope
echo '<script type="text/javascript">' . "\n";
echo 'var contacts =' . json_encode($contactData) . ';' . "\n";
echo '</script>' . "\n";
?>
<script type="text/javascript">

console.log(contacts);

</script>
</body>
</html>