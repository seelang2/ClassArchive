<?php


// get location data
$query = 'SELECT id, name FROM locations';
$results = $db->query($query);
if (!$results) {
	// query error. display feedback
	echo '<p>Unable to retrieve location data.</p>';
	break; // bail out of case 
}
$locations = [];
while ($row = $results->fetch_assoc()) {
	$locations[$row['id']] = $row['name'];
}
?>

<form action="events.php?action=save<?php echo empty($id)? '':'&id='.$id; ?>" method="post">
	<label>
		<span>Event Name</span>
		<input name="name" 
			value="<?php echo empty($data) ? '': $data['name']; ?>" />
	</label>
	<label>
		<span>Contact Name</span>
		<input name="contactname" 
			value="<?php echo empty($data) ? '': $data['contact_name']; ?>" />
	</label>
	<label>
		<span>Contact Phone</span>
		<input name="contactphone" 
			value="<?php echo empty($data) ? '': $data['contact_phone']; ?>" />
	</label>
	<label>
		<span>Contact Email</span>
		<input name="contactemail" 
			value="<?php echo empty($data) ? '': $data['contact_email']; ?>" />
	</label>
	<fieldset>
		<legend>Event Start Date and Time</legend>
		<select name="startmonth">
			<option value="MM">MM</option>
			<option value="01"<?php echo $startDT['m'] == '01' ? 'selected' : ''; ?>>01</option>
			<option value="02"<?php echo $startDT['m'] == '02' ? 'selected' : ''; ?>>02</option>
			<option value="03"<?php echo $startDT['m'] == '03' ? 'selected' : ''; ?>>03</option>
			<option value="04"<?php echo $startDT['m'] == '04' ? 'selected' : ''; ?>>04</option>
			<option value="05"<?php echo $startDT['m'] == '05' ? 'selected' : ''; ?>>05</option>
			<option value="06"<?php echo $startDT['m'] == '06' ? 'selected' : ''; ?>>06</option>
			<option value="07"<?php echo $startDT['m'] == '07' ? 'selected' : ''; ?>>07</option>
			<option value="08"<?php echo $startDT['m'] == '08' ? 'selected' : ''; ?>>08</option>
			<option value="09"<?php echo $startDT['m'] == '09' ? 'selected' : ''; ?>>09</option>
			<option value="10"<?php echo $startDT['m'] == '10' ? 'selected' : ''; ?>>10</option>
			<option value="11"<?php echo $startDT['m'] == '11' ? 'selected' : ''; ?>>11</option>
			<option value="12"<?php echo $startDT['m'] == '12' ? 'selected' : ''; ?>>12</option>
		</select>
		-
		<select name="startday">
			<option value="DD">DD</option>
			<?php
			for ($c = 1; $c < 32; $c++) {
				echo '<option value="'.$c.'" ';
				if ($c == $startDT['d']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select>
		-
		<select name="startyear">
			<option value="YYYY">YYYY</option>
			<?php
			for ($c = 2025; $c > 1969; $c--) {
				echo '<option value="'.$c.'" ';
				if ($c == $startDT['Y']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select> 

		<select name="starthour">
			<option value="HH">HH</option>
			<?php
			for ($c = 0; $c < 24; $c++) {
				echo '<option value="'.$c.'" ';
				if ($c == $startDT['H']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select>
		:
		<select name="startminute">
			<option value="MM">MM</option>
			<?php
			for ($c = 0; $c < 60; $c+=15) {
				echo '<option value="'.$c.'" ';
				if ($c == $startDT['i']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select>
	</fieldset>
	<fieldset>
		<legend>Event End Date and Time</legend>
		<select name="endmonth">
			<option value="MM">MM</option>
			<option value="01"<?php echo $endDT['m'] == '01' ? 'selected' : ''; ?>>01</option>
			<option value="02"<?php echo $endDT['m'] == '02' ? 'selected' : ''; ?>>02</option>
			<option value="03"<?php echo $endDT['m'] == '03' ? 'selected' : ''; ?>>03</option>
			<option value="04"<?php echo $endDT['m'] == '04' ? 'selected' : ''; ?>>04</option>
			<option value="05"<?php echo $endDT['m'] == '05' ? 'selected' : ''; ?>>05</option>
			<option value="06"<?php echo $endDT['m'] == '06' ? 'selected' : ''; ?>>06</option>
			<option value="07"<?php echo $endDT['m'] == '07' ? 'selected' : ''; ?>>07</option>
			<option value="08"<?php echo $endDT['m'] == '08' ? 'selected' : ''; ?>>08</option>
			<option value="09"<?php echo $endDT['m'] == '09' ? 'selected' : ''; ?>>09</option>
			<option value="10"<?php echo $endDT['m'] == '10' ? 'selected' : ''; ?>>10</option>
			<option value="11"<?php echo $endDT['m'] == '11' ? 'selected' : ''; ?>>11</option>
			<option value="12"<?php echo $endDT['m'] == '12' ? 'selected' : ''; ?>>12</option>
		</select>
		-
		<select name="endday">
			<option value="DD">DD</option>
			<?php
			for ($c = 1; $c < 32; $c++) {
				echo '<option value="'.$c.'" ';
				if ($c == $endDT['d']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select>
		-
		<select name="endyear">
			<option value="YYYY">YYYY</option>
			<?php
			for ($c = 2025; $c > 1969; $c--) {
				echo '<option value="'.$c.'" ';
				if ($c == $endDT['Y']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select> 

		<select name="endhour">
			<option value="HH">HH</option>
			<?php
			for ($c = 0; $c < 24; $c++) {
				echo '<option value="'.$c.'" ';
				if ($c == $endDT['H']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select>
		:
		<select name="endminute">
			<option value="MM">MM</option>
			<?php
			for ($c = 0; $c < 60; $c+=15) {
				echo '<option value="'.$c.'" ';
				if ($c == $endDT['i']) echo 'selected';
				echo '>'.$c.'</option>';
			}
			?>
		</select>
	</fieldset>

	<label>
		<span>Max Attendees</span>
		<input name="maxattendees" 
			value="<?php echo empty($data) ? '': $data['max_attendees']; ?>" />
	</label>

	<label>
		<span>Location</span>
		<select name="location">
			<?php
			foreach ($locations as $id => $name) {
				echo '<option value="'.$id.'" ';
				if ($id == $data['location_id']) echo 'selected';
				echo ' >'.$name.'</option>';
			}
			?>
		</select>
	</label>
	<div>
		<input type="submit" value="Save" />
	</div>
</form>

