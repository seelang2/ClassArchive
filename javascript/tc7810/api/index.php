<?php
/*******
 * Filename: index.php
 * Version: v.0.1
 * Auth: Chris Langtiw chris@sitebabble.com http://www.sitebabble.com
 * License: Creative Commons Attribution 3.0 Unported License
 * License URL: http://creativecommons.org/licenses/by/3.0/deed.en_US
 *	
 * Description:
 * A simple RESTful back-end service example for use in developing ajax 
 * applications. Can also be used to store simple data without need 
 * for a database.
 *
 * Note that the datafile or directory where the datafile is located 
 * must be writeable.
 *
 * Parameters:
 * range	- Number of results to be returned. Default is all.
 *
 * offset	- Starting array index of result set.
 *
 * callback - Function name to use in JSONP request wrapper
 *
 * Change Log
 * ----------
 * v0.1 - Basic implementation of request methods; only callback param
 * 		  currently supported
 *
 ***/
 
/********* Basic configuration settings *********/

// the URL location to the API directory including trailing slash
define('API_BASE_PATH', '/tc7810/api/');

// data file name
$datafile = 'backend.dat';

/*
  This sample schema is used to create sample data for quick use.
  If the data file doesn't exist when the api is accessed, the schema
  data will be used to create the initial datafile.
  
  The array structure looks like this (JSON notation used for brevity)
  
  [
	"tableName": [
		["field1", "field2", "field3"...],
		{"field1":"value1","field2":"value2","field3":"value3"...},
		...
	],
	...
  ]
  
  The first element in each 'table' (key 0) contains a list of field names
  and should not be returned or accessed as part of a result set.
  
  NOTE: Do NOT include an 'id' PK field as the PK is the array index.
  
  To relate tables together, a FK field should be added with the related
  table name.
  
*/
$schema = array(
	'customers' => array(
		'0' => array('firstname', 'lastname', 'email'),
		'54ca8476c8538' => array(
			'firstname' => 'John',
			'lastname' => 'Doe',
			'email' => 'jdoe@email.com'
		),
		'54ca848abb686' => array(
			'firstname' => 'Jane',
			'lastname' => 'Smith',
			'email' => 'js11@email.com'
		),
		'54ca8fa1c960a' => array(
			'firstname' => 'Mitchell',
			'lastname' => 'Peters',
			'email' => 'pmme@someplace.com'
		),
		'54ca8fba2bae8' => array(
			'firstname' => 'Miranda',
			'lastname' => 'Gonzalez',
			'email' => 'miranda.gonzales@workplace.com'
		)
	),
	'orders' => array (
		'0' => array('customers', 'orderdate', 'ordertotal'),
		'54ca84981d75c' => array(
			'customers' => '54ca8476c8538',
			'orderdate' => '2013/10/13',
			'ordertotal' => '325.00'
		),
		'54ca849ec29b5' => array(
			'customers' => '54ca848abb686',
			'orderdate' => '2014/11/12',
			'ordertotal' => '411.00'
		),
		'54ca84a46cad6' => array(
			'customers' => '54ca8476c8538',
			'orderdate' => '2014/7/21',
			'ordertotal' => '1287.00'
		),
		'54ca8fcd6c337' => array(
			'customers' => '54ca8fba2bae8',
			'orderdate' => '2013/12/11',
			'ordertotal' => '195.00'
		),
		'54ca8fd5a1df6' => array(
			'customers' => '54ca8fa1c960a',
			'orderdate' => '2014/2/21',
			'ordertotal' => '1124.00'
		),
		'54ca8fdb6668a' => array(
			'customers' => '54ca8fba2bae8',
			'orderdate' => '2014/7/9',
			'ordertotal' => '786.00'
		),
		'54ca8fe0c5c76' => array(
			'customers' => '54ca8fa1c960a',
			'orderdate' => '2014/7/16',
			'ordertotal' => '2153.00'
		),
		'54ca8fe784d9e' => array(
			'customers' => '54ca8fba2bae8',
			'orderdate' => '2014/8/1',
			'ordertotal' => '1127.00'
		)
	)
);


/********* No configuration options past this point *********/

// just a quick unique id generator
//echo uniqid();exit();

// set CORS header to allow all access
header('Access-Control-Allow-Origin: *');

// to simulate latency
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 300000) * 10);

// serializes data and saves to text file
function savedata($data, $datafile) {
	// write to serialized file
	$OUTPUT = serialize($data); 
	$fp = fopen($datafile,"w"); 
	fputs($fp, $OUTPUT); 
	fclose($fp); 
}

// reads files and deserializes into array
function loaddata($datafile) {
	// read from serialized file
	return @unserialize(@file_get_contents($datafile));
}

// utility function for debugging
function pr($data) {
	return '<pre>' . print_r($data, true) . '</pre>';
}

// sets HTTP header
function setResponseCode($code) {
	$message = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Switch Proxy',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		//418 => 'I\'m a teapot',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		425 => 'Unordered Collection',
		426 => 'Upgrade Required',
		449 => 'Retry With',
		450 => 'Blocked by Windows Parental Controls',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		509 => 'Bandwidth Limit Exceeded',
		510 => 'Not Extended'
	);
	
	header("HTTP/1.1 {$code} {$message[$code]}");
}

// outputs code
function output($data, $code = 200, $callback = '') {

	$data = json_encode($data);
	
	if (empty($callback)) {
		// set content type header to json
		header('Content-Type: application/json');
	} else {
		// set content type header to script
		header('Content-Type: text/javascript');
		// wrap data in callback function
		$data = $callback.'('.$data.');';
	}

	setResponseCode($code);
	exit($data);
}

// initialize data file with $schema data
if (!file_exists($datafile)) {
	savedata($schema, $datafile);
}
	
// load data
$data = loaddata($datafile);
if (!$data) $data = array();

$range = !isset($_GET['range']) ? count($data) : $_GET['range'];
$offset = !isset($_GET['offset']) ? 1 : $_GET['offset'];
$callback = empty($_GET['callback']) ? '' : $_GET['callback'];


// read request data from standard input into a variable
// ref: http://www.lornajane.net/posts/2008/accessing-incoming-put-data-from-php
parse_str(file_get_contents("php://input"),$REQUEST);


// parse request URI into array of path segments
$pattern = '/'.preg_quote(API_BASE_PATH, '/').'/';

//$request = preg_replace($pattern, '', $_SERVER['REQUEST_URI']);
$request = preg_replace($pattern, '', $_SERVER['REDIRECT_URL']);

// separate request into path segments array
$ps = explode('/', $request);
//echo pr($ps);

/*
  use pattern-matching approach
  In this approach we will determine the pattern the request implements
  and then apply the appropriate query to the request pattern.
  Note that there are two types of queries possible in patterns CIC and CC,
  depending on whether the tables are related via a link table or not.

*/
// determine pattern - C, CI, CIC, CC
$pattern = '';
// loop through request array
$count = count($ps);
for($c = 0; $c < $count; $c++) {
	// is it a collection or an identifier?
	if (array_key_exists($ps[$c], $data)) {
		$pattern .= 'C';
	} else {
		$pattern .= 'I';
	}
}

//echo $pattern;

// take action depending on request method
switch($_SERVER['REQUEST_METHOD']) {
	// invalid request method
	default:
		output(array('message','Method not supported'), 405);
	break;
	// return data set as nested array
	case 'GET':
		// set return data based on pattern
		switch($pattern) {
			default:
				output(array('message','URI not supported'), 400);
			break;
			case 'C':
				// check for valid key
				if (!array_key_exists($ps[0], $data)) {
					// no key, bail with not found
					output(array(), 404);
				}
				
				$tmpData = $data[$ps[0]];
				array_shift($tmpData); // first record is fieldlist
				$result = $tmpData;
			break;
			case 'CI':
				// check for valid key
				if ( (!array_key_exists($ps[0], $data)) || 
					 (!array_key_exists($ps[1], $data[$ps[0]])) ) {
					// no key, bail with bad request
					output(array(), 404);
				}
				
				$result = $data[$ps[0]][$ps[1]];
			break;
			case 'CIC':
			
				$result = array();
				$tmpData = $data[$ps[2]];
				array_shift($tmpData);
				
				foreach($tmpData as $id => $row) {
					if ($row[$ps[0]] == $ps[1]) {
						$result[$id] = $row;
					}
				}
			
			break;
			case 'CC':
				output(array('message','URI not supported'), 400);
			break;
		} // switch
		
		output($result, 200, $callback);
		
	break; // GET
	
	// create a new record and return new id
	case 'POST':
		// set return data based on pattern
		switch($pattern) {
			default:
				output(array('message','URI not supported'), 400);
			break;
			case 'C':
				$id = uniqid();
				$tmpRow = array();
				// loop through 'table' fields and map POST data
				foreach($data[$ps[0]][0] as $fieldName) {
					$tmpRow[$fieldName] = $_POST[$fieldName];
				}
				$data[$ps[0]][$id] = $tmpRow;
			break;
			case 'CI':
				output(array('message','URI not supported'), 400);
			break;
			case 'CIC':
				$id = uniqid();
				$tmpRow = array();
				// loop through 'table' fields and map POST data
				foreach($data[$ps[2]][0] as $fieldName) {
					$tmpRow[$fieldName] = $_POST[$fieldName];
				}
				$tmpRow[$ps[0]] = $ps[1];
				$data[$ps[2]][$id] = $tmpRow;
			break;
			case 'CC':
				output(array('message','URI not supported'), 400);
			break;
		} // switch
		
		output(array('id' => $id), 201);
		
	break; // POST

	case 'PUT':
		// set return data based on pattern
		switch($pattern) {
			default:
				output(array('message','URI not supported'), 400);
			break;
			case 'C':
				output(array('message','URI not supported'), 400);
			break;
			case 'CI':
				// loop through 'table' fields and map POST data
				foreach($data[$ps[0]][0] as $fieldName) {
					$data[$ps[0]][$ps[1]][$fieldName] = $REQUEST[$fieldName];
				}
			break;
			case 'CIC':
				output(array('message','URI not supported'), 400);
			break;
			case 'CC':
				output(array('message','URI not supported'), 400);
			break;
		} // switch
		
		output(array('message' => 'Ok'), 200);
		
	break; // PUT

	case 'DELETE':
		// set return data based on pattern
		switch($pattern) {
			default:
				output(array('message','URI not supported'), 400);
			break;
			case 'C':
				output(array('message','URI not supported'), 400);
			break;
			case 'CI':
				if (empty($data[$ps[0]][$ps[1]])) {
					output(array(), 404);
				}
				
				unset($data[$ps[0]][$ps[1]]);
				savedata($data);
				
				output(array(), 204);
			break;
			case 'CIC':
				output(array('message','URI not supported'), 400);
			break;
			case 'CC':
				output(array('message','URI not supported'), 400);
			break;
		} // switch
	break; // DELETE

} // switch REQUEST_METHOD






