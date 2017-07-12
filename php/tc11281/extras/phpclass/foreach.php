<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php 

//this in an indexed array
$movies[0] = 'Blue Velvet'; 
$movies[1] = 'Taxi Driver'; 
$movies[2] = 'Star Wars'; 
$movies[3] = 'Pulp Fiction'; 
$movies[4] = 'Manhattan'; 
$movies[5] = 'Back To The Future'; 
$movies[6] = 'A Clockwork Orange'; 


//this is a simple associative array
$customer = array(
	'firstName' => 'Jeremy',
	'lastName' => 'Kay',
	'ID' => 78,
	'email' => 'jeremy@jeremy.com'
);

//this is a multidimensional associative array
$cars = array(
	array(
		'make' => 'Ferrari',
		'model' => 'Testarossa',
		'year' => '1987',
		'engine' => 'V12',
		'horsepower' => '390',
		'cost' => '$70,000',
		'color' => 'red'
	),
	array(
		'make' => 'Porsche',
		'model' => '911 S Turbo Cabriolet ',
		'year' => '2012',
		'engine' => '3.6L 6-Cylinder',
		'horsepower' => '530',
		'cost' => '$203,000',
		'color' => 'black'
	),
	array(
		'make' => 'Lamborghini',
		'model' => 'Countach',
		'year' => '1989',
		'engine' => 'V12',
		'horsepower' => '375',
		'cost' => '$138,000',
		'color' => 'white'
	),
	array(
		'make' => 'Ford',
		'model' => 'Mustang',
		'year' => '1967',
		'engine' => 'V8',
		'horsepower' => '225',
		'cost' => '$55,000',
		'color' => 'green'
	),
	array(
		'make' => 'DeLorean',
		'model' => 'DMC-12',
		'year' => '1981',
		'engine' => 'V6',
		'horsepower' => '150',
		'cost' => '$28,000',
		'color' => 'gray'
	)
);
?>


</body>
</html>