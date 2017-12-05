<?php
require_once('config.php');

if (!empty($_GET['contactid'])) {
	$contactid = escape($_GET['contactid']);
} else {
	unset($contactid);
}

if (!empty($_POST['process'])) {
	// process form data
		// set up validation
		$validated = true;
		$validation_msg = '';
		
		// get data from form and validate fields
		if (empty($_POST['address1'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />address1 cannot be blank.';
		} else {
			$address1 = escape($_POST['address1']);
		}
		
		if (empty($_POST['address2'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />address2 cannot be blank.';
		} else {
			$address2 = escape($_POST['address2']);
		}
		
		if (empty($_POST['city'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />city cannot be blank.';
		} else {
			$city = escape($_POST['city']);
		}
		
		if (empty($_POST['state'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />state cannot be blank.';
		} else {
			$state = escape($_POST['state']);
		}
		
		if (empty($_POST['zip'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Zip cannot be blank.';
		} else {
			$zip = escape($_POST['zip']);
		}
		
		if (empty($_POST['type'])) {
			// validation rule failed
			$validated = false;
			$validation_msg .= '<br />Type cannot be blank.';
		} else {
			$type = escape($_POST['type']);
		}
		
		if ($validated) {
			// build query
			if (empty($id)) {
				$query = "INSERT INTO ";
			} else {
				$query = "UPDATE ";
			}
			
			$query .= "addresses SET " . 
					  "contact_id = '$contactid', " .
					  "address1 = '$address1', " .
					  "address2 = '$address2', " .
					  "city = '$city', " .
					  "state = '$state', " .
					  "zip = '$zip', " .
					  "type = '$type' ";
			
			if (!empty($id)) $query .= " WHERE id = '$id'";
			
			$result = @mysql_query($query);
			
			if (!$result) {
				// error
				echo '<p>There was an error in the SQL query:' .
					 mysql_error() . '<br />Query: ' . $query . '</p>';
				
			} else {
				// query worked
				echo '<p>Record was successfully updated.<br />Query: ' . $query . '</p>';
				
			} // if result
		} else {
			// form invalidated, display validation message
			echo '<p class="errormessage">The following errors were encountered: ' .
				 $validation_msg .
				 '<br />Please go back and try again.</p>';
			
		} // if validated
	
} else {	
	// display form

?>
		<form name="entryform" action="<?php echo $_SERVER['PHP_SELF']; ?>?contactid=<?php echo $contactid; ?>" method="post">
			<input type="hidden" name="process" value="1" />
			<div>
				<label for="address1">Address1:</label>
				<input type="text" name="address1" value="<?php if (isset($row['address1'])) echo $row['address1']; ?>" />
			</div>
			<div>
				<label for="address2">Address2:</label>
				<input type="text" name="address2" value="<?php if (isset($row['address2'])) echo $row['address2']; ?>" />
			</div>
			<div>
				<label for="city">City:</label>
				<input type="text" name="city" value="<?php if (isset($row['city'])) echo $row['city']; ?>" />
			</div>
			<div>
				<label for="state">State:</label>
				<input type="text" name="state" value="<?php if (isset($row['state'])) echo $row['state']; ?>" />
			</div>
			<div>
				<label for="zip">Zip:</label>
				<input type="text" name="zip" value="<?php if (isset($row['zip'])) echo $row['zip']; ?>" />
			</div>
			<div>
				<label for="type">Type:</label>
				<select name="type"><option value="">Select one:</option>
					<?php
						foreach($address_types as $key => $label) {
							echo '<option value="'. $key .'"';
							if ($row['type'] == $key) echo ' selected="selected"';
							echo '>'. $label .'</option>';
							echo '<!-- '.$row['type'].' -->';
						}
					?>
				</select>
			</div>
			<input type="submit" name="butSubmit" value="Enter record" />
		</form>
<?php } ?>