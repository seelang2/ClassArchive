<?php
/*
Example to extract the contents of list items in an HTML string to an array.

ref:
http://php.net/manual/en/function.preg-match-all.php

*/

$text = '<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>';

preg_match_all("|<li>(.*)</li>|U", $text, $matches);

echo '<pre>'.print_r($matches, true).'</pre>';

?>