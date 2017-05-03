	<style type="text/css">
	form label {
		display: block;
		margin-bottom: 0.5em;
	}

	label span, label input {
		display: inline-block;
	}

	label span {
		width: 120px;
	}

	label span:after {
		content: ':';
		margin-right: 1em;
	}
	</style>

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

<form action="saveuserprocess.php?id=<?php echo $id; ?>" method="post">
<div>
	<span>Name</span>
	<input name="name" value="<?php echo $user['name']; ?>" />
</div>

<div>
	<span>Username</span>
	<input name="username" value="<?php echo $user['username']; ?>" />
</div>

<div>
	<span>New Password</span>
	<input name="password" />
</div>

<div>
	<span>Phone</span>
	<input name="phone" value="<?php echo $user['phone']; ?>" />
</div>

<div>
	<span>Email</span>
	<input name="email" value="<?php echo $user['email']; ?>" />
</div>

<div>
	<span>Status</span>
	<select name="status">
	<?php foreach($userStatus as $value => $label): ?>
		<option value="<?php echo $value; ?>" <?php echo $user['status'] == $value ? 'selected': ''; ?> ><?php echo $label; ?></option>
	<?php endforeach; ?>
	</select>
	<!--<input name="name" value="<?php echo $userStatus[$user['status']]; ?>" /> -->
</div>

<div>
	<span>Type</span>
	<select name="type">
	<?php foreach($userTypes as $value => $label): ?>
		<option value="<?php echo $value; ?>" <?php echo $user['type'] == $value ? 'selected': ''; ?> ><?php echo $label; ?></option>
	<?php endforeach; ?>
	</select>
	<!-- <input name="type" value="<?php echo $userTypes[$user['type']]; ?>" /> -->
</div>

<div>
	<input type="submit" value="Save" /> 
	<a class="btnCancel" href="?controller=users&action=view&id=<?php echo $id; ?>">Cancel</a> 
</div>
</form>
