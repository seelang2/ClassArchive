<?php
/*****************************************************************************
textimage.php - creates image of text entered in GET
Created 4 Aug 2005 Chris Langtiw
Based on authentication image code by Keith McDuffee

This file will produce a JPEG image of any text. It can use any truetype font
as the font (the font does need to be present in the same path as the file).
The font size, color and background color of the image can be used.

The original use for this function was to dynamically create headlines using
fonts that may not be present on visitors' computers. This script is now
used as part of a system to create spambot-resistant email address displays.

Note: This script has only been tested using Verdana. Other fonts that may
use different width proportions may be truncated, so the factor in $img_x
should be modified appropriately.

Also note that it is possible to use hexidecimal encoding on the URL for the
text to be displayed. This is useful if there are special characters such as
spaces, question marks, and other URL-unfriendly content.

Parameters:
FONT		Specify truetype font file to use
TEXT		Text to display
COLOR		Font color (default is black - 000000)
BGCOLOR	Background color (default is white - FFFFFF)
SIZE		Font size

*****************************************************************************/

function create_image($text, $size, $font, $color, $bgcolor, $x = 0, $y = 0)
{
	if ($x > 0) $img_x = $x; else $img_x = $size * 0.8 * strlen($text); // the factor reduces the amount of whitespace at the end of the string
	if ($y > 0) $img_y = $y; else $img_y = $size + 10;
	$img_base = (int)(($size + 10) * 0.75); // a rough guesstimate of where the text baseline should be in the image

	// echo "Text is $text, $img_x, $img_y, $img_base, R: $r G: $g B: $b <br />"; exit;

	$im = @imageCreate($img_x, $img_y) or die("Cannot Initialize new GD image stream");

	$background_color = imageColorAllocate($im, hexdec(substr($bgcolor, 0, 2)), hexdec(substr($bgcolor, 2, 2)), hexdec(substr($bgcolor, 4, 2)));
	$text_color = imageColorAllocate($im, hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));

	ImageTTFText($im, $size, 0, 2, $img_base, $text_color, $font, $text);
/*
	// Date in the past
	header("Expires: Thu, 28 Aug 1997 05:00:00 GMT");

	// always modified
	$timestamp = gmdate("D, d M Y H:i:s");
	header("Last-Modified: " . $timestamp . " GMT");
 
	// HTTP/1.1
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);

	// HTTP/1.0
	header("Pragma: no-cache");
*/
	// dump out the image
	header("Content-type: image/jpeg");
	ImageJPEG($im);

}

if (isset($_GET['text']) && $_GET['text'] != "") $text = $_GET['text']; else $text = "Default Text";
if (isset($_GET['font']) && $_GET['font'] != "") $font = $_GET['font']; else $font = "verdana.ttf";
if (isset($_GET['size']) && $_GET['size'] != "") $size = $_GET['size']; else $size = "13";
if (isset($_GET['color']) && $_GET['color'] != "") $color = $_GET['color']; else $color = "000000";
if (isset($_GET['bgcolor']) && $_GET['bgcolor'] != "") $bgcolor = $_GET['bgcolor']; else $bgcolor = "FFFFFF";
if (isset($_GET['x']) && $_GET['x'] != "") $x = $_GET['x']; else $x = "0";
if (isset($_GET['y']) && $_GET['y'] != "") $y = $_GET['y']; else $y = "0";

create_image($text, $size, $font, $color, $bgcolor, $x, $y);
exit;
?>