<?php

class Users extends Controller {

	public function add() {
		//echo 'Users->add called.';

		// get department data
		$options = [
			'query' 		=> 'SELECT departmentid, name FROM departments',
			'fetchAll' 	=> true
		];
		$data = $this->getResults($options);
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
		$data = $this->getResults($options);
		// make select for locations
		$options = [
			'name' 					=> 'location_id',
			'optionValue' 	=> 'locationid',
			'optionTitle' 	=> 'locationname',
			'option1Title' 	=> 'Please select a location'
		];
		$locationSelect = makeSelect($data, $options);

		// pass data to view
		$this->View->set('departmentSelect', $departmentSelect);
		$this->View->set('locationSelect', $locationSelect);

		// renders the view for this method 
		// (default view template name is tpl_users_controller.php)
		$this->View->render();
	} // add()

	public function edit($id = null) {
		if (empty($id)) throw new Exception('No id present.');

		$id = $this->db->quote($id); // DON'T FORGET TO SANITIZE!

		// look up user to edit
		$options = [
			'query' 		=> 'SELECT * FROM users WHERE userid ='.$id,
			'fetchAll' 	=> true
		];
		$user = $this->getResults($options);

		if (!$user) throw new Exception('User Not found. '.$options['query']);

		// send user data to view
		$this->View->set('user', $user);


		// get department data
		$options = [
			'query' 		=> 'SELECT departmentid, name FROM departments',
			'fetchAll' 	=> true
		];
		$data = $this->getResults($options);
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
		$data = $this->getResults($options);
		// make select for locations
		$options = [
			'name' 					=> 'location_id',
			'optionValue' 	=> 'locationid',
			'optionTitle' 	=> 'locationname',
			'option1Title' 	=> 'Please select a location'
		];
		$locationSelect = makeSelect($data, $options);

		// pass data to view
		$this->View->set('departmentSelect', $departmentSelect);
		$this->View->set('locationSelect', $locationSelect);

		// renders the view for this method 
		$this->View->render(['template'=>'tpl_users_add.php']);
	} // edit()

	// saves data in $_POST to db
	public function save($id = null) {

		// Always validate data server side
		$formIsValid = true;
		$errorMessages = [];

		// sample rule: name can't be blank
		if (empty($_POST['name'])) {
			$formIsValid = false;
			array_push($errorMessages, 'Name field cannot be blank.');
		}
		// and so on...

		// send formIsValid flag to view template
		$this->View->set('formIsValid', $formIsValid);

		if ($formIsValid) {

			// ALWAYS SANITIZE USER DATA BEFORE USING IN A QUERY!
			$name = $this->db->quote($_POST['name']);
			$password = $this->db->quote($_POST['password']);
			$login = $this->db->quote($_POST['login']);
			$department_id = $this->db->quote($_POST['department_id']);
			$location_id = $this->db->quote($_POST['location_id']);
			$type = $this->db->quote($_POST['type']); 
			$permission = $this->db->quote($_POST['permission']);
			$status = $this->db->quote($_POST['status']);

			// build query
			$query = empty($id) ? 'INSERT INTO ': 'UPDATE ';

			$query .= ' users SET '.
								"name = {$name}, ".
								"login = {$login}, ".
								"department_id = {$department_id}, ".
								"location_id = {$location_id}, ".
								"type = {$type}, ".
								"permission = {$permission}, ".
								"status = {$status}, ".
								"password = {$password} ";

			if (!empty($id)) $query .= ' WHERE userid = '. $this->db->quote($id);

			// send query to server
			$result = $this->db->query($query);

			// pass query and result into view template
			$this->View->set('query', $query);
			$this->View->set('result', $result);

		} else {
			// send error messages to view template
			$this->View->set('errorMessages', $errorMessages);

		}

		$this->View->render(); // display view template
	} // save()

	public function view($id = null) {

	} // view()

	public function login() {

	} // login()

	public function logout() {

	} // logout()


} // Users
