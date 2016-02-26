<form action="trucks.php?action=process<?php echo empty($row)?'':'&id='.$id; ?>" method="post">
	<div>
		<label for="number">Truck Number:</label>
		<input id="number" name="number" 
		  value="<?php echo empty($row)?'':$row['number']; ?>" />
	</div>
	<div>
		<label for="driver_id">Driver ID:</label>
		<input id="driver_id" name="driver_id" 
		  value="<?php echo empty($row)?'':$row['driver_id']; ?>" />
	</div>
	<div>
		<label for="client_id">Client ID:</label>
		<input id="client_id" name="client_id" 
		  value="<?php echo empty($row)?'':$row['client_id']; ?>" />
	</div>
	<div>
		<input type="submit" value="Save" />
	</div>
</form>
