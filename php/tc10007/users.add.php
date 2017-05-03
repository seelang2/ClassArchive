
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

<form action="saveuserprocess.php" method="post">
<div>
	<span>Name</span>
	<input name="name" />
</div>

<div>
	<span>Username</span>
	<input name="username"  />
</div>

<div>
	<span>New Password</span>
	<input name="password" />
</div>

<div>
	<span>Phone</span>
	<input name="phone"  />
</div>

<div>
	<span>Email</span>
	<input name="email" />
</div>

<div>
	<span>Status</span>
	<select name="status">
	<?php foreach($userStatus as $value => $label): ?>
		<option value="<?php echo $value; ?>" ><?php echo $label; ?></option>
	<?php endforeach; ?>
	</select>
	<!--<input name="name" value="<?php echo $userStatus[$user['status']]; ?>" /> -->
</div>

<div>
	<span>Type</span>
	<select name="type">
	<?php foreach($userTypes as $value => $label): ?>
		<option value="<?php echo $value; ?>" ><?php echo $label; ?></option>
	<?php endforeach; ?>
	</select>
	<!-- <input name="type" value="<?php echo $userTypes[$user['type']]; ?>" /> -->
</div>

<div>
	<input type="submit" value="Save" /> 
	<a class="btnCancel" href="?controller=users&action=list">Cancel</a> 
</div>
</form>
