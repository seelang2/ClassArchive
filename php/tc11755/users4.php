<?php
require('init.php');
include('header.php');


// is form data present?
if (empty($_POST)) {
	// no data - display blank form

	// get department data
	$options = [
		'query' 		=> 'SELECT departmentid, name FROM departments',
		'fetchAll' 	=> true
	];

	$data = getResults($db, $options);

	// make department select
	$options = [
		'name' 					=> 'department_id',
		'optionValue' 	=> 'departmentid',
		'optionTitle' 	=> 'name',
		'option1Title' 	=> 'Please select a department'
	];

	$departmentSelect = makeSelect($data, $options);


	// get location data 
	$options = [
		'query' 		=> 'SELECT locationid, locationname FROM locations',
		'fetchAll' 	=> true
	];

	$data = getResults($db, $options);

	// make select for locations
	$options = [
		'name' 					=> 'location_id',
		'optionValue' 	=> 'locationid',
		'optionTitle' 	=> 'locationname',
		'option1Title' 	=> 'Please select a location'
	];

	$locationSelect = makeSelect($data, $options);

// exit PHP mode
?>	


<h1>Add New User</h1>
<form action="users3.php" method="post">
	<label>
		<span>User Name:</span>
		<input type="text" name="name" />
	</label>

	<label>
		<span>Login:</span>
		<input type="text" name="login" />
	</label>

	<label>
		<span>Password:</span>
		<input type="text" name="password" />
	</label>

	<label>
		<span>Department:</span>
		<?php echo $departmentSelect; ?>
	</label>

	<label>
		<span>Location:</span>
		<?php echo $locationSelect; ?>
	</label>

	<label>
		<span>Type:</span>
		<select name="type">
			<option value="1">Type 1</option>
			<option value="2">Type 2</option>
		</select>
	</label>

	<label>
		<span>Permission:</span>
		<select name="permission">
			<option value="1">Regular Employee</option>
			<option value="2">Event Coordinator</option>
			<option value="255">Sysadmin</option>
		</select>
	</label>

	<label>
		<span>Status:</span>
		<select name="status">
			<option value="0">Inactive</option>
			<option value="1">Active</option>
		</select>
	</label>

	<div><input type="submit" /></div>
</form>

<?php
} else {
	// form data present - process form data

	echo '<h3>$_POST:</h3>';
	echo '<pre>'.print_r($_POST,true).'</pre>';

	// Always validate data server side
	$formIsValid = true;
	$errorMessages = [];

	// sample rule: name can't be blank
	if (empty($_POST['name'])) {
		$formIsValid = false;
		array_push($errorMessages, 'Name field cannot be blank.');
	}
	// and so on...

	if ($formIsValid) {

		// ALWAYS SANITIZE USER DATA BEFORE USING IN A QUERY!
		$name = $db->quote($_POST['name']);
		$password = $db->quote($_POST['password']);
		$login = $db->quote($_POST['login']);
		$department_id = $db->quote($_POST['department_id']);
		$location_id = $db->quote($_POST['location_id']);
		$type = $db->quote($_POST['type']); 
		$permission = $db->quote($_POST['permission']);
		$status = $db->quote($_POST['status']);

		// build query
		$query = 'INSERT INTO users SET '.
							"name = {$name}, ".
							"login = {$login}, ".
							"department_id = {$department_id}, ".
							"location_id = {$location_id}, ".
							"type = {$type}, ".
							"permission = {$permission}, ".
							"status = {$status}, ".
							"password = {$password} ";

		// send query to server
		$result = $db->query($query);

		// check result
		if (!$result) {
			// error
			echo '<p>Query error: <br />'.$query.'</p>';
		} else {
			// success!
			echo '<p>The record has been saved.</p>';
		}
	} else {
		// form is invalid
		echo '<p>There was a problem with the form:<br />' .
					implode('<br />',$errorMessages) . 
					'Please go back and correct the errors and try again.</p>';
	}
} // if empty($_POST)

include('footer.php');