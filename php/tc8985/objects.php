<?php

class Car {

	public $color;
	public $make;
	public $model;
	public $status = 'off';

	public function startEngine() {
		// sets the valus of $status in the instance
		$this->status = 'running';
	}
}

// create an instance of the Car class

$myCar = new Car();
$myCar->color = 'black';
$myCar->make = 'Mercedes';
$myCar->model = '760 Series';

echo '<p>' . $myCar->color . '</p>';
echo '<p>' . $myCar->status . '</p>';

$yourCar = new Car();
$yourCar->color = 'red';
$yourCar->startEngine();

echo '<p>' . $yourCar->status . '</p>';
echo '<p>' . $myCar->status . '</p>';

?>