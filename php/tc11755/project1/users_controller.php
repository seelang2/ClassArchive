<?php

class usersController extends Controller {



  /*
	 View records in table

	 GET parameters:
	 	page 	page number (for pagination)
	 	range 	number of rows per page

   */
  public function view($id = null){
    //get content records and display in table
    //if $id is set we want a specific item

    if (!empty($_GET['page'])) $offset = $_GET['page']; 
    if (!empty($_GET['range'])) $range = $_GET['range']; 

    switch (true){
      case !empty($id):
        //look for item with id = $id
        $query = "SELECT * FROM users WHERE id = $id";

        echo $query;

        $results = $this->db->query($query);
        
        if($results->rowCount()==0){
        	output('<p>No data to display</p>');
        	break;
        }

        // output content
        output(print_r($results->fetch(PDO::FETCH_ASSOC),true),'pre');
        
      break;
      default:
        //display all items
        $query = 'SELECT id, name, login, status FROM users';
        
        if (isset($offset) && isset($range)) {
	        // calculate actual offset for LIMIT clause
	        $offset = ($offset - 1) * $range;
	        // append LIMIT clause to query
	        $query .= " LIMIT $offset, $range";
        }

        echo $query; 

        $results = $this->db->query($query);
        
        if($results->rowCount()==0){
         output('<p>No data to display</p>');
          break;
        }
        //loop through results and display in table
        $outputHTML ='<table><tbody>';

        while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        	$outputHTML .= '<tr>';
        	foreach($row as $fieldValue) {
        		$outputHTML .= '<td>' . $fieldValue . '</td>';
        	}
        	$outputHTML .= '</tr>';
        }

        $outputHTML .= '</tbody></table>';
        
        echo $outputHTML;
      break;
        
    } //switch
  } // view()

  /*
    Displays add user form
  */
  public function add() {

  	$this->View->set('users_permissions', Config::get('users_permissions'));

    $this->View->render();
  } // add

  /*
    Saves user data posted from form
    If $id is present, updates existing record with $id
    otherwise creates new record
  */
  public function save($id = null) {
  	// get variables from $_POST
  	// ALWAYS sanitize data
  	if (!empty($id)) $id = $this->db->quote($id);
  	$name = $this->db->quote($_POST['name']);
  	$login = $this->db->quote($_POST['login']);
  	$password = $this->db->quote($_POST['password']);
  	$permission = $this->db->quote($_POST['permission']);

  	// also validate data at server side even if it's done on client
  	// basic validation - assume data is valid and look for exceptions
  	$formIsValid = true;

  	// create rules (conditional statements) looking for exceptions
  	// example: name can't be blank
  	if (empty($name)) {
  		$formIsValid = false; // invalidate form
  		// optionally do error message
  	}

  	if (!$formIsValid) {
  		// display user feedback, etc.
  		return; // abort save process
  	}

  	// now we can build the query and save the form
  	/*
  	if (empty($id)) {
  		$query = 'INSERT INTO ';
  	} else {
  		$query = 'UPDATE ';
  	}
  	*/
  	/*
  		ternary operator 
		condition ? trueValue : falseValue;
	*/

	$query = empty($id) ? 'INSERT INTO ' : 'UPDATE ';


  	$query .= "users SET " .
  				"name = $name, " . 
  				"login = $login, " . 
  				"password = $password, " . 
  				"permission = $permission ";

  	if (!empty($id)) $query .= " WHERE id = $id";

  	echo $query;

  	$result = $this->db->query($query);

  	if (!$result) {
  		// error 
  		echo "<p>There was a problem saving the record.<br />$query</p>";
  	} else {
  		// success
  		echo '<p>The record has been saved.</p>';
  	}

  } // save

  /*
    Displays login form
  */
  public function login() {
  	if (!empty($_GET['uri'])) $uri = urldecode($_GET['uri']);

    $this->View->set('uri', $uri);
    $this->View->render();

  } // login

  // note that no method for logout is necessary

} // usersController
