<?php
// define a simple class
class Car {
	
	var $color = 'red'; // var is same as public (old)
	
	// not accessible via any instances ( using -> )
	static $flag = 'static flag';
	
	// accessible by all instances, inherited or direct
	protected $status = 'off'; 
	protected function doStuff() { }
	
	// accessible by instances of THIS class only
	private $status2 = 'stuff';
	
	public function doMoreStuff() { return $this->status2; }
	
	public function getStatus() {
		$this->doStuff(); // can call the protected function
		
		return $this->status;
	}
	
	function __construct($c = 'blue') {
		$this->color = $c;
	}
	
}

// create an instance of Car class
$myCar = new Car();

echo '<p>' . $myCar->color . '</p>';
echo '<p>' . $myCar->getStatus() . '</p>';
echo '<p>' . $myCar->doMoreStuff() . '</p>'; // works

echo '<p>' . $myCar->flag . '</p>'; // doesn't work
echo '<p>' . $myCar::$flag . '</p>'; // works
echo '<p>' . Car::$flag . '</p>'; // must reference the class::property 


class SUV extends Car {

	public $has4WD = 'yes';

}

$newCar = new SUV('black');
echo '<p>' . $newCar->color . '</p>';
echo '<p>' . $newCar->getStatus() . '</p>';
echo '<p>' . $newCar->has4WD . '</p>';
echo '<p>' . $newCar->doMoreStuff() . '</p>'; // wouldn't work


