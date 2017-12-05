<?php
/**********************************************************************
general.php v0.2 - Miscellaneous functions and classes
Auth: Chris Langtiw

General functions and classes for 
Some code based on work from others

***********************************************************************/


function set_cookie($name, $value, $maxage = NULL, $path = NULL, $domain = NULL, $secure = NULL, $comment = NULL)
{
// based on rfc2109 cookie specification http://www.faqs.org/rfcs/rfc2109.html

$header = 'Set-Cookie: ' . urlencode($name) . '=' . urlencode($value) . '; Version=1';

if(isset($maxage)) $header .= "; Max-Age=$maxage";
if(isset($path)) $header .= "; Path=" . urlencode($path);
if(isset($domain)) $header .= "; Domain=" . urlencode($domain);
if(isset($secure)) $header .= "; Secure";
if(isset($comment)) $header .= "; Comment=" . urlencode($comment);

header($header);
}




function loadfile($fname)
{
	$file = '';
	$fp = fopen($fname,'r');
	while(!feof($fp))
		$file .= fgets($fp,4098);
	return $file;
}


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

// Usage: $rand_value=randomstring(10);

// echo "<br>" . randomstring(6);

// This one will do alphanumeric Aa9
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

/* 
$x=0; while($x<500) {echo randomstring(8) . "<br>"; $x++;}
*/

/*
Note that this one doesn't guarantee a certain number of places
since it returns a number up to the specific # digits
*/
function NumGen2($length)
{
   $limit = pow(10, $length);
   return rand(0, $limit);
}

function NumGen($length)
{
   for ($i = 1; $i <= $length; $i++)
   {
       if ($i == 1)
           $randnum = rand(0, 9);
       else
           $randnum .= rand(0, 9);
   }
   
   return $randnum;
}

// echo "<br>" . numgen(6);

// basic redirect
function redirect($to)
{
	header('Location: ' . $to);
	exit();
}

// log entry format test - timestamp, script, caller ip, user agent, message
// echo date("Y-m-d H:m:s") .",". $_SERVER['PHP_SELF'] .",". $_SERVER['REMOTE_ADDR'] .",". $_SERVER['HTTP_USER_AGENT'] .",". $message ."\n";

//////////////////////////
// date_diff Function
//////////////////////////
//
// Calculate the difference between 2 dates in YYYY-MM-DD format.
// Returns the number of days difference.
// Returns negative number if date1 is greater than date2

function date_diff($date1, $date2)
{
//$date1  today, or any other day
//$date2  date to check against
//returns a negative if date1 exceeds date2

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

function calcElapsedTime($time)
{

       // calculate elapsed time (in seconds!)
       $diff = time()-$time;
       $daysDiff = 0; $hrsDiff = 0; $minsDiff = 0; $secsDiff = 0;
       
       $sec_in_a_day = 60*60*24;
       while($diff >= $sec_in_a_day){$daysDiff++; $diff -= $sec_in_a_day;}
       $sec_in_an_hour = 60*60;
       while($diff >= $sec_in_an_hour){$hrsDiff++; $diff -= $sec_in_an_hour;}
       $sec_in_a_min = 60;
       while($diff >= $sec_in_a_min){$minsDiff++; $diff -= $sec_in_a_min;}
       $secsDiff = $diff;

       return ('(elapsed time '.$daysDiff.'d '.$hrsDiff.'h '.$minsDiff.'m '.$secsDiff.'s)');

}

function log_debugmsg($msg)
{
	global $debugmode;
	global $logfile;
	if ($debugmode) {
		error_log(date("Y-m-d H:m:s") . " " . $msg . "\n", 3, $logfile);
	}
}


?>