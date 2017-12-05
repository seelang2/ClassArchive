<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Example 2a</title>
</head>
<body>

<?php 

echo '_GET contents: <pre>' . print_r($_GET, true) . '</pre><br /><br />';
echo '_POST contents: <pre>' . print_r($_POST, true) . '</pre><br /><br />';
echo '_REQUEST contents: <pre>' . print_r($_REQUEST, true) . '</pre><br /><br />';
echo '_COOKIE contents: <pre>' . print_r($_COOKIE, true) . '</pre><br /><br />';
echo '_ENV contents: <pre>' . print_r($_ENV, true) . '</pre><br /><br />';
echo '_SERVER contents: <pre>' . print_r($_SERVER, true) . '</pre><br /><br />';

// use this
if (isset($_GET['mode'])) $mode = $_GET['mode'];
// OR this:
if (isset($_POST['butSubmit'])) $mode = 'process';

switch ($mode)
{
	case 'process':
		// process form
		echo "<h1>Welcome {$_POST['firstname']} {$_POST['lastname']}!</h1>";
	
	break;
	
	default:
?>

<form action="example2a.php?mode=process" method="post">
	<p>
		First name: 
		<input type="text" name="firstname" size="40" maxlength="50" />
		<br />
		Last name: 
		<input type="text" name="lastname" size="40" maxlength="50" />
		<br />
		<input type="submit" name="butSubmit" value="Continue" />
	</p>
</form>

<?php
	break;
}
?>

</body>
</html>
