<form action="<?php echo $base_path; ?>users/save" method="post">
<div>
	<label>
		<span>Name:</span>
		<input type="text" name="name" />
	</label>
</div>
<div>
	<label>
		<span>Login:</span>
		<input type="text" name="login" />
	</label>
</div>
<div>
	<label>
		<span>Password:</span>
		<input type="text" name="password" />
	</label>
</div>
<div>
	<label>
		<span>Permission:</span>
		<select name="permission">
			<?php
			foreach($users_permissions as $key => $value) {
				echo '<option value="'.$key.'">'.$value.'</option>';
			}
			?>
		</select>
	</label>
</div>
<div><input type="submit" /></div>
</form>
