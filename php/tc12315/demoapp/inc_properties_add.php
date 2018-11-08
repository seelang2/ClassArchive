<?php
/**
 * inc_properties_add.php - List properties
 */

?>
<h2>Add New Property</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=processform<?php if (!empty($id)) echo '&id='.$id; ?>" method="post">
	<input type="hidden" name="address_id" value="<?php if (!empty($row['address_id'])) echo $row['address_id']; ?>" />
	<label>
		<span>Property Name:</span>
		<input name="name" value="<?php if (!empty($row['name'])) echo $row['name']; ?>" />
	</label>
	<label>
		<span>Address line 1:</span>
		<input name="address_1" value="<?php if (!empty($row['address_1'])) echo $row['address_1']; ?>" />
	</label>
	<label>
		<span>Address line 2:</span>
		<input name="address_2" value="<?php if (!empty($row['address_2'])) echo $row['address_2']; ?>" />
	</label>
	<label>
		<span>City:</span>
		<input name="city" value="<?php if (!empty($row['city'])) echo $row['city']; ?>" />
	</label>
	<label>
		<span>State:</span>
		<input name="state" value="<?php if (!empty($row['state'])) echo $row['state']; ?>" />
	</label>
	<label>
		<span>Zip:</span>
		<input name="zip" value="<?php if (!empty($row['zip'])) echo $row['zip']; ?>" />
	</label>
	<div><input type="submit" value="Save" /></div>
</form>
