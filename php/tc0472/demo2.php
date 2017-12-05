<?php

$mode = '';
$validated = true;
$errmsg = '';

if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = $_GET['mode'];

// do some form validation
if (isset($_POST['submit'])) {
	if (isset($_POST['firstname']) && $_POST['firstname'] != '') $firstname = $_POST['firstname']; else $validated = false;
	if (isset($_POST['lastname']) && $_POST['lastname'] != '') $lastname = $_POST['lastname']; else $validated = false;

}

if (!$validated) {
	$mode = '';
	$errmsg = '<p>One or more required fields are blank.</p>';
}

switch($mode)
{
	case 'process':

		echo "<p>Welcome, $firstname $lastname!</p>";
	
	break;
	default:
?>
<h1>Demo2.php</h1>
<?php echo $errmsg; ?>

<form action="demo2.php?mode=process" method="post">
	<label>First Name: <input type="text" name="firstname" /></label><br />
	<label>Last Name: <input type="text" name="lastname" /></label><br />
	<input type="submit" name="submit" value="Continue" />
</form>


<?php
	break;
}
?>
