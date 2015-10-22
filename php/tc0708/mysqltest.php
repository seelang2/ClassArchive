<?php

$strDatabaseName = "test";
$db = mysql_connect("localhost:33060", "root", "portable")
	or die("Could not connect to MySQL Server");
//mysql_select_db($strDatabaseName, $db)
//	or die("Could not select the database");

echo "Connected to MySQL";

?>


