<?php
/**********************************************************************
lib_general.php v2.0 - General functions and classes library
Revision date: 29 Sep 2006
Auth: Chris Langtiw

Some code based on work from others and noted where applicable

***********************************************************************/


/**********************************************************************
Description:
Cookie function based on RFC2109 cookie specification 

Usage:

Reference: http://www.faqs.org/rfcs/rfc2109.html
***********************************************************************/
function set_cookie($name, $value, $maxage = NULL, $path = NULL, $domain = NULL, $secure = NULL, $comment = NULL)
{
	
	$header = 'Set-Cookie: ' . urlencode($name) . '=' . urlencode($value) . '; Version=1';
	
	if(isset($maxage)) $header .= "; Max-Age=$maxage";
	if(isset($path)) $header .= "; Path=" . urlencode($path);
	if(isset($domain)) $header .= "; Domain=" . urlencode($domain);
	if(isset($secure)) $header .= "; Secure";
	if(isset($comment)) $header .= "; Comment=" . urlencode($comment);
	
	header($header);
}

/**********************************************************************
Description:
basic redirect

Usage:

Reference:
***********************************************************************/
function redirect($to)
{
	header('Location: ' . $to);
	exit();
}

/**********************************************************************
Description:
Loads a text file into a variable

Usage:

Reference:
***********************************************************************/
function loadfile($fname)
{
	$file = '';
	$fp = fopen($fname,'r');
	while(!feof($fp))
		$file .= fgets($fp,4098);
	return $file;
}

/**********************************************************************
Description:
Makes entries into a globally specified log file based on a global
debug flag

Usage:
// log entry format test - timestamp, script, caller ip, user agent, message
// $msg= date("Y-m-d H:m:s") .",". $_SERVER['PHP_SELF'] .",". $_SERVER['REMOTE_ADDR'] .",". $_SERVER['HTTP_USER_AGENT'] .",". $message ."\n";
// log_debugmsg($msg);

Reference:
***********************************************************************/
function log_debugmsg($msg)
{
	global $debugmode;
	global $logfile;
	if ($debugmode) {
		error_log(date("Y-m-d H:m:s") . " " . $msg . "\n", 3, $logfile);
	}
}

/**********************************************************************
Description:
Cap 1st letter of each word in string
Usage:

Reference:
***********************************************************************/
function properCase($strIn) 
{ 
   $arrTmp = explode(" ", trim($strIn)); 
   $retVal = "";

   for($i=0; $i < count($arrTmp);$i++) 
   { 
         $firstLetter = substr($arrTmp[$i],0,1); 
         $rest = substr($arrTmp[$i],1,strlen($arrTmp[$i]));    
         
         $arrOut[$i] = strtoupper($firstLetter).strtolower($rest); 
     }      
         
   for($j=0; $j < count($arrOut); $j++) 
         $retVal .= $arrOut[$j]." "; 
       
   return trim($retVal); 
             
} 

/**********************************************************************
Description:
Returns a random string version 1

Usage:
// $rand_value=randomstring(10);
// echo "<br>" . randomstring(6);

Reference:
***********************************************************************/
function randomstring($len) 
{
	$i = 0;
	$str = "";
	srand((double)microtime() * 1000000);
	while($i<$len)
	{
		// ascii: 48-57=0-9, 65-90=A-Z, 97-122=a-z
		$str.=chr(rand(65, 90)); 
		$i++;
	}
	
	//   $str=$str.substr(uniqid (""),0,22);
	return $str;
}

/**********************************************************************
Description:
Returns random alphanumeric Aa9 string

Usage:
$x=0; while($x<500) {echo randomstring(8) . "<br>"; $x++;}

Reference:
***********************************************************************/
function rndstring($len) 
{
	$i = 0;
	$str = "";
	srand((double)microtime() * 1000000);
	while($i<$len)
	{
       // ascii: 48-57=0-9, 65-90=A-Z, 97-122=a-z
		switch (rand(1,3))
		{
			case 1:
				$str.=chr(rand(65, 90));
				break;
			case 2:
				$str.=chr(rand(48, 57));
				break;
			case 3:
				$str.=chr(rand(97, 122));
				break;
			default:
				break;
		}
		$i++;
   }
   return $str;
}

/**********************************************************************
Description:
Random number generator $length long
Note that this one doesn't guarantee a certain number of places
since it returns a number up to the specific # digits

Usage:

Reference:
***********************************************************************/
function NumGen2($length)
{
   $limit = pow(10, $length);
   return rand(0, $limit);
}

/**********************************************************************
Description:
Random number generator $length long

Usage:
// echo "<br>" . numgen(6);

Reference:
***********************************************************************/
function NumGen($length)
{
	$randnum = '';
	for ($i = 1; $i <= $length; $i++)
	{
		$randnum .= rand(0, 9);
	}
	return $randnum;
}

/**********************************************************************
Description:
Calculate the difference between 2 dates in YYYY-MM-DD format.
Returns the number of days difference.
Returns negative number if date1 is greater than date2

Usage:
	$date1  today, or any other day
	$date2  date to check against

Reference:
***********************************************************************/
function date_diff($date1, $date2)
{
	
	$d1 = explode("-", $date1);
	$y1 = $d1[0];
	$m1 = $d1[1];
	$d1 = $d1[2];
	
	$d2 = explode("-", $date2);
	$y2 = $d2[0];
	$m2 = $d2[1];
	$d2 = $d2[2];
	
	$date1_set = mktime(0,0,0, $m1, $d1, $y1);
	$date2_set = mktime(0,0,0, $m2, $d2, $y2);
	
	return(round(($date2_set-$date1_set)/(60*60*24))); 
} 

/**********************************************************************
Description:
Function that returns the elapsed time as a string

Usage:

Reference:
***********************************************************************/
function calcElapsedTime($time)
{
	
	// calculate elapsed time (in seconds!)
	$diff = time()-$time;
	$daysDiff = 0; $hrsDiff = 0; $minsDiff = 0; $secsDiff = 0;
	
	$sec_in_a_day = 60*60*24;
	while($diff >= $sec_in_a_day)
	{
		$daysDiff++; $diff -= $sec_in_a_day;
	}

	$sec_in_an_hour = 60*60;
	while($diff >= $sec_in_an_hour)
	{
		$hrsDiff++; $diff -= $sec_in_an_hour;
	}

	$sec_in_a_min = 60;
	while($diff >= $sec_in_a_min)
	{
		$minsDiff++; $diff -= $sec_in_a_min;
	}
	$secsDiff = $diff;
	
	return ('(elapsed time '.$daysDiff.'d '.$hrsDiff.'h '.$minsDiff.'m '.$secsDiff.'s)');
	
}

/**********************************************************************
Description:

Usage:

Reference:
***********************************************************************/
function display_random($target, $num = 0)
{
	if ($num == 0) $num = count($target);
	shuffle($target);
	for ($i = 0; $i < $num; $i++) {
		echo $target[$i];
	}
}

/**********************************************************************
Description:

Usage:

Reference:
***********************************************************************/
function display_static($target, $num = 0)
{
	if ($num == 0) $num = count($target);
	// shuffle($target);
	for ($i = 0; $i < $num; $i++) {
		echo $target[$i];
	}
}

/**********************************************************************
Description:

Usage:

Reference:
***********************************************************************/
function in_arrayr($needle, $haystack) {
  foreach ($haystack as $v) {
   if ($needle == $v) return true;
   elseif (is_array($v)) {
     if (in_arrayr($needle, $v) === true) return true;
   }
  }
  return false;
}

?>