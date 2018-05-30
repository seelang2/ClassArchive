<?php

class Car {
	public $make = null;
	public $model = null;
	public $color = null;
	protected $status = 'off';

	public function startEngine() {
		$this->status = 'on';
		echo 'running';
	}

	public function __construct($make, $model, $color) {
		$this->make = $make;
		$this->model = $model;
		$this->color = $color;
	}

}

class SUV extends Car {
	protected $has4WD = true;
	protected $turboStatus = 'off';

/*
	public function __construct($make, $model, $color) {
		parent::__construct($make, $model, $color);
	}
*/

	public function startEngine() {
		$turboStatus = 'active';
		parent::startEngine();
	}
}

$myCar = new Car('Mercedes','760M', 'Black');

echo $myCar->color;

$yourCar = new SUV('Land Rover', 'Discover', 'Silver');

echo $yourCar->make;

$yourCar->startEngine();
