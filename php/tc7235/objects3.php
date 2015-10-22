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
	
	private $status = 'off';
	
	public function startEngine() {
		// $this refers to current instance
		$this->status = 'running';
		return $this->status;
	}
	
	public function getStatus() { return $this->status; }
	
	// static declarations aren't part of instances and are called directly
	static function saySomething() {
		return 'something.';
	}
	
	function __construct($make = null, $model = null, $color = null) {
		$this->make = $make;
		$this->model = $model;
		$this->color = $color;
	}
}

class SUV extends Car {
	
	public $has4WD = false;
	
	// child classes can override parent properties
	public function getStatus() { 
		// child classes can still access parent methods using parent::
		return parent::getStatus();
	
	}

}


$myCar = new Car('Mercedes', '760GL', 'black');

echo '<p>The color of my car is ' . $myCar->color . '.</p>';

$yourCar = new SUV('Hummer', 'H2', 'red');


echo '<p>The color of your car is ' . $yourCar->color . '.</p>';

echo '<p>My car status is ' . $myCar->getStatus() . '</p>';

$myCar->startEngine();

echo '<p>My car status is ' . $myCar->getStatus() . '</p>';

//$yourCar->startEngine();

echo '<p>Your car status is ' . $yourCar->getStatus() . '</p>';

echo '<p>Your car ' . (empty($yourCar->has4WD) ? 'does not' : 'does') . ' have 4WD.</p>';

echo '<p>My car ' . (empty($myCar->has4WD) ? 'does not' : 'does') . ' have 4WD.</p>';

echo '<p>Say something: ' . Car::saySomething() . '</p>';

// works but not recommended
echo $myCar::saySomething();
echo $myCar->saySomething();

?>



</body>
</html>