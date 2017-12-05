<?php
/**********************************************************************
lib_graphics.php v2.0 - Graphic Functions library
Revision date: 29 Sep 2006
Auth: Chris Langtiw

Some code based on work from others and noted where applicable

***********************************************************************/

/**********************************************************************
Description:
Function creates a thumbnail from the source image, resizes it so that it fits 
the desired thumb width and height or fills it grabbing maximum image part and 
resizing it, and lastly writes it to destination

Usage:

Reference:
***********************************************************************/
function thumb($filename, $destination, $th_width, $th_height, $forcefill)
{   
   list($width, $height) = getimagesize($filename);

   $source = imagecreatefromjpeg($filename);

   if($width > $th_width || $height > $th_height){
     $a = $th_width/$th_height;
     $b = $width/$height;

     if(($a > $b)^$forcefill)
     {
         $src_rect_width  = $a * $height;
         $src_rect_height = $height;
         if(!$forcefill)
         {
           $src_rect_width = $width;
           $th_width = $th_height/$height*$width;
         }
     }
     else
     {
         $src_rect_height = $width/$a;
         $src_rect_width  = $width;
         if(!$forcefill)
         {
           $src_rect_height = $height;
           $th_height = $th_width/$width*$height;
         }
     }

     $src_rect_xoffset = ($width - $src_rect_width)/2*intval($forcefill);
     $src_rect_yoffset = ($height - $src_rect_height)/2*intval($forcefill);

     $thumb  = imagecreatetruecolor($th_width, $th_height);
     imagecopyresized($thumb, $source, 0, 0, $src_rect_xoffset, $src_rect_yoffset, $th_width, $th_height, $src_rect_width, $src_rect_height);

     imagejpeg($thumb,$destination);
   }
}




?>