<?php
/**********************************************************************
lib_bitfns.php v2.0 - Bitwise Functions library
Revision date: 29 Sep 2006
Auth: Chris Langtiw

Some code based on work from others and noted where applicable

The following functions are be used instead of the native bitwise 
operators in PHP because PHP does not type unsigned integers

Usage:

Reference: http://www.php.net/manual/en/language.operators.bitwise.php

***********************************************************************/

function bin_xor($a, $b) {
   return bindec(decbin((float)$a ^ (float)$b));
}

function bin_or($a, $b) {
   return bindec(decbin((float)$a | (float)$b));
}

function setbit($bits,$i){
 
 if (($i <= strlen($bits)-1) && ($i >= 0)) {
  $bits[strlen($bits)-1-$i] = "1";
 }
 return $bits; 
}

function unsetbit($bits,$i){
 
 if (($i <= strlen($bits)-1) && ($i >= 0)) {
  $bits[strlen($bits)-1-$i] = "0";
 }
 return $bits; 
}

function getbit($bits,$i){
 
 if (($i <= strlen($bits)-1) && ($i >= 0)) {
  $bit = $bits[strlen($bits)-1-$i];
 }
 return $bit;
}


?>