<?php

// pass multiple arguments to a function by separating them with commas
function doStuff($message, $element) {
	return '<'.$element.'>'. $message .'</'.$element.'>'; 
}

echo doStuff('This space for rent', 'h1');


