<?php

// here we have to manually set the separator character because
// in Windows the \ is used while the web browser still uses /

//@define('DS', DIRECTORY_SEPARATOR); // shorten the dir character
@define('DS', '/'); // shorten the dir character

// path to application files including trailing slash
@define('APP_PATH','.'.DS);

require('init.php'); // initialize app



