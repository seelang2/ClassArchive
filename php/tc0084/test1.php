<?php

include "functions.php";
include "header.php";

if (!$dbh = db_connect('tc8401_classdb', 'tc8401_dbuser', 'simple')) exit('Error connecting to database.');

$query = "SELECT * FROM contact";

$result = get_results($query, 'A', true);


/*
echo "<div>";
print_results($result);
echo "</div>";
*/

echo "<div>" . print_results2($result, true) . "</div>";




/*
echo "<pre>" . print_r($result, true) . "</pre>";
reset ($result);
*/


include "footer.php";
?>