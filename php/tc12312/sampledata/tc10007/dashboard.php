<?php

?>
<h1>Dashboard</h1>

<?php

//echo '<pre>'.print_r($_SESSION['user'],true).'</pre>';


// if this a client, display resources available 

if ($_SESSION['user']['type'] == 1) {
	include ('inc.dashboard.client.php');
} // if user type = 1 (client)

// admin users get a different dashboard

if ($_SESSION['user']['type'] == 2) {
	include ('inc.dashboard.admin.php');
}