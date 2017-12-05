<?php
include("config.php");


if (isset($_POST['mode']) && $_POST['mode'] != "") $mode = strtoupper($_POST['mode']); else $mode = '';

switch ($mode)
{
	case 'LOGIN':
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$query = "SELECT login, password, name FROM contact WHERE login = '$login' AND password = '$password'";
		
		$result = @mysql_query($query);
		if (!$result) {
			echo "<p>The user name or password does not exist or is incorrect.<br />Query: $query<br />MySQL Error: " . mysql_error() . "</p>";
		} else {
			
			$row = mysql_fetch_array($result);
			
			$_SESSION['name'] = $row['name'];
			
			
			header("Location: http://216.180.243.58/~tc8401/mainpage.php");
			exit;
		}

	default:
?>
<form action="<?php echo $me; ?>" method="post">
<input type="hidden" name="mode" value="login">
<p>Enter Your Login:<br /><input type="text" name="login" /></p>
<p>Enter Your Password:<br /><input type="password" name="password" /></p>
<input type="submit" name="butSubmit" value="Login" />
</form>


<?php
}
?>