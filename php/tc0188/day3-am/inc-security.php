<?php

// check whether this page came from the login form
if (isset($_POST['fromlogin']) && $_POST['fromlogin'] == 1) {
	// get login form vars
	
	// check login against db
	
	// if good, set session vars with hash & id
	
	// if not good, set status message in session and send back to login


} else {
	// check for hash session var
	
	// if no hash (user not logged in) then send to login
	
	// check hash against db
	
	// if hash checks ok AND permission is >= page perm (if any)


}

?>