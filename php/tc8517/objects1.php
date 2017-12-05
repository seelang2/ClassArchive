<?php

// all objects in PHP are based on classes

class Car {
	// variables inside a class are called properties or attributes
	public $make = null;
	public $model = null;
	public $color = null;
	protected $status = 'off';
	
	// functions inside a class are called methods
	public function setStatus($value) {
		// '$this' refers to the current instance
		$this->status = $value;
	}
	
	public function getStatus() {
		return $this->status;
	}
	
}


// we create instances (actual objects) of a class using 'new'
$yourCar = new Car();
$myCar = new Car();


// use the '->' operator to access an object's members
$yourCar->color = 'red';
$yourCar->color = 'blue';

echo '<p>Your car color is '.$yourCar->color.'.</p>';

//echo $yourCar->status;
echo '<p>Your car status is '.$yourCar->getStatus().'</p>';

$yourCar->setStatus('running');

echo '<p>Your car status is '.$yourCar->getStatus().'</p>';

echo '<p>My car status is '.$myCar->getStatus().'</p>';




