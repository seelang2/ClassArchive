<?php
if (empty($_POST)) {
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
		<p>Select your interests:</p>

		<label>
			<input type="checkbox" name="interests[]" value="1" />
			<span>Spores</span>
		</label>

		<label>
			<input type="checkbox" name="interests[]" value="2" />
			<span>Mold</span>
		</label>

		<label>
			<input type="checkbox" name="interests[]" value="3" />
			<span>Fungus</span>
		</label>

		<div><input type="submit" /></div>
	</form>
<?php
} else {
	echo '<pre>'.print_r($_POST, true).'</pre>';
}

