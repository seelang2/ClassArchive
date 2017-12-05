<?php
/***
 * init.php - application startup
 */


// load configuration info
require_once(APP_PATH.'config.php');

// load core libraries
require_once(APP_PATH.'core.php');

// ... any other files to initialize the app go here


try {	
	Router::route();
} catch (exception $e) {
	// routing failed
	echo '<p>The requested page or resource could not be found.</p>';
	if (DEBUG_MODE) echo '<p>'.$e->getMessage().'</p>';
}



