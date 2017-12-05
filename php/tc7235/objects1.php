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

class Car {
	
	public $make = null;
	public $model = null;
	public $color = null;
	
	protected $status = 'off';
	
	public function startEngine() {
		// $this refers to current instance
		$this->status = 'running';
		return $this->status;
	}
	
	public function getStatus() { return $this->status; }
	
	
}

$myCar = new Car();

$myCar->color = 'black';

echo '<p>The color of my car is ' . $myCar->color . '.</p>';

$yourCar = new Car();

$yourCar->color = 'red';

echo '<p>The color of your car is ' . $yourCar->color . '.</p>';

echo '<p>My car status is ' . $myCar->getStatus() . '</p>';

$myCar->startEngine();

echo '<p>My car status is ' . $myCar->getStatus() . '</p>';


?>



</body>
</html>