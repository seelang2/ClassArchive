<?php
/**
 * Application startup
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // initialize sessions

require('inc_config.php');
require('inc_functions.php');
require('inc_database.php');

