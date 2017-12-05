<?php


// if form data present
if (!empty($_GET['firstname']) || !empty($_GET['lastname'])) {
	// process form data
	$fullname = $_GET['firstname'] . ' ' . $_GET['lastname'];
	echo "<h1>Welcome, $fullname!</h1>";
	
	$firstname = strtoupper($_GET['firstname']);
	$lastname = $_GET['lastname'];
	echo '<p>Welcome ' . $firstname . ' ' . $lastname . '!</p>';
	echo "<p>Welcome $firstname $lastname!</p>";
	echo "<p>Welcome {$firstname} {$lastname}!</p>";

	echo '<p>Welcome ' . $_GET['firstname'] . ' ' . strtoupper($_GET['lastname']) . '!</p>';
	echo "<p>Welcome {$_GET['firstname']} {$_GET['lastname']}!</p>";

// else
} else {
	// display blank form
	?>
    <form action="form.php" method="get">
    	<p>
        	<label for="firstname">First Name</label>
            <input id="firstname" name="firstname" />
        </p>
    	<p>
        	<label for="lastname">Last Name</label>
            <input id="lastname" name="lastname" />
        </p>
    	<p>
            <input type="submit" value="Process Form" />
        </p>
    </form>
    <?php
} // if data present

?>