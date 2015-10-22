<!DOCTYPE html>
<html>
<head>
	<title>Sample Page</title>
	<meta charset="UTF-8" />
	
	<style type="text/css">
	body {
		font-family: Verdana, sans-serif;
		font-size: 85%;
	}
	
	form {
		width: 500px;
	}
	
	form label {
		display: block;
		margin-bottom: 0.5em;
		clear: both;
	}
	
	form label span {
		float: left;
		width: 25%;
	}
	
	</style>
</head>
<body>

<form action="process.php" method="get">
	<label>
		<span>Do you have children?</span>
		<select name="havekids">
			<option value="1">Yes</option>
			<option value="0">No</option>
		</select>
	</label>
	
	<label>
		<span>How old is your oldest child?</span>
		<input type="text" name="age" />
	</label>
	
	<div><input type="submit" value="Continue" /></div>
</form>

</body>
</html>