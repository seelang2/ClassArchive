<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Demo</title>

	<style type="text/css">
	body, input, select, button {
		font-family: Arial, Verdana, sans-serif;
		font-size: 18px;
	}

	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	form label span,
	form label input {
		display: inline-block;
	}

	form label span { width: 150px; }
	</style>
</head>
<body>

<h1>Event Registration</h1>

<form action="eventprocess.php" method="post">
	<input type="hidden" name="event_id" value="8" />
	<label>
		<span>First Name:</span>
		<input name="firstname" />
	</label>
	<label>
		<span>Last Name:</span>
		<input name="lastname" />
	</label>
	<label>
		<span>Phone:</span>
		<input name="phone" />
	</label>
	<label>
		<span>Email:</span>
		<input name="email" />
	</label>
	<label>
		<span>Address:</span>
		<input name="address1" />
	</label>
	<label>
		<span>Address 2:</span>
		<input name="address2" />
	</label>
	<label>
		<span>City:</span>
		<input name="city" />
	</label>
	<label>
		<span>State:</span>
		<input name="state" />
	</label>
	<label>
		<span>Zip:</span>
		<input name="zip" />
	</label>
	<div><input type="submit" /></div>
</form>




</body>
</html>