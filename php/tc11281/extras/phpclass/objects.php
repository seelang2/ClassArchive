<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
// let's make our debug tool reusable
function dumpvar($data) {
	return '<pre>'.print_r($data, true).'</pre>';
}

// use object structure for storing data type
$contact = new stdClass(); // creates a new generic object instance

$contact->firstname = 'John';
$contact->lastname = 'Doe';
$contact->email = 'jdoe@email.com';
$contact->age = 42;
$contact->siblings = ['Tom', 'Dick', 'Harry'];

echo dumpvar($contact);

// OOP (Object-Oriented Programming) basics
// used to assign behaviours

class Contact {
	// members have visibility: public, protected, private
	public $firstname = null;
	public $lastname = null;
	public $email = null;
	public $age = 0;
	public $siblings = null;
	protected $log = [];

	// constructor function. Note that there are TWO underscores.
	// gets called when creating a new instance of the class
	public function __construct($firstname,$lastname,$email,$age,$siblings = []) {
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->email = $email;
		$this->age = $age;
		$this->siblings = $siblings;
	}

	// simple 'getter' 
	public function getLog() {
		return $this->log;
	}
	// simple 'setter'
	public function touch($note) {
		$this->log[] = [
			'timestamp' => date('D-m-Y H:i:s'),
			'note' => $note
		];
	}

}

$contactA = new Contact('John','Doe','jdoe@email.com',42,['Tom', 'Dick', 'Harry']);

echo dumpvar($contactA);

$contactA->touch('Quick meeting');

echo dumpvar($contactA->getLog());

// Classes may inherit (extend) other classes. These derivative classes
// inherit the members of the parent class.
class Client extends Contact {
	public $billingRate = 0;
	protected $hoursBilled = 0;

	// new method exclusive to client instances
	public function setBillingRate($rate) {
		$this->billingRate = $rate;
	}

	// overrides touch method from parent class
	public function touch($note, $hours) {
		$this->log[] = [
			'timestamp' => date('D-m-Y H:i:s'),
			'note' => $note,
			'hours' => $hours
		];

		$this->hoursBilled += $hours;
	}

	public function getLog() {
		// we can access the parent's original function
		return [
			'logentries' => parent::getLog(),
			'invoicetotal' => $this->hoursBilled * $this->billingRate
		];
	}
}

$client1 = new Client('Jane','Adams','jadams@email.com',36);
$client1->setBillingRate(50);

$client1->touch('Quick meeting', 2);

echo dumpvar($client1);

echo dumpvar($client1->getLog());


?>
</body>
</html>