<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php

$weekdays = array('Sun','Mon','Tue');

echo '<p>'. $weekdays[1] .'</p>';

$weekdays[3] = 'Wed'; // can assign directly by key
$weekdays[] = 'Thu'; // assigns the next element in line
array_push($weekdays, 'Fri', 'Sat'); // useful for multiple values

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
);

echo '<p>'. $pillbox['Wed'] .'</p>';

$pillbox['Bob'] = 'technicolor';

$months = ['Jan', 'Feb', 'Mar']; // shorthand for numeric array

$contact = [
	'firstname' => 'John',
	'lastname' => 'Doe',
	'email' => 'jdoe@email.com',
	'age' => 42,
	'siblings' => [
		'Tom',
		'Dick',
		'Harry'
	]
];

print_r($pillbox); // dumps the value of an array to output

echo '<pre>'.print_r($contact, true).'</pre>';

echo '<p>' . $contact['siblings'][1] . '</p>';

?>

</body>
</html>