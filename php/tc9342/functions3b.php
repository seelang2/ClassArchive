<?php

// assign default values to parameters (making them optional)
// inside the parameter block; they become optional params.
// note that optional parameters MUST come after required params
function doStuff($message, $element = 'p') {
	return '<'.$element.'>'. $message .'</'.$element.'>'; 
}

echo doStuff('This space for rent');


// a good practice is to pass in an associative array
// containing all the function parameters when there are 
// many parameters a function may require.
function doStuffBetter($options = array()) {
	// define default parameters inside function
	if (empty($options['message'])) 
		$options['message'] = 'This space for rent.';

	$options['element'] = empty($options['element']) ? 
							'p' : 
							$options['element'];

	return '<'.$options['element'].'>'. 
			 $options['message'] .
		   '</'.$options['element'].'>'; 
}


echo doStuffBetter(array(
	'element' => 'h2',
	'message' => 'Another sample message.'
));

echo doStuffBetter(array(
	'element' => 'h2'
));


