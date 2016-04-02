<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page title</title>

</head>
<body>

<form action="form1processor.php" method="get">
	<input type="hidden" name="memberid" value="123xxn" />

	<p>
		<span>First Name:</span> 
		<input name="firstname" type="text" />
	</p>
	<p>
		<span>Last Name:</span> 
		<input name="lastname" type="text" />
	</p>
	<p>
		<span>Email:</span> 
		<input name="email" type="text" />
	</p>
	<div>
		<p>Select your interests:</p>
		<p>
			<input type="checkbox" name="interests[]" value="spores" /> 
			<span>Spores</span>
		</p>
		<p>
			<input type="checkbox" name="interests[]" value="mold" /> 
			<span>Mold</span>
		</p>
		<p>
			<input type="checkbox" name="interests[]" value="fungus" /> 
			<span>Fungus</span>
		</p>
	</div>
	<div>
		<p>Select gender:</p>
		<p>
			<input type="radio" name="gender" value="cismale" />
			<span>Cismale</span>
		</p>
		<p>
			<input type="radio" name="gender" value="cisfemale" />
			<span>Cisfemale</span>
		</p>
		<p>
			<input type="radio" name="gender" value="transmale" />
			<span>Trans male</span>
		</p>
		<p>
			<input type="radio" name="gender" value="transfemale" />
			<span>Trans female</span>
		</p>
		<p>
			<input type="radio" name="gender" value="fluid" />
			<span>Gender Fluid</span>
		</p>
		<p>
			<input type="radio" name="gender" value="non" />
			<span>Non identified</span>
		</p>
		<p>
			<input type="radio" name="gender" value="unspecified" />
			<span>Prefer not to say</span>
		</p>
	</div>
	<p>
		<span>Department:</span> 
		<select name="department">
			<option value="d100">Sales</option>
			<option value="d200">Accounting</option>
			<option value="d300">IT</option>
			<option value="d400">Marketing</option>
			<option value="tsfr">This Space For Rent</option>
		</select>
	</p>
	<p>
		<span>Categories:</span> 
		<select name="categories[]" size="4" multiple>
			<option value="231">Cat1</option>
			<option value="53">Cat2</option>
			<option value="11">Cat3</option>
			<option value="42">Cat4</option>
			<option value="816">Cat5</option>
			<option value="12">Cat6</option>
			<option value="26">Cat7</option>
			<option value="45">Cat8</option>
			<option value="99">Cat9</option>
			<option value="111">Cat10</option>
		</select>
	</p>

	<p><input type="submit" /></p>
</form>


</body>
</html>