<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<link type="text/css" rel="stylesheet" href="style.css" />
	<style type="text/css">
	</style>
</head>
<body>

<h1>Log in</h1>
<?php
if (isset($_GET['error'])) {
	echo '<div class="error">Invalid username or password.</div>';
}
?>
<form action="<?php echo $_GET['from']; ?>" method="post">
	<label>
		<span>Username</span>
		<input name="username" />
	</label>
	<label>
		<span>Password</span>
		<input name="password" />
	</label>
	<div><input type="submit" value="Sign In Now" /></div>
</form>


<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript">



</script>
</body>
</html>