<?php
/**
 *
 *
 */

session_start(); // initialize sessions

// system config constants
@define('DS', DIRECTORY_SEPARATOR);

// system includes
require_once('inc_functions.php');
require_once('inc_class_config.php');
require_once('inc_class_flash.php');
require_once('inc_class_auth.php');
require_once('inc_class_controller.php');
require_once('inc_class_view.php');

// project-specific configuration code
require_once('inc_config.php');

// database initialization
require_once('inc_database.php');

// project-specific startup code
require_once('inc_bootstrap.php');



