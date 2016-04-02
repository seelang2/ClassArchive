<?php
// is form data present?
if (empty($_POST)) {
	// display blank form
?>
	<!-- use raw HTML to create form -->
	<form action="formpage.php" method="post">
		<div>
			<label for="firstname">First Name:</label>
			<input id="firstname" name="firstname" />
		</div>
		<div>
			<label for="lastname">Last Name:</label>
			<input id="lastname" name="lastname" />
		</div>
		<div>
			<input type="submit" value="Continue" />
		</div>
	</form>
<?php
} else {
	// process form data

	echo "<p>Welcome, {$_POST['firstname']} " . 
	     "{$_POST['lastname']}!</p>";

}
?>