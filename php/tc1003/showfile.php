<?php
/***********************************************************************
showfile.php - Display/force download binary file (SQL-based)
2006-05-11 Chris Langtiw Copyright (c) 2005

Code that pulls media from the database and displays it

Option descriptions:

ID 		- Database ID (required)
DC		- Don't Count (increment view counter) if this is set
MODE	- Controls how data is sent to browser. Options are:
	VIEW	- Display contents in browser for appropriate file types
	NOHEAD	- Send raw data to browser
	(none)	- Force download

Change Log
-----------------------------------------------------------------------
2006-05-11	v1.0	Initial coding

***********************************************************************/
require_once('/home/slutsubm/public_html/includes/config.php');
//require_once('/home/slutsubm/public_html/includes/ez_sql.php');

$filename = "";
$mode = "dl";
$viewok = false;
$thumbnail = false;
$tn_size = 100; // thumbnails should be 100px square
//$cache_path = "/home/slutsubm/imgcache/"; // filesystem path to cache directory - now in config.php
//$cache_path = "/home/slutsubm/public_html/cache/"; // filesystem path to cache directory
$video_icon = "video_pic.gif";
$cached = false;

if (isset($_GET['dc']) && $_GET['dc'] != '') $count = false; else $count = true;
if (isset($_GET['mode']) && $_GET['mode'] != '') $mode = strtoupper($_GET['mode']);
if (isset($_GET['id']) && $_GET['id'] != '') $id = $_GET['id'];
if (isset($_GET['tn']) && $_GET['tn'] != '') {
	$thumbnail = true;
	$tn_size = $_GET['tn']; // nah... let's set the thumbnail size dynamically
}

// cache implementing for thumbnail views

// check cache directory to see if thumbnail view of pic exists
if ($thumbnail) {
	$extension = ".png";
	$image_path = $cache_path . $id . "_tn$tn_size" . $extension;
	if (file_exists($image_path)) {
		$cached = true;
	} else {
		$extension = ".jpg";
		$image_path = $cache_path . $id . "_tn$tn_size" . $extension;
		if (file_exists($image_path)) {
			$cached = true;
		} else {
			$extension = ".gif";
			$image_path = $cache_path . $id . "_tn$tn_size" . $extension;
			if (file_exists($image_path)) {
				$cached = true;
			}
		}
	}
}

if ($cached && $thumbnail) {
	// send the cached image to the output buffer (browser)
	readfile($image_path);
}else{
	// pull image from database

//$query = "SELECT filename, blobdata, blobtype FROM binfile WHERE id='$filekey'";
//$query = "SELECT f.id, f.filename, k.filekey, k.blobid FROM binfilename AS f, binfilekeys AS k WHERE k.filekey='$key' AND f.id = k.blobid";
$query = "SELECT " . MEDIA_TBL_ID . ", " . MEDIA_TBL_VIEWED . ", " . MEDIA_TBL_BDATA . ", " . MEDIA_TBL_BTYPE . " FROM " . MEDIA_TABLE . " WHERE " . MEDIA_TBL_ID . " = $id";
//$query = "SELECT f.id, f.filename, k.filekey, k.blobid FROM binfilename AS f, binfilekeys as k WHERE k.filekey='EjtmeE' AND f.id = k.blobid";

$blob = $db->get_row($query, ARRAY_A);

if ($db->num_rows != 1) {
	// no row present, just end (not die)
	exit;
}

if ($count) {
// update view count
	$newcount = $blob[MEDIA_TBL_VIEWED] + 1;
	$query = "UPDATE " . MEDIA_TABLE . " SET " . MEDIA_TBL_VIEWED . " = $newcount WHERE " . MEDIA_TBL_ID . " = $id";
	if (!$db->query($query)) exit; // terminate on unsuccessful update
}

// VIDEO HACK:
// if it's a video and not a thumbnail, just read the actual file in the cache dir
if ((substr($blob[MEDIA_TBL_BTYPE],0,5) == "video") && !$thumbnail) {
	header("Content-Type: " . $blob[MEDIA_TBL_BTYPE]);
	readfile($blob[MEDIA_TBL_BDATA]);
	exit;
}

//preg_match('/\\.(pdf|jpg|jpeg|gif|tif|png|bmp)$/i', $blob[MEDIA_TBL_BTYPE])
if(preg_match('(pdf|jpg|jpeg|gif|tif|png|bmp)', $blob[MEDIA_TBL_BTYPE])) {
	$viewok = true;
}

// create cached thumbnail
if ($thumbnail) {
	if (substr($blob[MEDIA_TBL_BTYPE],0,5) == "video") {
		// it's a video, jsut display video icon
		readfile($cache_path . $video_icon);
	} else {
		/*
			$checkstr = substr($blob[MEDIA_TBL_BDATA],0,80);
			if(preg_match('(jpg|jpeg|jfif)', $checkstr))
			if(preg_match('(gif)', $checkstr))
			if(preg_match('(png)', $checkstr))
		*/	
			$img_size = 100;  // new image width
			$src = imagecreatefromstring($blob[MEDIA_TBL_BDATA]);
			$width = imagesx($src);
			$height = imagesy($src);
			$aspect_ratio = $height/$width;
		/*	
			if ($width <= $tn_size) {
				$new_w = $width;
				$new_h = $height;
			} else {
				$new_w = $tn_size;
				$new_h = abs($new_w * $aspect_ratio);
			}
		*/
			$new_w = $tn_size;
			$new_h = abs($new_w * $aspect_ratio);
			
		//	echo "Size: $img_size | TN Size: $tn_size | Old: $width, $height | New: $new_w, $new_h";
			
			$img = imagecreatetruecolor($new_w,$new_h);
			imagecopyresized($img,$src,0,0,0,0,$new_w,$new_h,$width,$height);
		
			
			switch ($blob[MEDIA_TBL_BTYPE])
			{
				case "image/gif": 
					$extension = ".gif";
					imagegif($img, $cache_path . $id . "_tn$tn_size" . $extension); 
					header("Content-Type: " . $blob[MEDIA_TBL_BTYPE]);
					imagegif($img); 
				break;
				case "image/png": 
					$extension = ".png";
					imagepng($img, $cache_path . $id . "_tn$tn_size" . $extension); 
					header("Content-Type: " . $blob[MEDIA_TBL_BTYPE]);
					imagepng($img); 
				break;
				case "image/jpg":
				case "image/pjpg":
				default: 
					$extension = ".jpg";
					imagejpeg($img, $cache_path . $id . "_tn$tn_size" . $extension);
					header("Content-Type: " . $blob[MEDIA_TBL_BTYPE]);
					imagejpeg($img);
				break;
			}
		//exit;
		//header("Content-Type: " . $blob[MEDIA_TBL_BTYPE]);
		//imagejpeg($img, $cache_path . $id . $extension); // exit;
	} // if video
} else {

// if I wanted to insert code here to determine an appropriate extension it could go here
switch ($blob[MEDIA_TBL_BTYPE])
{
	case "image/gif": $file_extension = ".gif"; break;
	case "image/png": $file_extension = ".png"; break;
	case "image/jpg": $file_extension = ".jpg"; break;
	default: $file_extension = ""; break;
}


$file_extension = "";

if ($viewok) $v=1; else $v=0;
//echo "$mode, $v, " . $blob[MEDIA_TBL_BTYPE]; exit;

switch ($mode)
{
	case "VIEW":
		if ($viewok) {
			// display file to screen settings
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false);
			header("Content-Type: " . $blob[MEDIA_TBL_BTYPE]);
		}
	break;

	case "NOHEAD":
	break;
	
	default:
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: " . $blob[MEDIA_TBL_BTYPE]);
		header("Content-Disposition: attachment; filename=\"file" . $file_extension . "\";");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".@strlen($blob[MEDIA_TBL_BTYPE]));
	break;
}

set_time_limit(0);
echo $blob[MEDIA_TBL_BDATA];
// @readfile("$filename") or die("File not found."); 

} // if thumbnail
} // if file exists
?>