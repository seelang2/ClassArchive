<?php
session_start();
// dump system arrays
echo '<h2>$_GET:</h2><pre>'.print_r($_GET,true)."</pre>\n";
echo '<h2>$_POST:</h2><pre>'.print_r($_POST,true)."</pre>\n";
echo '<h2>$_REQUEST:</h2><pre>'.print_r($_REQUEST,true)."</pre>\n";
echo '<h2>$_COOKIE:</h2><pre>'.print_r($_COOKIE,true)."</pre>\n";
echo '<h2>$_SESSION:</h2><pre>'.print_r($_SESSION,true)."</pre>\n";
echo '<h2>$_SERVER:</h2><pre>'.print_r($_SERVER,true)."</pre>\n";
echo '<h2>$_ENV:</h2><pre>'.print_r($_ENV,true)."</pre>\n";

?>