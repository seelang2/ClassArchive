<?php
/***
 * core.php - application core library
 */


// modules (controllers) are defined as classes for reusability

///////// CORE MODULES /////////

/***
 * Controller
 * All code common to all controllers go here and will be inherited
 * by the individual controllers
 */
class Controller {
	
	protected $db;
	public $view;
	
	public $controllerName;
	public $currentActionName;
	
	/***
	 * parseParams
	 * Given a query string (ex: id=42&sort=asc&orderby=lastname)
	 * parse into an associated array
	 */
	public function parseParams($paramString) {
		$params = array();
		foreach(explode('&',$paramString) as $pairs) {
			$data = explode('=',$pairs);
			$params[$data[0]] = $data[1];
		}
		return $params;
	}
	
	public function __construct($actionName) {
		
		// import database connection info from global scope
		// (clunky, I know.)
		global $dbInfo;
		
		// initialize db connection
		$this->db = @new mysqli($dbInfo['hostname'], 
						 $dbInfo['user'], 
						 $dbInfo['password'], 
						 $dbInfo['dbname']);

		// we use the procedural connection test to be compatible with PHP 5 < 5.3
		// ref: http://php.net/manual/en/mysqli.construct.php
		if (mysqli_connect_error()) {
			die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
		}

		
		$controllerName = preg_replace('/Controller/','',get_class($this));
		
		$this->controllerName = $controllerName;
		$this->currentActionName = $actionName;
		
		$this->view = new View($controllerName, $actionName);
		
		// set up authentication module
		$this->Auth = new Authentication($this);
	}
	
	public function __destruct() {
		// render view automatically when class unloads
		$this->view->render();
	}
	
}

/**
 * pagesController 
 * Special controller that uses dynamic action names to display pages.
 * No need to define methods for every page - just include a view file.
 */
class pagesController extends Controller {

	public function __construct($actionName) {
		$this->actionName = $actionName;
		
		$this->$actionName = function() { 
			//echo '<p>Called '.$this->actionName.'</p>'; 
		};
		
		$this->view = new View('pages', $actionName);
	}
	
}


/**
 * View
 * Handles rendering an action's view. View files should be in the 
 * naming format controller_action.view.php. 
 */
class View {
	
	protected $vars = array();
	protected $controllerName;
	protected $actionName;
	protected $fileName;
	
	public function set($varName, $value) {
		$this->vars[$varName] = $value;
	}
	
	public function __construct($controllerName, $actionName) {
		$this->controllerName = $controllerName;
		$this->actionName = $actionName;
		$this->fileName = $this->controllerName.'_'.$this->actionName.'.view.php';
	}
	
	public function render() {
		// import variables into scope
		extract($this->vars);
		
		/*
		if (!file_exists($this->fileName)) {
			throw new Exception('View '.$this->fileName.' could not be found.');
		}
		*/
		@include('header.php');
		@include($this->fileName);
		@include('footer.php');
		
	}
	
}

/***
 * Model - NOT USED
 * All code common to all models go here and will be inherited
 * by the individual models
 */
/*
class Model {

}
*/


/***
 * Router
 * The static Router class takes a request URI, parses it, then hands 
 * off the request parameters to the appropriate controller method
 */
class Router {

	static function parseRequest($requestURL) {
		$pattern = '/'.preg_quote(BASE_FS_PATH, '/').'/';

		// strip out base path
		$requestURL = preg_replace($pattern, '', $requestURL);

		// strip out any trailing slashes
		$requestURL = preg_replace('/\/$/', '', $requestURL);

		//if (DEBUG_MODE) echo '<p>'.$requestURL.'</p>';

		// convert request to an array
		$request = explode('/', $requestURL);

		//if (DEBUG_MODE) echo '<pre>'.print_r($request,true).'</pre>';
		
		return $request;
	}
	
	/**
	 * Route
	 * Takes the request and calls the appropriate controller/action
	 * Request data is now taken directly from $_SERVER instead of being
	 * passed into the router
	 */
	static function route() {
		
		// check to see whether the request was a redirect
		if (empty($_SERVER['REDIRECT_URL'])) {
			// index.php was called directly instead of being rewritten
			// so we call pagesController->home
			$controllerName = 'pagesController';
			$actionName = 'home';
		} else {
			$requestURI = $_SERVER['REDIRECT_URL'];
			$request = Router::parseRequest($requestURI);
		}
		
		
		// get the controller name from the request array (if not set)
		if (empty($controllerName)) 
			$controllerName = array_shift($request) . 'Controller';

		// get the action name from the request array (if not set)
		if (empty($actionName))
			$actionName = array_shift($request);
		
		
		// throw an exception if the controller doesn't exist
		if (!class_exists($controllerName)) {
			throw new Exception('Class '.$controllerName.' does not exist.');
		}
		
		// create an instance of the required controller class
		// (passing in the name of the action we're about to call)
		$controller = new $controllerName($actionName);
		
		// pagesController is a special case because the methods are
		// created dynamically based on the action name passed to the 
		// class constructor. The anonymous function assigned to the 
		// dynamic property fails method_exists() and is_callable(), 
		// so we have to call it separately using call_user_func().
		// This also makes it more difficult to throw exceptions that
		// trap bad page names.
		if ($controllerName == 'pagesController') {
			call_user_func($controller->$actionName);
		} else {

			// throw an exception if the action doesn't exist
			if (!method_exists($controllerName, $actionName)) {
				throw new Exception('Method '.$controllerName.'->'.$actionName.' does not exist.');
			}
			
			// call the controller action method and pass in request params
			$controller->$actionName($request);
		
		}

	}

}

class Authentication {
	
	protected $controller;
	
	protected $settings = array(
		'login_page'	=> 'pages/login',
		'no_access'		=> 'pages/noaccess'
	);
	
	public function __construct(&$controller, $settings) {
		$this->controller = $controller;
		
		// merge settings with defaults
		$this->settings = array_merge($this->settings, $settings);
	}
	
	/**
	 * Check to see if we're currently logged in
	 * and redirect to login page if we're not
	 */
	public function check() {
		// is user logged in?
		if (empty($_SESSION['user'])) {
			// is login data present?
			if (isset($_POST['login']) && isset($_POST['password'])) {
				// is data valid?
				$db = $this->controller->db; // shortcut to DB object
				
				$query = "SELECT id FROM employees WHERE login = '".$db->real_escape_string($_POST['login'])."' AND password = '".sha1($_POST['password'].SECURITY_SALT)."' LIMIT 1";
				
				$result = $db->query($query);
				
				if ($db->affected_rows != 1) {
					// data is NOT valid - redirect to login page
					// redirect to login page
					header('Location: ' . SITE_BASE_URL . $this->settings['login_page']);
					exit(); // always exit after a redirect
				} else {
					// store credentials
					$row = $result->fetch_assoc();
					$_SESSION['user'] = array(
						'userid' => $row['id'],
						'groupids' => array()
					);
					
					// retrieve all the user's group ids
					$query = "SELECT group_id FROM employees_groups WHERE employee_id = '{$row['id']}'";
					
					$results = $db->query($query);
					while($row = $results->fetch_row()) {
						$_SESSION['user']['groupids'][] = $row[0];
					}
				}
				
			} else {
				// redirect to login page
				header('Location: ' . SITE_BASE_URL . $this->settings['login_page']);
				exit(); // always exit after a redirect
			}
		} // if !logged in
		// do they have access to the current resource?
		
		/*
			Resources in this iteration are views/pages on the site
			which are referenced using the controller/action format.
			This URI is stored in the resources table and used for
			lookups.
		*/
		
		// find what resource this is
		$uri = $controller->controllerName.DS.$controller->currentActionName;
		
		$query = "SELECT id FROM resources WHERE uri = '".$uri."'";
		$result = $db->query($query);
		
		// if the resource isn't in the ACL you can either default allow
		// or default deny. Here we will choose default allow.
		if ($db->affected_rows != 1) {
			// default allow
			
			$employee_permission = 1;
			
		} else {
			// get resource id
			$resource_id = $result->get_row()[0];
			
			// check user's permissions
			$query = "SELECT permission FROM employees_resources WHERE employee_id = '".$_SESSION['user']['userid']."' AND resource_id = '".$resource_id."'";

			$result = $db->query($query);
			$employee_permission = $result->get_row()[0];
			
			
			// check group permissions
			
		}
		
		// well?
		if (!$employee_permission) {
			// YOU SHALL NOT PASS!
			// redirect to no access page
			header('Location: ' . SITE_BASE_URL . $this->settings['no_access']);
			exit(); // always exit after a redirect
		}
		
	} // check()
	
} // Authentication

///////// APPLICATION MODULES /////////


class employeesController extends Controller {
	
	public function test($request) {
		
		echo '<p>Employee controller View action called.</p>';
		echo '<pre>'.print_r($request,true).'</pre>';
		
		echo '<p>Parsed Parameters:</p>';
		echo '<pre>'.print_r($this->parseParams($request[0]),true).'</pre>';
		
		
	}
	
	public function viewtest($request) {
		// pass variables into the View instance to be included in the
		// view template
		$this->view->set('testVar1','This is a test.');
		$this->view->set('testVar2','This is another test.');
		
		// test view render
		//$this->view->render(); // render now runs when action completes
	}
	
	/**
	 *	View employee list
	 */
	public function listall($request) {
		
		$query = "SELECT id, firstname, lastname, hire_date, phone, email, last_login FROM employees ";
		
		$results = $this->db->query($query);
		
		if (!$results) {
			// query error
			// doing output directly within the controller will bork the
			// view output, so it's better to do something else here in
			// production
			echo '<p>There was an error with the query.';
			if (DEBUG_MODE) echo '<br />'.$query;
			echo '</p>';
			
		}
		
		// get all rows as an array and pass into the view
		$this->view->set('employeeData',$results->fetch_all(MYSQLI_ASSOC));
		
	}
	
	public function add() {}

	public function edit($request) {
		// get id from request params (first param)
		$id = array_shift($request);
	
		$query = "SELECT * FROM employees WHERE id = '$id'";
		
		$result = $this->db->query($query);
		
		// don't forget error checking
		
		$this->view->set('row', $result->fetch_all(MYSQLI_ASSOC)[0]);
		
	}
	
	public function save($request) {
		
		if (empty($_POST)) {
			// nothing to save
			echo '<p>No data to save.</p>';
			return;
		}
		
		// check for id
		if (!empty($request[0])) {
			$id = $request[0];
		}
		
		// remember to properly sanitize the data before using in query
		// don't forget data validation as well
		
		$query = isset($id) ? 'UPDATE ' : 'INSERT INTO ';
		
		$query .= 'employees SET ';
		
		$c = 0;
		foreach($_POST as $field => $value) {
			
			$field = $this->db->real_escape_string($field);
			$value = $this->db->real_escape_string($value);
			
			if ($field == 'password') {
				// salt and encrypt password
				$value = sha1($value . SECURITY_SALT);
			}
			
			if ($c++ > 0) $query .= ',';
			
			$query .= "$field = '$value'";
			
		}
		
		if (isset($id)) $query .= " WHERE id = '$id'";
		
		$result = $this->db->query($query);
		
		if (!$result) {
			// query error
			echo '<p>There was an error with the query.';
			if (DEBUG_MODE) echo '<br />'.$query;
			echo '</p>';
			return;
		}
		
		$this->view->set('status', true);
		
	}
	
}





