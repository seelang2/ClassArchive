<?php

// output $_GET array
echo '<p>Contents of $_GET: <br />';
foreach($_GET as $key => $value) {
	echo $key . ' -> ' . $value;
	echo '<br />';
}
echo '</p>';

// output $_POST array
echo '<p>Contents of $_POST: <br />';
foreach($_POST as $key => $value) {
	echo $key . ' -> ' . $value;
	echo '<br />';
}
echo '</p>';

?>