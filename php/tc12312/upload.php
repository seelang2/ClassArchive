<?php
/**
 * File upload/processing demo
 *
 * Note that you must make sure that the upload_max_filesize in php.ini 
 * is set to a value large enough to accomodate the anticipated file size.
 * See http://php.net/upload-max-filesize 
 * 
 * In addition, the HTML form needs a MAX_FILE_SIZE field that accommodates 
 * the expected upload file size as well.
 * See http://php.net/manual/en/features.file-upload.post-method.php
 */

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

		// now you can move the uploaded file to a permanent location using 
		// move_uploaded_file() or otherwise process the file.


	
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