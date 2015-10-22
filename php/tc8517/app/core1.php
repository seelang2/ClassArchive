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
		
		$this->view = new View($controllerName, $actionName);
	}
	
	public function __destruct() {
		// render view automatically when class unloads
		$this->view->render();
	}
	
}

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
		
		if (!file_exists($this->fileName)) {
			throw new Exception('View '.$this->fileName.' could not be found.');
		}
		include($this->fileName);
		
	}
	
}

/***
 * Model
 * All code common to all models go here and will be inherited
 * by the individual models
 */
class Model {

}

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

		if (DEBUG_MODE) echo '<p>'.$requestURL.'</p>';

		// convert request to an array
		$request = explode('/', $requestURL);

		if (DEBUG_MODE) echo '<pre>'.print_r($request,true).'</pre>';
		
		return $request;
	}
	
	static function route($requestURI) {
		
		$request = Router::parseRequest($requestURI);
		
		// get the controller name from the request array
		$controllerName = array_shift($request) . 'Controller';

		// get the action name from the request array
		$actionName = array_shift($request);
		
		// throw an exception if the controller doesn't exist
		if (!class_exists($controllerName)) {
			throw new Exception('Class '.$controllerName.' does not exist.');
		}
		
		// create an instance of the required controller class
		// (passing in the name of the action we're about to call)
		$controller = new $controllerName($actionName);

		// throw an exception if the controller doesn't exist
		if (!method_exists($controllerName, $actionName)) {
			throw new Exception('Method '.$controllerName.'->'.$actionName.' does not exist.');
		}
		
		// call the controller action method and pass in request params
		$controller->$actionName($request);

	}

}

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
	
}





