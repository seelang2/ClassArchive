<style type="text/css">
.ib-col { 
	display: inline-block;
	margin-right: 1em;
}
</style>

<h1>User List</h1>

<?php

// get user data
$query = "SELECT id, username, name, status, type FROM users";
$results = $db->query($query);
if (!$results) {
	// do error stuff
	//header('Location: '.ERROR_PAGE);
	//exit();
	echo 'There was an error.';
	return;
}

// process results
if ($results->num_rows == 0) {
	// no data
	echo '<p>No users in table.</p>';
} else {
?>

<div id="userlist">
	<div>
		<span>Name</span>
		<span><a href="?controller=users&action=add">Add New User</a></span>

	<?php while($user = $results->fetch_assoc()): ?>
	<div class="useritem">
		<div class="ib-col"><?php echo $user['username']; ?></div>
		<div class="ib-col"><?php echo $user['name']; ?></div>
		<div class="ib-col"><?php echo $userStatus[$user['status']]; ?></div>
		<div class="ib-col"><?php echo $userTypes[$user['type']]; ?></div>
		<div class="ib-col">
			<a href="?controller=users&action=view&id=<?php echo $user['id']; ?>">View</a> | 
			<a href="#">Delete</a>
		</div>
	</div>

	<?php endwhile; ?>

</div>
<?php
}

