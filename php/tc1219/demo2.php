<?php

echo '<h1>Welcome, ' . $_GET['firstname'] . ' ' . $_GET['lastname'] . '!</h1>';

$fullname = $_GET['firstname'] . ' ' . $_GET['lastname'];

echo '<p>How are you today ' . $fullname . '?</p>';

echo "This won't work.";

//echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"3\">";

//echo '<table border="0" cellpadding="0" cellspacing="0">';


?>
