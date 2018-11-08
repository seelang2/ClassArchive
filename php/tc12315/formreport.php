<?php
/*
	Display a simple report of completed forms
	Forms are color coded as follows:
	Completed - green text
	Denied - red text

	Form data fields:
	Name
	Status - default is 'pending'

*/

// gather form data

/* mock data consists of an array of form items */
$formData = [
	['name' => 'Peter', 'status' => 'pending'],
	['name' => 'Mary', 'status' => 'Completed'],
	['name' => 'Jessica', 'status' => 'pending'],
	['name' => 'Albert', 'status' => 'Denied'],
	['name' => 'Tom', 'status' => 'Completed'],
	['name' => 'Alice', 'status' => 'Completed'],
	['name' => 'Becky', 'status' => 'Denied'],
	['name' => 'Michael', 'status' => 'Denied'],
	['name' => 'Rose', 'status' => 'Completed'],
	['name' => 'James', 'status' => 'pending']
];

// for each form item
foreach ($formData as $formItem) {
	// if form is not pending, process form item
	if ($formItem['status'] != 'pending') {
		// display item
		echo '<p style="color:';
		// if status is 'Completed', mark green
		if ($formItem['status'] == 'Completed') {
			echo 'green';
		}
		// if status is 'Denied', mark red
		if ($formItem['status'] == 'Denied') {
			echo 'red';
		}
		// finish item output
		echo '">Name: '. $formItem['name'] .' Status: '. $formItem['status'] .'</p>';
	}
}









?>