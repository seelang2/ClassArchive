<?php


echo '<pre>'.print_r($_COOKIE,true).'</pre>';


setCookie('mycookie', $_COOKIE['mycookie'] + 1);

echo '<p>' . $_COOKIE['mycookie'] . '</p>';

if (!empty($_GET['reset'])) {
	// delete the cookie
	setCookie('mycookie', '', 1); // literally one second past UNIX epoch
}

