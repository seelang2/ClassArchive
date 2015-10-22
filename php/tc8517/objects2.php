<?php

// all objects in PHP are based on classes

class Car {
	// variables inside a class are called properties or attributes
	public $make = null;
	public $model = null;
	public $color = null;
	
	// protected means that any member of any class inherited from
	// Car can access the property
	
	// private means that only members of Car can access the property
	
	// protected $status = 'off';
	private $status = 'off';
	
	// functions inside a class are called methods
	public function setStatus($value) {
		// '$this' refers to the current instance
		$this->status = $value;
	}
	
	public function getStatus() {
		return $this->status;
	}
	
	public function __construct($params) {
		if (!empty($params['make'])) $this->make = $params['make'];
		if (!empty($params['model'])) $this->model = $params['model'];
		if (!empty($params['color'])) $this->color = $params['color'];
	}
	
}

class SUV extends Car {
	public $has4WD = true;
	static $doesHave4WD = true;
	
	public function getStatus2() {
		return $this->status;
	}
	
	// static members are accessed directly from the class using ::
	// they are not accessible from class instances
	static function has4WD() {
		// can't use $this in a static method because it's not associated
		// with an instance
		//return $this->has4WD;
		
		// we also can't access non-static members directly from the class
		//return SUV::has4WD;
		
		// note that the static variable has the $ in the name
		return SUV::$doesHave4WD;
	}
}

$yourCar = new Car(array('make'=>'Cadillac','model'=>'El Dorado','color'=>'pearl'));

$myCar = new SUV();

echo '<p>Your car color is '.$yourCar->color.'</p>';

echo '<p>Your car '.(isset($yourCar->has4WD) && $yourCar->has4WD ? 'has':'does not have').' four-wheel drive.</p>';

echo '<p>My car '.(isset($myCar->has4WD) && $myCar->has4WD ? 'has':'does not have').' four-wheel drive.</p>';

echo '<p>Your car status is '.$yourCar->getStatus().'</p>';

echo '<p>My car status is '.$myCar->getStatus().'</p>';

// generates a warning because $status is private
echo '<p>My car status is '.$myCar->getStatus2().'</p>';

$myCar->has4WD(); // can't access static properties
echo SUV::has4WD(); // access the static member directly from the class



