<?php
// is form data present?
if (!empty($_POST)) {
	// process form data
	echo '<p>Processing request...</p>';
	
	// redirect to new location
	header('Location: www.wherever.com');
	exit(); // ALWAYS use exit after a redirect

} else {
	//display blank form
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<style type="text/css">
	form {
		width: 340px;
		margin: auto;
		padding: 10px 20px;
		border: 1px solid #999;
	}
	form label {
		display: block;
		margin: 0 0 0.5em 0;
	}
	form span {
		display: inline-block;
		width: 25%;
	}
	form div {
		text-align: center;
	}
	</style>
</head>
<body>


<form action="forms1.php" method="post">
	<label><span>First Name:</span><input name="firstname" /></label>
	<label><span>Last Name:</span><input name="lastname" /></label>
	<label><span>Login:</span><input name="login" /></label>
	<label><span>Password:</span><input name="password" /></label>
	<div><input type="submit" value="Continue" /></div>
</form>

<?php 
} // if empty $_POST

?>


</body>
</html>