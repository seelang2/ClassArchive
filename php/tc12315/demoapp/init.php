<?php
/**
 * init.php
 */

// database configuration
@define('DB_NAME', 'tc12315');
@define('DB_HOST', 'localhost');
@define('DB_USER', 'root');
@define('DB_PASSWORD', '');


// connect to database server and select database to use

try {
	$db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWORD);
} catch (PDOException $error) {
	echo 'Error connecting to server: '. $error->getMessage();
	exit(); // terminate script
}


// get URI parameters

// module refers to module operation
if (empty($_GET['module'])) { 
	$module = 'MAIN'; 
} else { 
	$module = strtoupper($_GET['module']);
}

// action refers to module operation
if (empty($_GET['action'])) { 
	$action = 'LIST'; 
} else { 
	$action = strtoupper($_GET['action']);
}

// id refers to record identifier
if (empty($_GET['id'])) { 
	unset($id); // ensure $id is not set 
} else { 
	$id = strtoupper($_GET['id']);
}



