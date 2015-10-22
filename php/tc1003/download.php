<?php
/***********************************************************************
<filename> - <description>
<Create Date> <author> Copyright (c) 2005

<detailed description>

Change Log
-----------------------------------------------------------------------


***********************************************************************/

$filename = "";
$mode = "dl";
$viewok = false;
if (isset($_GET['name']) && $_GET['name'] != '') $filename = $_GET['name'];
if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = $_GET['mode'];

if ($filename != '' && file_exists($filename)) {

//           $filename = 'dummy.zip';
           $filename = realpath($filename);

           $file_extension = strtolower(substr(strrchr($filename,"."),1));

           switch ($file_extension) {
               case "pdf": $ctype="application/pdf"; $viewok = true; break;
               case "exe": $ctype="application/octet-stream"; break;
               case "zip": $ctype="application/zip"; break;
               case "doc": $ctype="application/msword"; $viewok = true; break;
               case "xls": $ctype="application/vnd.ms-excel"; $viewok = true; break;
               case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
               case "txt": $ctype="text/html"; $viewok = true; break;
               case "gif": $ctype="image/gif"; $viewok = true; break;
               case "png": $ctype="image/png"; $viewok = true; break;
               case "jpe": case "jpeg":
               case "jpg": $ctype="image/jpg"; $viewok = true; break;
               default: $ctype="application/force-download";
           }

           if (!file_exists($filename)) {
               die("NO FILE HERE");
           }

		   if ($mode == 'view' && $viewok) {
		       // display file to screen settings
		   } else {
               header("Pragma: public");
               header("Expires: 0");
               header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
               header("Cache-Control: private",false);
               header("Content-Type: $ctype");
    	       header("Content-Disposition: attachment; filename=\"".basename($filename)."\";");
    	       header("Content-Transfer-Encoding: binary");
               header("Content-Length: ".@filesize($filename));
		   }

           set_time_limit(0);
           @readfile("$filename") or die("File not found."); 


}


?>