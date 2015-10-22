<?php
require_once('config.php');

include('header.php');

if (!empty($_POST['butUpload'])) {
	// handle file upload
	
	// check that file was uploaded
	if (!is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		// file not uploaded, check error
		switch($_FILES['userfile']['error']){
			case 0: //no error; possible file attack!
			echo "<p><strong>Error: </strong>There was a problem with your upload. Please click the BACK button on your browser to try again.</p>";
			break;
			case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
			echo "<p><strong>Error: </strong>The file you are trying to upload is too big. Please click the BACK button on your browser to try again.</p>";
			break;
			case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
			echo "<p><strong>Error: </strong>The file you are trying to upload is too large. The maximum file size is $max_size bytes. Please click the BACK button on your browser to try again.</p>";
			break;
			case 3: //uploaded file was only partially uploaded
			echo "<p><strong>Error: </strong>The file you are trying upload was only partially uploaded. Please click the BACK button on your browser to try again.</p>";
			break;
			case 4: //no file was uploaded
			// echo "<p><strong>Error: </strong>You must select a file for upload. Please click the BACK button on your browser to try again.</p>";
			break;
			default: //a default error, just in case!  :)
			echo "<p><strong>Error: </strong>There was a problem with your upload. Error code: " . $_FILES['userfile']['error'] . " Please click the BACK button on your browser to try again.</p>";
			break;
		} //switch error  
	} else {
		// file was uploaded ok
		
		$filepath = $_SERVER['DOCUMENT_ROOT'] . '/';
		
		$movename =  $filepath . basename($_FILES['userfile']['name']);

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $movename)) {
		   echo "<p><strong>File $filename was successfully uploaded to $movename.</strong></p>";
		} else {
		   echo "<p><strong>There was a problem while processing your file.</strong></p>";
		}
		
	
	}
	


}





?>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="form1">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
    <!-- Name of input element determines name in $_FILES array -->

	<p>Enter Filename to upload:&nbsp; 
	<input name="userfile" type="file" />&nbsp;&nbsp;
	<input type="submit" name="butUpload" value="Upload File" /></p>
</form>


<?php



include('footer.php');
?>