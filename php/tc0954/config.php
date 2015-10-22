<?php
// config.php

///////// USER CONFIGURATION PARAMETERS ////////////

// define database parameters
@define('DBUSER', 'root');
@define('DBPASSWORD', 'portable');
@define('DBNAME','tc975');
@define('DBHOST', 'localhost');

@define('TEMPLATE_HEADER', 'header.php');
@define('TEMPLATE_FOOTER', 'footer.php');


//////// END OF USER CONFIGURATION. DO NOT ALTER ANYTHING BELOW THIS LINE /////////



$dbcnx = @mysql_connect(DBHOST, DBUSER, DBPASSWORD);

if (!$dbcnx) exit('Error connecting to database server.');

$dbh = @mysql_select_db(DBNAME);

if (!$dbh) exit('Error selecting database.');




?>