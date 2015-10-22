<?php
/**********************************************************************
lib_obfuscation.php v2.0 - Obfuscation Functions library
Revision date: 29 Sep 2006
Auth: Chris Langtiw

Some code based on work from others and noted where applicable

***********************************************************************/

/**********************************************************************
Description:
Encodes given string into ascii codes

Usage:

Reference:
***********************************************************************/
function ascii_encode($string)  {
   $encoded = "";
   for ($i=0; $i < strlen($string); $i++)  {
       $encoded .= '&#'.ord(substr($string,$i)).';';    
   }
   return $encoded;
} 

/**********************************************************************
Description:
Encodes given string into hex codes - used for obfuscation in URLs

Usage:

Reference:
***********************************************************************/
function hex_encode ($email_address)    { 
       $encoded = bin2hex("$email_address"); 
       $encoded = chunk_split($encoded, 2, '%'); 
       $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1); 
       return $encoded;    
} 

/**********************************************************************
Description:
Creates obfuscated mailto link using javascript
REQUIRES TEXTIMAGE.PHP

Usage:
// echo mailto("email@domain.com", 13, "", 000000, FFFFFF); 

Reference:
***********************************************************************/
function mailto ($email, $size, $font, $color, $bgcolor) {
	$address = explode("@", $email, 2);
	$account = $address[0] . "@";
	$domain = $address[1];
	$hemail = hex_encode($email);
	$aemail = ascii_encode($email);

$pathfile = DIR_HTTP_INCLUDES . "textimage.php";

$output = <<<EOT
<script language="javascript">
<!-- 
var Domain = "$domain";
var Mailme = "mail" + "to:" + "$account" + Domain;
document.write("<a href=\"#\" onclick=\"parent.location=Mailme\"><img src=\"textimage.php?text=$hemail&size=$size&font=$font&color=$color&bgcolor=$bgcolor\" border=0 alt=\"$aemail\" /></a>");
// -->
</script>
<noscript>
  <img src="$pathfile?text=$hemail&size=$size&font=$font&color=$color&bgcolor=$bgcolor" border=0 alt="$aemail" />
</noscript>
EOT;

	return $output;
}



?>