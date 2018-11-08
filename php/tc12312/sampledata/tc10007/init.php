<?php
error_reporting(E_ALL);

// store user info as session data

session_start(); // initialize session and deserialize data

/**
 * List of controllers/actions that are NOT secured. Default is to deny all, then explicitly grant access
 *   1 = clients
 *   2 = admins
 */
$ACL = array(
	'users' => array(
		'2' => array('list', 'add', 'edit', 'view', 'save')
	),
	'resources' => array(
		'1' => array('list', 'view'),
		'2' => array('list', 'add', 'edit', 'view', 'save')
	),
	'clients' => array(
		'2' => array('list', 'add', 'edit', 'view', 'save')
	),
	'pricing' => array(
		'2' => array('list', 'add', 'edit', 'view', 'save')
	)
);

$monthLabels = array(
	'1' => 'Jan',
	'2' => 'Feb',
	'3' => 'Mar',
	'4' => 'Apr',
	'5' => 'May',
	'6' => 'Jun',
	'7' => 'Jul',
	'8' => 'Aug',
	'9' => 'Sep',
	'10' => 'Oct',
	'11' => 'Nov',
	'12' => 'Dec'
);

$qtrLabels = array(
	'1' => 'Q4',
	'2' => 'Q4',
	'3' => 'Q4',
	'4' => 'Q1',
	'5' => 'Q1',
	'6' => 'Q1',
	'7' => 'Q2',
	'8' => 'Q2',
	'9' => 'Q2',
	'10' => 'Q3',
	'11' => 'Q3',
	'12' => 'Q3'
);

$userTypes = array (
	'1' => 'Client',
	'2' => 'Admin'
);

$userStatus = array(
	'Inactive',
	'Active'
);

/**
 * Define system constants
 */
@define('LOGIN_PAGE','login.php');
@define('NOACCESS_PAGE','unauthorized.php');
@define('ERROR_PAGE','error.php');

@define('DOWNLOAD_BASE_URL_PATH','./reports/');
@define('SECURITY_SALT', 'b77939e05ba858b3f74d9b90fae620ec7a045834');

/**
 * Flash message system uses sessions to pass messages to the next request.
 * The message is cleared on each request
 */
$_FLASH = null; // initialize flash var
if (!empty($_SESSION['FLASH'])) {
	$_FLASH = $_SESSION['FLASH'];
	unset($_SESSION['FLASH']); // clear flash data from the session
}


// database connection
$db = new mysqli('localhost', 'root', '', 'tc10007');
if ($db->connect_error) {
    // should actually redirect to error page instead.
	header('Location: '. ERROR_PAGE);
	exit();			
    //exit('Connect Error (' . $db->connect_errno . ') ' . $db->connect_error);
}


// get parameters
$controller = empty($_GET['controller']) ? 'dashboard': strtolower($_GET['controller']);
$action = empty($_GET['action']) ? null: strtolower($_GET['action']);
$id = empty($_GET['id']) ? null: strtolower($_GET['id']);

// login process
// (entire site is secured)


/**
 * Authentication proces
 */

// is user trying to log out
if (isset($_GET['logout'])) {
	// wipe out session information
	$_SESSION = array(); // reset session var to empty array
	// destroy session
	session_destroy();
	// regenerate session id
	session_regenerate_id();
	// set flash message
	session_start(); // create brand new session
	$_SESSION['FLASH'] = 'You have been logged out.';
	// redirect to login page
	header('Location: '.LOGIN_PAGE);
	exit();			
}

// is user logged in?
if (basename($_SERVER['PHP_SELF']) != LOGIN_PAGE && empty($_SESSION['user'])) {
	// is login data present?
	if ( !empty($_POST['username']) && !empty($_POST['password']) ) {
		// login data present - is login valid?
		$query = "SELECT users.id, username, type, clients.id AS client_id FROM users " .
				 "LEFT JOIN clients ON users.id = clients.user_id " . 
				 "WHERE username = '". $db->real_escape_string($_POST['username']) .
				 "' AND password = '". sha1($db->real_escape_string($_POST['password']).SECURITY_SALT) .
				 "' AND status > 0";

		$result = $db->query($query);

		if ( $result->num_rows == 1 ) {
			// found record, retrieve data
			$_SESSION['user'] = $result->fetch_assoc(); 

			// set credentials

			// only clients have resources
			if ($_SESSION['user']['type'] == 1) {
				// get resources user has access to
				$query = "SELECT resource_id FROM clients_resources " . 
						 "WHERE client_id = " . $_SESSION['user']['client_id'];

				$results = $db->query($query);
				$_SESSION['user']['permissions'] = array();
				// loop through result set
				while ($row = $results->fetch_array()) {
					// append value to permission array
					$_SESSION['user']['permissions'][] = $row[0];
				}
			}

			// update tracking
			// update users.last_login with current timestamp

		} else {
			// set error message
			$_SESSION['FLASH'] = 'The username or password is not valid.';
			// redirect to login page
			header('Location: '.LOGIN_PAGE);
			exit();			
		}
	} else {
		// no login data present - redirect to login
		header('Location: '.LOGIN_PAGE);
		exit();
	}
}
