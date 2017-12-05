<?php
/***********************************************************************
<filename> - <description>
<Create Date> <author> Copyright (c) 2005

<detailed description>

Change Log
-----------------------------------------------------------------------


***********************************************************************/

include_once "adm_config.php"; // config file

$me = $_SERVER['PHP_SELF'];
$mode = "form";

	include_once "adm_main_header.php";

?>

<script><!--
function delete_confirm() {
input_box=confirm("Are you sure you want to delete this file?");
return input_box;
}
//--></script>

<h2>File Upload Manager</h2>
<p>This utility is for sharing files between Admin Panel users. The files uploaded here are not accessible from the website directly.</p>

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
	       case 'index.php':
			   echo "&nbsp;</td></tr>";
		   break;
		   default:
			   echo "<a href=\"upld1/download.php?name=$f&mode=view\">View</a>&nbsp;<a href=\"upld1/download.php?name=$f\">Download</a>&nbsp;<a href=\"$me?mode=delete&name=$f\" onclick=\"return delete_confirm();\">Delete</a></td></tr>";
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
		     // echo "<p><strong>Error: </strong>You must select a file for upload. Please click the BACK button on your browser to try again.</p>";
			 $abort = false;
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

	} // if uploaded

  break; // upload
  
  case 'delete':
    // delete file
	$name = "";
	if (isset($_GET['name']) && $_GET['name'] != '') $name = $_GET['name'];
	// echo "<p>Deleting file $name...</p>";

	if ($name != '' && file_exists($uploaddir . $name)) {
		if (unlink($uploaddir . $name))
			echo "<p><strong>File $name deleted successfully.</strong></p>";
		else
			echo "<p><strong>Error: </strong>Unable to delete the specified file.</p>";
	}

  break; // delete
  
  default:
	// Do nothing, really. Moved form display outside of default
  break; // default
} // switch (mode)

?>

<form enctype="multipart/form-data" action="<?php echo $me; ?>" method="POST" name="form1">
    <input type="hidden" name="mode" value="upload" />
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_size; ?>" />
    <!-- Name of input element determines name in $_FILES array -->

<p>Enter Filename to upload:&nbsp; <input name="userfile" type="file" />&nbsp;&nbsp;<input type="submit" value="Upload File" /></p>
</form>

<p>Upload Directory Contents:</p>
<?php

	get_dir($uploaddir);

	include_once "adm_main_footer.php";

?>




