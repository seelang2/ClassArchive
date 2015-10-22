<?php
/*
	config.php - application configuration
*/

/////// USER CONFIGURATION SECTION //////////

@define('DBUSER','root');
@define('DBPASSWORD','portable');
@define('DBNAME','tc776');


/////////////////// NO USER CONFIGURATION BELOW THIS LINE //////////////////////

// start sessions
session_start();

require_once('functions.php');

if (!$dbh = db_connect(DBNAME, DBUSER, DBPASSWORD)) exit('<p>Error connecting to database or server.</p>');

?>