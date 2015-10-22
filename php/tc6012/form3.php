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

<?php
	// is form data present?
	if (empty($_POST['processform'])) { 
		// display blank form
		?>
		<h1>Step 1: Data Entry</h1>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<input type="hidden" name="processform" value="1" />
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

		<?php
	} else {
		// process form data
		
		// validate form data using "innocent until proven guilty" approach
		
		// for each form field...
		
			// test field for rule exception(s)
			
			// if exception is found...
			
				// mark form invalid
				
				// handle data error
		
		// if form is valid...
		
			// continue processing
		
		// else..
		
			// display feedback on validation errors
		
		?>
		<h1>Welcome, <?php echo $fullname; ?>!</h1>

		<p>The email you gave us is <?php echo $email; ?>.</p>
		
		<?php
	}
	

?>


</body>
</html>