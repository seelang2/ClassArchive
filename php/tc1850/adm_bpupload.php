<?php
/***********************************************************************
adm_bpupload.php - Admin Panel Blueprint Upload Module v.1.0
January 2006 Chris Langtiw Copyright (c) 2006

This module allows uploading of blueprint files to be uploaded to the
server. A separate module handles the retrieval and download of the 
uploaded file by the client. The files are indexed in a database using
a random key to identify the file to the client. This enchances security
and the appearance of the download url.

Supporting files:
dl.php - download manager

Change Log
-----------------------------------------------------------------------
2006-01-28	CLL	Initial coding

***********************************************************************/

include_once "adm_config.php"; // config file

// override upload dir
$uploaddir = '/home/jrh4th/public_html/livingeffortlessuk/blueprinting/download/';
$urlpath = 'www.effortlesslivinginstitute.com/blueprinting/download';

$abort = false;

$me = $_SERVER['PHP_SELF'];
$mode = "form";

	include_once "adm_main_header.php";

?>

<script><!--
function delete_confirm() {
input_box=confirm("Are you sure you want to delete this file?");
return input_box;
}
function validatefilename(form) {
if (form.userfile.value == "") {
alert("Please include a file to upload."); 
form.userfile.select();
return false; }

else if (form.userfile.value.indexOf(".mp3") == -1 || form.userfile.value.indexOf(" ") != -1 || form.userfile.value.length < 4) {
alert("Please make sure the filename contains no special characters and ends in the extension .mp3.");
form.userfile.select();
return false; }

else {
return true;
}
}
//--></script>

<h2>Blueprinting Upload Manager</h2>
<p>This module is to upload blueprinting files for clients to download.</p>
<p>Files may have a maximum size of 25MB.</p>
<p><strong>NOTE: Before you upload files, please make sure of the following:</strong><br>
  1. There are <strong>NO SPACES</strong> or <strong>SPECIAL CHARACTERS</strong> (dashes or underscores are okay) in the filename.<br>
  2. The filename ends with the extension <strong>.mp3</strong> </p>
<p>This will help prevent any problems with clients downloading or playing the files. </p>
<?php

// TO BE MOVED TO GENERAL.PHP

function get_dir($path,$max_depth='',$l=0,$total=''){
   if(!is_dir($path)) {
       echo "\nInvalid Path\n"; 
	   return;
   }
   echo "<table border='0' cellpadding='5' cellspacing='0'>";
   $path=substr($path,-1)!="/"?$path."/":$path;
   if(!$l){
       echo "\n<tr><td colspan='4'>Contents of directory $path :</td></tr>\n";
	   echo "\n<tr><td>Permissions</td><td>File Size</td><td>File Name</td><td>&nbsp;</td></tr>\n";
       $total=0;
   }
   if($max_depth==='' || ($max_depth>$l && is_int($max_depth))) $test_depth=true;
   else $test_depth=false;
   $pre="";
   $c=$l;
   while($c--)$pre.="\t";
   $dir=opendir($path);
   while($f=readdir($dir)){
       if($f=="."||$f=="..")continue;
       $file=$path.$f;
       $size="";
       if(is_file($file)||!is_dir($file)){
           $s=filesize($file);
           $total+=$s;
           $size="[ ".fsize($s)." ]";
           }
       else $f.="/";
       while(strlen($size)<16)
           $size=" ".$size;
//       echo "\n".get_permissions(fileperms($file)).$size.$pre."\t".$f;
//       echo "\n<tr><td>".get_permissions(fileperms($file))."</td><td>".$size.$pre."</td><td>".$f."</td><td><a href=\"upld1/download.php?name=$f&mode=view\">View</a>&nbsp;<a href=\"upld1/download.php?name=$f\">Download</a>&nbsp;<a href=\"$me?mode=delete&name=$f\" onclick=\"return delete_confirm();\">Delete</a></td></tr>";
       echo "\n<tr><td>".get_permissions(fileperms($file))."</td><td>".$size.$pre."</td><td>".$f."</td><td>";
       switch ($f)
	   {
	       case 'download.php':
	       case 'dl.php':
	       case 'index.php':
			   echo "&nbsp;</td></tr>";
		   break;
		   default:
			   echo "<a href=\"$urlpath/dl.php?name=$f&mode=view\">View</a>&nbsp;<a href=\"$urlpath/dl.php?name=$f\">Download</a>&nbsp;<a href=\"$me?mode=delete&name=$f\" onclick=\"return delete_confirm();\">Delete</a></td></tr>";
		   break;
       }
	   if(is_dir($file) && $test_depth)
           $total=get_dir($file,$max_depth,$l+1,$total);
   }
   if(!$l)
       echo "\n<tr><td colspan='4'>Total size: ".fsize($total)."</td></tr></table>";
   return $total;
}

function get_permissions($fperms) { 
   $out;
   if($fperms & 0x1000)    // FIFO pipe
     $out = 'p'; 
   elseif($fperms & 0x2000) // Character outecial
     $out = 'c'; 
   elseif($fperms & 0x3000) // Socket [ original value 0xD000, wrong for linux, but this is also registering as a directory... ant ideas?]
     $out = 's';
   elseif($fperms & 0x4000) // Directory
     $out = 'd'; 
   elseif($fperms & 0x6000) // Block outecial
     $out = 'b';
   elseif($fperms & 0x8000) // Regular
     $out = '-';
   elseif($fperms & 0xA000) // Symbolic Link
     $out = 'l';
   else                        // UNKNOWN
     $out = 'u'; 
   // owner
   $out .= (($fperms & 0x0100) ? 'r' : '-') .
         (($fperms & 0x0080) ? 'w' : '-') . 
         (($fperms & 0x0040) ? (($fperms & 0x0800) ? 's' : 'x' ) : 
                                   (($fperms & 0x0800) ? 'S' : '-')); 
   // group
   $out .= (($fperms & 0x0020) ? 'r' : '-') .
         (($fperms & 0x0010) ? 'w' : '-') . 
         (($fperms & 0x0008) ? (($fperms & 0x0400) ? 's' : 'x' ) : 
                                   (($fperms & 0x0400) ? 'S' : '-')); 
   // world
   $out .= (($fperms & 0x0004) ? 'r' : '-') .
           (($fperms & 0x0002) ? 'w' : '-') . 
           (($fperms & 0x0001) ? (($fperms & 0x0200) ? 't' : 'x' ) : 
                                 (($fperms & 0x0200) ? 'T' : '-')); 
   return $out;
 }

function fsize($size) {
       $a = array("B", "KB", "MB", "GB", "TB", "PB");
       $pos = 0;
       while ($size >= 1024) {
               $size /= 1024;
               $pos++;
       }
       return round($size,2)." ".$a[$pos];
}

// usage example
// get_dir("/tmp/");    // full depth
// get_dir("/tmp/",4); //maximum depth set to 4 



// END TEMP FUNCTION SECTION




if (isset($_REQUEST['mode']) && $_REQUEST['mode'] != '') $mode = $_REQUEST['mode'];

switch ($mode)
{
  case 'upload':
	// testimonial entered, process


	if (!is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		// abort procedure if error other than no upload present
		$abort = true;

		// Check error status
		switch($HTTP_POST_FILES['userfile']['error']){
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
		     echo "<p><strong>Error: </strong>You must select a file for upload. Please click the BACK button on your browser to try again.</p>";
			 // $abort = false;
		     break;
		   default: //a default error, just in case!  :)
		     echo "<p><strong>Error: </strong>There was a problem with your upload. Error code: " . $_FILES['userfile']['error'] . " Please click the BACK button on your browser to try again.</p>";
		     break;
		} //switch error  
		$photo_uploaded = false;

	} else {
		// file upload verified, now confirm file type
/*
We are allowing all file types to be uploaded in this utility
		//rejects all .exe, .com, .bat, .zip, .doc and .txt files
		// preg_match('/\\.(exe|com|bat|zip|doc|txt)$/i', $_FILES['userfile']['name'])
		if(!preg_match('/\\.(jpg|gif|tif|png|bmp)$/i', $_FILES['userfile']['name'])) {
		  exit("<p><strong>Error: </strong>You cannot upload this type of file. Only files with the extensions CSV or TXT are allowed. Please click the BACK button on your browser to try again.</p>");
		}
*/		
		// move file to staging area
		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
		$filename = $_FILES['userfile']['name'];

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		   echo "<p><strong>File $filename was successfully uploaded.</strong></p>";
		   $photo_uploaded = true;
		} else {
		   echo "<p><strong>There was a problem while processing your file.</strong></p>";
		   $abort = true;
		}
		
		if (!$abort) {
			// file uploaded ok, now create map link
			// A short nonsequential index must be used to reference this file, ideally without renaming the file
			$filekey = rndstring(6);
			$query = "SELECT * FROM uploads WHERE filekey='$filekey'";
			$keycheck = $db->get_row($query);
			
			// If there are rows present, keep generating key string until unique string is generated
			while ($db->num_rows != 0) {
				$filekey = rndstring(6);
				$keycheck = $db->get_row($query);
			}
			
			// add key and filename to table

			$query = "INSERT INTO uploads SET filekey='$filekey', filename='$filename'";
//			$query = "INSERT INTO 'uploads' (`id`, `filekey`, `filename`) VALUES (\'\', \'$filekey\', \'$filename\')";
			echo "\n<!-- INSERT QUERY: $query -->\n";
			if (!$result = $db->query($query)) {
				// no rows affected or error
				echo "<p><strong>Error: </strong>Unable to add new value to database.</p>";
				$abort = true;
			}
			
			// ask for email address to send notification to
			// moved to separate case section and break statement of this case section removed
		} // if !aborted

	} // if uploaded

//  break; // upload

  case 'email1':
if (isset($_GET['key']) && $_GET['key'] != '') $filekey = $_GET['key'];

	if (!$abort) {

?>
<p><strong>The download link for this file is:<br>http://<?php echo $urlpath; ?>/dl.php?id=<?php echo $filekey; ?></strong></p>
<form action="<?php echo $me; ?>?key=<?php echo $filekey; ?>" method="POST" name="form1">
    <input type="hidden" name="mode" value="email2" />
	<p>Name:&nbsp; <input name="name" type="text"/><br>
	Email:&nbsp; <input name="email" type="text" /></p>
	<p><input type="submit" value="Send Email" /></p>
</form>
<?php	
	} // if !aborted
  break; // email1
  
  case 'email2':
if (isset($_POST['name']) && $_POST['name'] != '') $name = $_POST['name'];
if (isset($_POST['email']) && $_POST['email'] != '') $email = $_POST['email'];
if (isset($_GET['key']) && $_GET['key'] != '') $filekey = $_GET['key'];


$usermsg = <<<EOT
Hello $name!\r
Thank you for signing up for a Mindesign Blueprint with us. We hope you\r
enjoyed your session!\r
\r
We've created a special download link for you so that you can begin\r
using and benefiting from your Blueprint immediately.\r
\r
Here's your download link:\r
http://$urlpath/dl.php?id=$filekey\r
\r
If you have any questions regarding your account, contact us at\r
$infoemail.\r
\r
Warm Regards,\r
\r
$orgname\r
EOT;

			$usermail = new cMail($email,
					NOTIFY_RECIPIENT,
					"Here's the link to download your Blueprint Now!",
					$usermsg);
			if ($usermail->send()) {
				//
			} else {
				//
			}
  break; // email
  
  case 'delete':
    // delete file
	$name = "";
	if (isset($_GET['name']) && $_GET['name'] != '') $name = $_GET['name'];
	if (isset($_GET['key']) && $_GET['key'] != '') $filekey = $_GET['key'];
	// echo "<p>Deleting file $name...</p>";

	if ($name != '' && file_exists($uploaddir . $name)) {
		if (unlink($uploaddir . $name))
			echo "<p><strong>File $name deleted successfully.</strong></p>";
		else
			echo "<p><strong>Error: </strong>Unable to delete the specified file.</p>";
	}
	$query = "DELETE FROM uploads WHERE filekey = '$filekey'";
	if (!$db->query($query)) die('<strong>Error:</strong> Unable to update database.<br />$query');

  break; // delete

  default:
	// Do nothing, really. Moved form display outside of default
  break; // default
} // switch (mode)

?>

<form enctype="multipart/form-data" action="<?php echo $me; ?>" method="POST" name="form1" onsubmit="javascript:validatefilename(this);">
    <input type="hidden" name="mode" value="upload" />
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_size; ?>" />
    <!-- Name of input element determines name in $_FILES array -->

<p>Enter Filename to upload:&nbsp; <input name="userfile" type="file" />&nbsp;&nbsp;<input type="submit" value="Upload File" /></p>
</form>

<?php
	echo "<h3>Files in Upload Database</h3>";
	echo "<table border='1' cellpadding='3' cellspacing='0'>";
	echo "<tr><td><strong>Filename</strong></td><td><strong>File Key</strong></td><td><strong>Options</strong></td></tr>";
	$results = $db->get_results("SELECT * from uploads");
	foreach ($results as $result) {
		echo "<tr><td>$result->filename</td><td>$result->filekey</td><td><a href=\"$me?mode=email1&key=$result->filekey\">View/Email Link</a>&nbsp;&nbsp;<a href=\"http://$urlpath/dl.php?name=$result->filename&mode=view\">View</a>&nbsp;<a href=\"http://$urlpath/dl.php?name=$result->filename\">Download</a>&nbsp;<a href=\"$me?mode=delete&name=$result->filename&key=$result->filekey\" onclick=\"return delete_confirm();\">Delete</a></td></tr>";
		
	}
	echo "</table>";
/*	
	echo "<h3>Upload Directory Contents:</h3>";
	get_dir($uploaddir);
*/
	include_once "adm_main_footer.php";

?>




