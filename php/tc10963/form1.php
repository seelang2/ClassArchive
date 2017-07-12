<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Form Data Demo</title>

	<style type="text/css">
	form label {
		display: block;
		margin-bottom: 1em;
	}

	label span, label input {
		display: inline-block;
	}

	label span {
		width: 100px;
		text-align: right;
	}

	label span:after {
		content: ':';
	}

	label input + span { text-align: left; }
	label input + span:after { content: ''; }

	</style>
</head>
<body>

<form action="formprocess1.php" method="get">
	<label>
		<span>First Name</span>
		<input name="firstname" />
	</label>

	<label>
		<span>Last Name</span>
		<input name="lastname" />
	</label>

	<label>
		<span>Email</span>
		<input name="email" />
	</label>

	<div>
		<p>Select categories:</p>
		<label>
			<!-- naming the fields with [] lets PHP place values in an array -->
			<input type="checkbox" name="category[]" value="electronics" />
			<span>Electronics</span>
		</label>
		<label>
			<input type="checkbox" name="category[]" value="furniture" />
			<span>Furniture</span>
		</label>
		<label>
			<input type="checkbox" name="category[]" value="appliances" />
			<span>Appliances</span>
		</label>
		<label>
			<input type="checkbox" name="category[]" value="bath" />
			<span>Bath</span>
		</label>
	</div>

	<div><input type="submit" /></div>

</form>


</body>
</html>