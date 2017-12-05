<?php


// either or condition uses IF .. ELSE structure


// if form data present
if (!empty($_POST)) {
	// process form data
	echo '<h1>Welcome, ' . $_POST['firstname'] . ' ' . $_POST['lastname'] . '!</h1>';

} else {
	// else
	// display blank form

?>

	<form action="demo2.php" method="post">
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
} // if else
?>