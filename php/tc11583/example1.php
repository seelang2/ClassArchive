<?php

// line comment
/* block comment */

$someVar = "A text string.";
$anotherVar = 3.1415;

$weekdays = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none'
);

echo '<p>' . $weekdays[0] . ' pill is ' . $pillbox['Sun'] . '</p>'; 

/*
INSERT INTO table 
	(`firstname`,`lastname`) 
VALUES
	('John', 'Doe');
*/

$months = ['Jan','Feb','Mar'];

echo '<p>' . $months[0] . '</p>';

// @ suppresses output
@define('HOSTNAME', 'localhost');
@define('HOSTNAME', 'http://mydomain.com'); // notice doesn't get output

echo '<p>' . HOSTNAME . '</p>';

echo '<p>Today is '. date('l, F jS, Y') .'.</p>';

$today = new DateTime();

echo '<p>Today is '. $today->format('l, F jS, Y') .'.</p>';

$a = 1;
echo '<p>'. $a++ .'</p>'; // 1
echo '<p>'. $a .'</p>'; // 2

$a = 1;
echo '<p>'. ++$a .'</p>'; // 2
echo '<p>'. $a .'</p>'; // 2

echo var_dump(null);

$today = null;
echo isset($today);
echo empty($today);
echo var_dump($today);
unset($today);
echo var_dump($today);
echo isset($today);
echo empty($today);



class Car {
	public $make = null;
	public $model = null;
	public $color = null;

	private $status = 'off';

	public function startEngine() {
		$this->status = 'on';
	}

	public function getStatus() {
		return $this->status;
	}
}

$myCar = new Car();
$myCar->color = 'black';
$myCar->startEngine();
echo '<p>'. $myCar->getStatus() .'</p>';

class SUV extends Car {
	protected $has4WD = true;

	public function checkHas4WD() {
		return $this->has4WD;
	}

	public function getStatus2() {
		return parent::$status;
	}
}

$yourCar = new SUV();
$yourCar->color = 'purple';
echo '<p>'. $yourCar->getStatus() .'</p>';



