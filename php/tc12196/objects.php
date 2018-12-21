<?php

class Engine {
	public $cylinders = "6";
	public function throttleUp() { }
}

class Car {
	public $make;
	public $model;
	public $color;
	public $status = "off";
	public $engine;

	public function __construct() {
		$this->engine = new Engine();
	}
	
	public function startEngine() {
		$this->status = "running";
	}
}

// create an instance of Car
$myCar = new Car();
$myCar->make = "Mercedes";
$myCar->model = "760 AMG";
$myCar->color = "Black";

$yourCar = new Car();
$yourCar->make = "BMW";
$yourCar->startEngine();

echo '<p>' . $myCar->status . '</p>';
echo '<p>' . $yourCar->status . '</p>';

$myCar->engine->throttleUp();
