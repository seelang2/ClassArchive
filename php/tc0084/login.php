<?php
include("config.php");


if (isset($_POST['mode']) && $_POST['mode'] != "") $mode = strtoupper($_POST['mode']); else $mode = '';

switch ($mode)
{
	case 'LOGIN':
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$query = "SELECT id, login, password, name FROM contact WHERE login = '$login' AND password = '$password'";
		
		if (!$result = get_results($query)) {
			echo "<p style=\"color:#FF0000\">The user name or password does not exist or is incorrect.<br />Query: $query<br />MySQL Error: " . mysql_error() . "</p>";
		} else {
			
			$row = $result[0]; // just want first (and only) result row
			
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
			
			header("Location: " . DEFAULT_PAGE);
			exit;
		}

	default:
		include("header.php");
?>
<form action="<?php echo $me; ?>" method="post">
<input type="hidden" name="mode" value="login">
<p>Enter Your Login:<br /><input type="text" name="login" /></p>
<p>Enter Your Password:<br /><input type="password" name="password" /></p>
<input type="submit" name="butSubmit" value="Login" />
</form>


<?php
		include("footer.php");
}
?>