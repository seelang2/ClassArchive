<?php
/**
 * Fund Pricing Update
 *
 */
require_once('init.php');

include('admin_inc_header.php');

// display file upload form if no file upload is present
// Used a switch here instead of an IF..ELSE to make use of break statement's
// ability to terminate a case
switch(true) {
	case !empty($_FILES):

		echo '<pre>'.print_r($_FILES,true).'</pre>';

		// Directory to move uploaded file to. Currently set to same dir as script
		@define('UPLOAD_DIR', dirname($_SERVER['PHP_SELF']));

		// error checking 
		// ref: http://php.net/manual/en/features.file-upload.errors.php
		if ($_FILES['importfile']['error'] > 0) {
			// error encountered
			echo '<p>A file upload error '.$_FILES['importfile']['error'].' has occurred.</p>';
			break; // terminate case and stop processing
		}

		// process CSV file

		$fileData = file_get_contents($_FILES['importfile']['tmp_name']);

		// parse data into rows
		$rows = explode("\n",$fileData);
		// loop through rows
		foreach($rows as $row) {
			// parse row in columns
			$columns = explode(',',$row);
			//echo '<pre>'.print_r($columns,true).'</pre>';

			// strip quotes off text strings
			$columns[0] = str_replace('"', '', $columns[0]); 
			$columns[0] = str_replace("'", '', $columns[0]); 

			// fix date field
			$dateFix = new DateTime($columns[1]);
			$columns[1] = $dateFix->format('Y-m-d');
			// replace empty values with 'null'
			foreach($columns as $index => $value) {
				$columns[$index] = empty($value) ? 'null' : $value;
			}

			// hack fix for last col
			if ($columns[6] == 'null') $columns[7] = 'null';

			// find fund PK based on fundid
			$query = "SELECT id FROM funds WHERE fundid = '".$db->real_escape_string($columns[0])."'";

			$result = $db->query($query);
			if (!$result) continue; // move to next row
			
			// get fund id (PK) from result set
			$id = $result->fetch_assoc()['id'];

			// insert new row into pricing table
			$query = 'INSERT INTO pricing SET ' .
									'fund_id = '. $id.', ' . 
									'update_date = \''. $columns[1].'\', ' . 
									'price_usd = '. $columns[2].', ' . 
									'price_usd_change = '. $columns[3].', ' . 
									'price_gbp = '. $columns[4].', ' . 
									'price_gbp_change = '. $columns[5].', ' . 
									'price_euro = '. $columns[6].', ' . 
									'price_euro_change = '. $columns[7]; 

			echo $query.'<br />';

			$result = $db->query($query);
			if (!$result) continue; // move to next row


		} // foreach $row
	
	break;

	default:
	?>
		<h1>File Upload</h1>
		<!-- ref: http://php.net/manual/en/features.file-upload.post-method.php -->
		<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		    <!-- MAX_FILE_SIZE must precede the file input field -->
		    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
		    <!-- Name of input element determines name in $_FILES array -->
		    Send this file: <input name="importfile" type="file" />
		    <input type="submit" value="Send File" />
		</form>

	<?php
	break;
} // switch(true)

include('admin_inc_footer_top.php');
include('admin_inc_footer_bottom.php'); 