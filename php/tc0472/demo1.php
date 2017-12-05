<?php

$mode = '';

if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = $_GET['mode'];

switch($mode)
{
	case 'process':

		$firstname = $_GET['firstname'];
		$lastname = $_GET['lastname'];
			
		echo "<p>Welcome, $firstname $lastname!</p>";
	
	break;
	default:
?>

<p><a href="demo1.php?firstname=John&lastname=Doe&mode=process">Click here to continue</a></p>

<?php
	break;
}
?>
