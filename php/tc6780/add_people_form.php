<!DOCTYPE html>
<html>
<head>
	<title>Family Data Entry form</title>
</head>
<body>

<form action="add_people.php" method="post">
	<div>
		<label>
			<span>First Name:</span>
			<input name="firstname" />
		</label>
	</div>
	<div>
		<label>
			<span>Last Name:</span>
			<input name="lastname" />
		</label>
	</div>
	<div>
		<label>
			<span>Phone Number:</span>
			<input name="phone" />
		</label>
	</div>
	
	<div>
		<label for="phone">Phone #:</label>
		<input type="text" name="phone" id="phone">
	</div>
	
	<div>
		<!-- 
		<label>
			<span>DOB:</span>
			<input name="dob" type="date" /> 
		</label>
		-->
		<!--
		<span>Birthday:</span>
		<label>
			<span>Month</span>
			<select name="month">
				<option value="01">January</option>
			</select>
		</label>
		-->
		<span>Birthday:</span>
		
		<label for="month">Month</label>
		<select name="month" id="month">
			<option value="01">January</option>
		</select>

		<label for="day">Day</label>
		<select name="day" id="day">
			<option value="01">1</option>
		</select>

		<label for="year">Year</label>
		<select name="year" id="year">
			<option value="1948">1948</option>
		</select>

	</div>
	<div>
		<label>
			<span>Gender:</span>
			<select name="gender">
				<option value="1">Male</option>
				<option value="2">Female</option>
				<option value="3">Other/non</option>
			</select>
		</label>
	</div>
	
	<div>
		<input type="submit" value="Save" />
	</div>
</form>

</body>
</html>