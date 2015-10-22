<?php
/*
	config.php
*/

// APPLICATION CONFIG PARAMETERS

@define('DB_HOST', 'localhost');
@define('DB_NAME', 'tc2278');
@define('DB_USER', 'root');
@define('DB_PASSWORD', 'xampp');



///////////////// DO NOT MODIFY BELOW THIS LINE /////////////////


// connect to database server
$dblnk = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if (!$dblnk) { exit('Error connecting to database server.'); }

// select database
$dbh = @mysql_select_db(DB_NAME);
if (!$dbh) { exit('Error selecting database.'); }


