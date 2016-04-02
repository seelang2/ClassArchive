<!DOCTYPE html>
<?php

?>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'Page Title'; ?></title>
</head>
<body>

<?php 

class Car {
	var $color = '';
	var $make = '';
	var $model = '';
	protected $status = 'off';
	
	function startEngine() {
		$this->status = 'running';
		// if engine were an object inside the Car object
		//$this->engine->status = 'running';
	}
	
	function getStatus() {
		return $this->status;
	}
}

$myCar = new Car();

$myCar->color = 'black';
$myCar->make = 'Mercedes';
$myCar->model = '725L';

echo "<p>My car will be a {$myCar->color} {$myCar->make} {$myCar->model}.</p>";

//$myCar->status = 'running'; // doesn't work because $status is protected

echo '<p>Current car status: ' . $myCar->getStatus() . '.</p>';
$myCar->startEngine(); // start 'er up
echo '<p>Current car status: ' . $myCar->getStatus() . '.</p>';

$yourCar = new Car();
echo '<p>Your car\'s status: ' . $yourCar->getStatus() . '.</p>';

// Accessing sub-objects might look something like this:
//$myCar->engine->start();


?>

</body>
</html>