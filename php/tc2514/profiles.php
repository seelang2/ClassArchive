<?php

require_once('config.php');

include('header.php');

if (!empty($_GET['action'])) { $action = strtoupper($_GET['action']); }
if (!empty($_GET['id'])) { $id = escape($_GET['id']); } else { unset($id); }

switch($action) {
	case 'VIEW':
		// check that id is set
		if (empty($id)) {
			echo '<p>Invalid record specified.</p>';
			break; // terminate case 
		}
		// get user data
		$query = "SELECT firstname, lastname, company, title FROM users WHERE id = '$id'";
		$result = @mysql_query($query);
		if (!$result || mysql_num_rows($result) != 1) {
			echo '<p>Error with query.</p>';
			break;
		}
		$userdata = mysql_fetch_array($result);
		// get user content
		$query = "SELECT * FROM content WHERE user_id = '$id'";
		$result = @mysql_query($query);
		if (!$result) {
			echo '<p>Error with query.</p>';
			break;
		}
		
		$usercontent = array();
		while ($data = mysql_fetch_array($result)) {
			$usercontent[] = $data;
		}
		
		//echo '<pre>' . print_r($usercontent,true) . '</pre>';
		
		?>
		<h2>Viewing <?php echo $userdata['firstname'].' '.$userdata['lastname']; ?>'s profile</h2>
        
        <p>Company: <?php echo $userdata['company']; ?></p>
        <p>Title: <?php echo $userdata['title']; ?></p>
        
        <?php
		foreach($usercontent as $content) {
			echo '<hr>';
			echo '<h3>' . $content['tabname'] . '</h3>';
			echo '<div>' . $content['content'] . '</div>';
		}
		
	break; // view
	
	
} // switch

?>


<?php include('footer.php'); ?>