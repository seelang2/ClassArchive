<?php
/*
function exception_handler($exception) {
  //echo "Uncaught exception: " , $exception->getMessage(), "\n";
  echo "An Error has occurred. Please try again later.";
}

set_exception_handler('exception_handler');
*/

try {
	$db = new PDO('mysql:host=localhost;dbname=tc2278', 'root', 'xamppZ');
} catch (Exception $e) {
	echo 'Error connecting to database.';
}


