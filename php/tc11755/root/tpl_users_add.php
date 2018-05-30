<?php
	if (!empty($user)) { 
		dumpArray($user);
		$user = $user[0];
		dumpArray($user);
}
?>

<h1><?php if (empty($user['userid'])) echo 'Add New'; else echo 'Edit'; ?> User</h1>
<form action="<?php echo BASE_PATH; ?>users/save<?php echo empty($user['userid']) ? '': '/'.$user['userid']; ?>" method="post">
	<label>
		<span>User Name:</span>
		<input type="text" name="name" 
			value="<?php if (!empty($user['name'])) echo $user['name']; ?>" />
	</label>

	<label>
		<span>Login:</span>
		<input type="text" name="login" 
			value="<?php if (!empty($user['login'])) echo $user['login']; ?>" />
	</label>

	<label>
		<span>Password:</span>
		<input type="text" name="password" 
			value="<?php if (!empty($user['password'])) echo $user['password']; ?>" />
	</label>

	<label>
		<span>Department:</span>
		<?php echo $departmentSelect; ?>
	</label>

	<label>
		<span>Location:</span>
		<?php echo $locationSelect; ?>
	</label>

	<label>
		<span>Type:</span>
		<select name="type">
			<option value="1"<?php if (isset($user) && $user['type'] == 1) echo ' selected'; ?> >Type 1</option>
			<option value="2"<?php if (isset($user) && $user['type'] == 2) echo ' selected'; ?> >Type 2</option>
		</select>
	</label>

	<label>
		<span>Permission:</span>
		<select name="permission">
			<option value="1"<?php if (isset($user) && $user['permission'] == 1) echo ' selected'; ?>>Regular Employee</option>
			<option value="2"<?php if (isset($user) && $user['permission'] == 2) echo ' selected'; ?>>Event Coordinator</option>
			<option value="255"<?php if (isset($user) && $user['permission'] == 255) echo ' selected'; ?>>Sysadmin</option>
		</select>
	</label>

	<label>
		<span>Status:</span>
		<select name="status">
			<option value="0"<?php if (isset($user) && $user['status'] == 0) echo ' selected'; ?>>Inactive</option>
			<option value="1"<?php if (isset($user) && $user['status'] == 1) echo ' selected'; ?>>Active</option>
		</select>
	</label>

	<div><input type="submit" /></div>
</form>
