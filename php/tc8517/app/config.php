<?php
/***
 * config.php - application configuration info
 */

@define('DEBUG_MODE', true); // set to false in production
 
// remember leading and trailing slashes
@define('SITE_BASE_URL', DS.'tc8517'.DS.'app'.DS);
 
@define('BASE_FS_PATH', DS.'tc8517'.DS.'app'.DS); 


// Random string for security salt
@define('SECURITY_SALT', 'dsrgkjlhnE$Ggvewfrg#$T@WER23423W');



// database configuration info

// change this to whichever db connection set you're currently using
$activeDB = 'dev';

/* one approach is to use defined constants - bit of a pain when
   managing multiple database connection options
@define('DB_NAME','tc8517');
@define('DB_USER','root');
@define('DB_PASSWD','xampp');
@define('DB_HOSTNAME','localhost');
*/

$database = array(
	'dev' => array(
		'hostname'	=> 'localhost',
		'user'		=> 'root',
		'password'	=> 'xampp',
		'dbname'	=> 'tc8517'
	),
	
	'live' => array(
		'hostname'	=> 'localhost',
		'user'		=> 'liveuser',
		'password'	=> 'livepassword',
		'dbname'	=> 'livedb'
	)
);

$dbInfo = $database[$activeDB];

