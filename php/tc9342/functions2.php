<?php

function doStuff() {
	echo '<p>This space for rent.</p>'; 
}

doStuff(); // function itself does output


function doStuff2() {
	return '<p>This space for rent.</p>'; 
}

echo doStuff2(); // we have to do something with the return value



