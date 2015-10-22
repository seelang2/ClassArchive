

<h1>Add New Employee</h1>

<form action="<?php echo SITE_BASE_URL; ?>employees/save/<?php echo $row['id']; ?>" method="post">
	<input type="hidden" name="status_id" value="<?php echo isset($row['status_id'])? $row['status_id']:''; ?>" />
	<input type="hidden" name="optin" value="<?php echo isset($row['optin'])? $row['optin']:''; ?>" />
	<label>
		<span>First Name</span>
		<input type="text" name="firstname" value="<?php echo isset($row['firstname'])? $row['firstname']:''; ?>" />
	</label>
	<label>
		<span>Last Name</span>
		<input type="text" name="lastname" value="<?php echo isset($row['lastname'])? $row['lastname']:''; ?>" />
	</label>
	<label>
		<span>Hire Date</span>
		<input type="text" name="hire_date" value="<?php echo isset($row['hire_date'])? $row['hire_date']:''; ?>" />
	</label>
	<label>
		<span>Phone</span>
		<input type="text" name="phone" value="<?php echo isset($row['phone'])? $row['phone']:''; ?>" />
	</label>
	<label>
		<span>Email</span>
		<input type="text" name="email" value="<?php echo isset($row['email'])? $row['email']:''; ?>" />
	</label>
	<label>
		<span>Login</span>
		<input type="text" name="login" value="<?php echo isset($row['login'])? $row['login']:''; ?>" />
	</label>
	<label>
		<span>Password</span>
		<input type="text" name="password" value="<?php echo isset($row['password'])? $row['password']:''; ?>" />
	</label>
	<div>
		<input type="submit" value="Save" />
	</div>
</form>



