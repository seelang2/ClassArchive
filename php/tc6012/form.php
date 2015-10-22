<!DOCTYPE html>
<html>
<head>
	<title>Data Entry Form</title>
	<meta charset="UTF-8" />
	
	<style type="text/css">
	body { 
		font-family: Verdana, Arial, sans-serif;
		font-size: 85%;
		color: #000;
	}
	
	form label {
		display: block;
		margin-bottom: 0.5em;
	}
	
	label span, label input {
		display: inline-block;
	}
	
	label span {
		width: 125px;
		text-align: right;
		margin-right: 1em;
	}
	
	label span:after {
		content: ':';
	}
	</style>
</head>
<body>
	<h1>Step 1: Data Entry</h1>
	
	<form action="process.php?action=process" method="get">
		<label>
			<span>First Name</span>
			<input name="firstname" type="text" />
		</label>
		<label>
			<span>Last Name</span>
			<input name="lastname" type="text" />
		</label>
		<label>
			<span>Email Address</span>
			<input name="email" type="text" />
		</label>
		<div><input type="submit" value="Continue" />
	</form>

</body>
</html>