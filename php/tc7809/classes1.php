<?php 

function output($output) {
	echo '<p>'. $output .'</p>';
}

// define a class

class Car {
	// static properties are attached to class itself
	public static $instanceCount = 0; 
	
	public $color = null; // externally visible
	public $make = null;
	public $model = null;
	
	protected $status = 'off'; // visible to all instances methods inherited or not
	private $passKey = 'xyz'; // only visible to Car methods

	// constructor functions are called at instantiation
	public function __construct($make = 'aqua', $model = 'fuscia', $color) {
		Car::$instanceCount++;
		
		$this->make = $make;
		$this->model = $model;
		$this->color = $color;
	}
	
	public function __destruct() {
		Car::$instanceCount--;
	}
	
	public function startEngine() {
		// $this references the current instance of the class
		$this->status = 'on';
		return $this->status;
	}
	
	public function getPassKey() {
		return $this->passKey;
	}

}

// the SUV class inherits properties from Car
class SUV extends Car {
	public $has4WD = 'true';
	
	public function getStatus() {
		return $this->status;
	}
	
	public function getKey() {
		return $this->passKey;
	}
	
	public function getPassKey() {
		return 'foo';
	}
}

// create an instance of the Car class
$myCar = new Car('Mercedes','760EL','black');

output(Car::$instanceCount);

// public properties are externally accessible
//$myCar->color = 'red';
echo '<p>'. $myCar->color .'</p>';

//$myCar->status = 'on'; // generates an access fatal error_get_last
echo $myCar->startEngine(); // works

$yourCar = new SUV('Ford','Escalade','green');
echo '<p>'. $yourCar->model .'</p>';

echo '<p>' . $yourCar->has4WD . '</p>';

$f = 'startEngine';
output( $yourCar->$f() );

echo '<p>' . $yourCar->startEngine() . '</p>';


echo '<p>' . $myCar->getPassKey() . '</p>';
echo '<p>' . $yourCar->getPassKey() . '</p>';

echo '<p>' . $yourCar->getStatus() . '</p>';
echo '<p>' . $yourCar->getKey() . '</p>';

output(Car::$instanceCount);

unset($myCar); // destroy object, calling destructor in the process

$c = 'Car';

output($c::$instanceCount);



