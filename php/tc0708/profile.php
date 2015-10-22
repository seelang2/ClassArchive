<?php
require_once('config.php');

include 'header.php';

if (isset($_GET['mode']) && !empty($_GET['mode'])) {	 $mode = strtoupper($_GET['mode']); }
if (isset($_GET['id']) && !empty($_GET['id'])) {	 $id = strtoupper($_GET['id']); }

if (empty($id)) { exit('Invalid id.'); }

// get profile data

$query = "SELECT fullname, email, dob, location, yahooid, msnid, lastlogin, statusname" .
	" FROM profiles, relationships " .
	" WHERE profiles.id='$id' AND relationshipstatus_id = relationships.id LIMIT 1";

if (!$result = mysql_query($query)) {
	//query error
} else {
	if (mysql_num_rows($result) != 1) {
		echo '<p>The selected profile could not be found.</p>';	
	} else {
		$profile = mysql_fetch_array($result);
	}
}

// get profile entries

$query = "SELECT entry, type FROM profiledata WHERE profile_id = '$id'";

if (!$result = mysql_query($query)) {
	//query error
} else {
	if (mysql_num_rows($result) < 1) {
		//echo '<p>The selected profile could not be found.</p>';	
	} else {
		$profileentries = array();
		while ($row = mysql_fetch_array($result)) {
			$profileentries[$row['type']] = $row['entry'];
		}
	}
}


// get comments

$query = "SELECT comment.id, timestamp, type, commenttext, fullname FROM comments, profiles " . 
	"WHERE sender_id = profiles.id AND recipient_id = '$id' ORDER BY timestamp DESC";

if (!$result = mysql_query($query)) {
	//query error
} else {
	if (mysql_num_rows($result) < 1) {
		//echo '<p>No comments.</p>';	
	} else {
		$comments = array();
		while ($row = mysql_fetch_array($result)) {
			$comments[$row['id']] = $row;
		}
	}
}

// get friend names and ids

$query = "SELECT profiles.id, fullname FROM profiles, friends WHERE friend_id = profiles.id AND my_profile_id = '$id'";

if (!$result = mysql_query($query)) {
	//query error
} else {
	if (mysql_num_rows($result) < 1) {
		//echo '<p>No comments.</p>';	
	} else {
		$friends = array();
		while ($row = mysql_fetch_array($result)) {
			$friends[$row['id']] = $row;
		}
	}
}


// display profile data
echo "<p>Name: " . $profile['fullname'] . "</p>";

// display profile text entries
// use the type enumerations to make it easy to read
echo "<p>About Me: " . $profileentries[PROFILE_BIO] . "</p>";

// display comments
foreach ($comments as $comment) {
	echo "<p>Comment from: " . $comment['fullname'] . " posted on " . date('d-m-Y H:ia', $comment['timestamp']) . "<br />" .
		$comment['commenttext'] . "</p>";
}


?>





<?php include 'footer.php'; ?>