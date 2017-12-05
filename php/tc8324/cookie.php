<?php


// can't use empty() here because empty() checks to see if the value
// is not falsey - null, empty string, zero
if (!isset($_COOKIE['myCookie'])) {
	// if the cookie isn't set initialize it to 0
	setcookie('myCookie', 0);

} else {
	// increment the value of myCookie
	setcookie('myCookie', $_COOKIE['myCookie'] + 1);
	
}


echo '<pre>'.print_r($_COOKIE, true).'</pre>';

