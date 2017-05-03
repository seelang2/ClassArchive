<h1>View User Detail</h1>

<?php
if (empty($id)) {
	// error - no id present
	echo '<p><strong>Error:</strong> No ID present.</p>';
	return;
}

// get user data
$query = "SELECT * FROM users WHERE id = ".$db->real_escape_string($id);
$results = $db->query($query);
if (!$results) {
	// do error stuff
	header('Location: '.ERROR_PAGE);
	exit();
}
$user = $results->fetch_assoc();

?>

<div>
	<span>Name</span>
	<span><?php echo $user['name']; ?></span>
</div>

<div>
	<span>Username</span>
	<span><?php echo $user['username']; ?></span>
</div>

<div>
	<span>Phone</span>
	<span><?php echo $user['phone']; ?></span>
</div>

<div>
	<span>Email</span>
	<span><?php echo $user['email']; ?></span>
</div>

<div>
	<span>Status</span>
	<span><?php echo $userStatus[$user['status']]; ?></span>
</div>

<div>
	<span>Type</span>
	<span><?php echo $userTypes[$user['type']]; ?></span>
</div>

<div>
	<a class="btnEdit" href="?controller=users&action=edit&id=<?php echo $id; ?>">Edit</a> 
	<a class="btnCancel" href="?controller=users&action=list">Cancel</a> 
</div>

