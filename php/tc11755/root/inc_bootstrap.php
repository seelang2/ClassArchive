<?php
/**
 * inc_bootstrap.php
 *
 * Put all project-specific implementation and bootstrap code here
 *
 * The difference between inc_config.php and inc_bootstrap.php is that
 * config runs BEFORE the database connection is established, while 
 * bootstrap runs AFTER the database connection is established.
 */


// project-specific classes (controllers, etc.)
require('users_controller.php');



// add ACL entries
Auth::addACLEntry('events.view', 1);
Auth::addACLEntry('events.add', 2);
Auth::addACLEntry('users.view', 255);
Auth::addACLEntry('users.edit', 255);


