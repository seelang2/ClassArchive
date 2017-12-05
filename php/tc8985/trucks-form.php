<form action="trucks.php?action=process<?php echo empty($row)?'':'&id='.$id; ?>" method="post">
	<div>
		<label for="number">Truck Number:</label>
		<input id="number" name="number" 
		  value="<?php echo empty($row)?'':$row['number']; ?>" />
	</div>
	<div>
		<label for="driver_id">Driver ID:</label>
		<select id="driver_id" name="driver_id">
			<?php
			// add option with current driver
			if (!empty($row)) {
				echo '<option value="'.
					 $row['driver_id'].'" selected>'.
					 $row['driver'] .
					 '</option>';
			}
			// build list of available drivers
			while ($driver = $drivers->fetch_assoc()) {
				echo '<option value="'.$driver['id'].'">'.
					 $driver['name'] .
					 '</option>';
			}
			?>
		</select>
	</div>
	<div>
		<label for="client_id">Client ID:</label>
		<select id="client_id" name="client_id">
			<?php
			// add option with current client
			if (!empty($row)) {
				echo '<option value="'.
					 $row['client_id'].'" selected>'.
					 $row['client'] .
					 '</option>';
			}
			// build list of available clients
			while ($client = $clients->fetch_assoc()) {
				if (!empty($row) && $row['client_id'] == $client['id']) continue;
				echo '<option value="'.$client['id'].'">'.
					 $client['name'] .
					 '</option>';
			}
			?>
		</select>
	</div>
	<div>
		<input type="submit" value="Save" />
	</div>
</form>
