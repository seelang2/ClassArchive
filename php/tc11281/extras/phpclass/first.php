<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo 'My Page Title' ?></title>
</head>
<body>

<?php
echo '<p>This space for rent.</p>';	

echo 2 + 2;
echo '2 + 2';

$someValue = 'A text string.';
echo '<br />';

echo $someValue;
echo '<br />';

echo '$someValue';
echo '<br />';

echo "$someValue";
echo '<br />';

echo "<p>The string value is $someValue.</p>";

echo "<p>The string value is {$someValue}dfhdfghfgh.</p>";

// is a line comment. Anything after this is ignored on the line.
// echo '<p>This doesn't work.</p>'; 
echo '<p>This\'ll work just fine.</p>';

echo "\n"; // new line character. MUST be inside double quotes

echo '<p>This is on a new line in the page source.</p>';

echo '<p>' . $someValue . '</p>';

/*
Block comment. Can take up multiple lines.
*/


?>


</body>
</html>