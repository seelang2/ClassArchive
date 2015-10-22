<?php
/*
	init.php - system startup
*/

/******** BASE VALUE SETUP ********/
@define('DB_HOSTNAME', 'localhost');
@define('DB_NAME', 'lingprof');
@define('DB_USER', 'root');
@define('DB_PASSWORD', 'xampp');

/******** FILE INCLUDES ********/
require_once('functions.php');

/******** DATABASE SETUP ********/

// connect to db server
$dbLink = @mysql_connect(DB_HOSTNAME, DB_USER, DB_PASSWORD); // use '@' to suppress direct output by a function
if (!$dbLink) exit('Error connecting to database server.');

// select database
$dbH = @mysql_select_db(DB_NAME);
if (!$dbH) exit('Error selecting database.');

// get data from tables to populate dropdowns

// participles
$participleList = getDataArray('SELECT id, description FROM participles');
if ($participleList === false) {
	echo '<p>Error retrieving participle list.</p>';
}

//echo '<pre>'; print_r($participleList); echo '</pre>';

// tenses
$tenseList = getDataArray('SELECT id, description FROM tenses');
if ($tenseList === false) {
	echo '<p>Error retrieving tense list.</p>';
}

// forms
$formList = getDataArray('SELECT id, description FROM forms');
if ($formList === false) {
	echo '<p>Error retrieving form list.</p>';
}

// languages
$languageList = getDataArray('SELECT id, name FROM languages');
if ($languageList === false) {
	echo '<p>Error retrieving language list.</p>';
}


?>