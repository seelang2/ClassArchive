<?php


echo '<h3>$_POST:</h3>';
echo '<pre>'.print_r($_POST,true).'</pre>';

if ($formIsValid) {
	// check result
	if (!$result) {
		// error
		echo '<p>Query error: <br />'.$query.'</p>';
	} else {
		// success!
		echo '<p>The record has been saved.</p>';
	}

} else {

	// form is invalid
	echo '<p>There was a problem with the form:<br />' .
				implode('<br />',$errorMessages) . 
				'Please go back and correct the errors and try again.</p>';

}
