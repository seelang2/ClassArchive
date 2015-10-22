

<h1>Add New Employee</h1>

<form action="<?php echo SITE_BASE_URL; ?>employees/save" method="post">
	<input type="hidden" name="status_id" value="1" />
	<input type="hidden" name="optin" value="1" />
	<label>
		<span>First Name</span>
		<input type="text" name="firstname" />
	</label>
	<label>
		<span>Last Name</span>
		<input type="text" name="lastname" />
	</label>
	<label>
		<span>Hire Date</span>
		<input type="text" name="hire_date" />
	</label>
	<label>
		<span>Phone</span>
		<input type="text" name="phone" />
	</label>
	<label>
		<span>Email</span>
		<input type="text" name="email" />
	</label>
	<label>
		<span>Login</span>
		<input type="text" name="login" />
	</label>
	<label>
		<span>Password</span>
		<input type="text" name="password" />
	</label>
	<div>
		<input type="submit" value="Save" />
	</div>
</form>



