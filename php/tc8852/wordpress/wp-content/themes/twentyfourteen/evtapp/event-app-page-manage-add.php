<h3>Event Details</h3>
<?php 
global $evtappId, $evtappData; 
?>

<form action="<?php echo $_SERVER['REDIRECT_URL']; ?>?view=manage&action=save<?php echo empty($evtappId) ? '': '&id='.$evtappId; ?>" method="post">

<label>
	<span>Event Name</span>
	<input name="event_name" value="<?php echo empty($evtappData->event_name)?'':$evtappData->event_name; ?>" />
</label>

<div id="eventdate">
	<?php
	// take the value of event_date and parse into segments
	if (!empty($evtappData->event_date)) {
	
		$edData = explode(' ', $evtappData->event_date);
		$edData0 = explode('-', $edData[0]);
		$edData1 = explode(':', $edData[1]);
		$ds = array(
			'yr' => $edData0[0],
			'mt' => $edData0[1],
			'dy' => $edData0[2],
			'hr' => $edData1[0],
			'mn' => $edData1[1]
		);
	}
	?>
	
	<span>Event Date</span>
	<select name="datem" class="datecomponent">
		<option value="">MM</option>
	<?php
		for ($c = 0; $c < 13; $c++) {
			$v = sprintf("%'.02d", $c);
			echo '<option value="'.$v.'" '.(!empty($ds) && $ds['mt'] == $v ?'selected':'').'>'.$v.'</option>';
		}
	?>
	</select>
	
	<select name="dated" class="datecomponent">
		<option value="">DD</option>
	<?php
		for ($c = 1; $c < 32; $c++) {
			$v = sprintf("%'.02d", $c);
			echo '<option value="'.$v.'" '.(!empty($ds) && $ds['dy'] == $v ?'selected':'').'>'.$v.'</option>';
		}
	?>
	</select>
	
	<select name="datey" class="datecomponent">
		<option value="">YYYY</option>
	<?php
		for ($c = 2015; $c < 2020; $c++) {
			$v = sprintf("%'.02d", $c);
			echo '<option value="'.$v.'" '.(!empty($ds) && $ds['yr'] == $v ?'selected':'').'>'.$v.'</option>';
		}
	?>
	</select>
	
	&nbsp;
	
	<span>Event Time</span>
	<select name="timehr" class="datecomponent">
		<option value="">HH</option>
	<?php
		for ($c = 0; $c < 24; $c++) {
			$v = sprintf("%'.02d", $c);
			echo '<option value="'.$v.'" '.(!empty($ds) && $ds['hr'] == $v ?'selected':'').'>'.$v.'</option>';
		}
	?>
	</select>:
	<select name="timemin" class="datecomponent">
		<option value="">MM</option>
	<?php
		for ($c = 0; $c < 61; $c++) {
			$v = sprintf("%'.02d", $c);
			echo '<option value="'.$v.'" '.(!empty($ds) && $ds['mn'] == $v ?'selected':'').'>'.$v.'</option>';
		}
	?>
	</select>
	<input type="hidden" value="<?php echo empty($evtappData->event_date)?'':$evtappData->event_date; ?>" name="event_date" />
</div>

<label>
	<span>Duration</span>
	<select name="duration">
		<option value="30" <?php echo !empty($evtappData->duration) && $evtappData->duration == 30 ?'selected':''; ?>>30 Minutes</option>
		<option value="60" <?php echo !empty($evtappData->duration) && $evtappData->duration == 60 ?'selected':''; ?>>1 hour</option>
		<option value="90" <?php echo !empty($evtappData->duration) && $evtappData->duration == 90 ?'selected':''; ?>>1.5 hours</option>
		<option value="120" <?php echo !empty($evtappData->duration) && $evtappData->duration == 120 ?'selected':''; ?>>2 hours</option>
		<option value="150" <?php echo !empty($evtappData->duration) && $evtappData->duration == 150 ?'selected':''; ?>>2.5 hours</option>
		<option value="180" <?php echo !empty($evtappData->duration) && $evtappData->duration == 180 ?'selected':''; ?>>3 hours</option>
		<option value="210" <?php echo !empty($evtappData->duration) && $evtappData->duration == 210 ?'selected':''; ?>>3.5 hours</option>
		<option value="240" <?php echo !empty($evtappData->duration) && $evtappData->duration == 240 ?'selected':''; ?>>4 hours</option>
		<option value="270" <?php echo !empty($evtappData->duration) && $evtappData->duration == 270 ?'selected':''; ?>>4.5 hours</option>
	</select>
</label>

<label>
	<span>Capacity</span>
	<input name="capacity" value="<?php echo empty($evtappData->capacity)?'':$evtappData->capacity; ?>" />
</label>

<div>
	<button class="btnSave">Save</button>
</div>
</form>