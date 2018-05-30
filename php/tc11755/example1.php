<?php

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Demo Page <?php echo date('l, F jS, Y'); ?></title>

	<style type="text/css">
	</style>
</head>
<body>

<?php

// line comment
/* block comment */

$data = 'Some stuff';

@define('SOME_CONSTANT','This value cannot change.');

echo '<p>' . $data . '</p>';
echo '<p>' . SOME_CONSTANT . '</p>';

$weekdays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

// $x = array(1, 2, 3) <- old form

echo '<p>' . $weekdays[3] . '</p>';

$pillbox = [
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'red',
	'Sat' => 'green'
];

echo '<p> The pill for Monday is ' . $pillbox['Mon'] . '.</p>';

$contacts = [
	['firstname' => 'John', 'lastname' => 'Doe'],
	['firstname' => 'Peter', 'lastname' => 'Doe'],
	['firstname' => 'Mary', 'lastname' => 'Doe']
];

echo '<pre>'.print_r($contacts,true).'</pre>';

echo '<p>'. $contacts[1]['firstname'] .'</p>';

echo '<pre>';
print_r($contacts);
echo '</pre>';

if (1) {

} else if(1) {

} else {

}

switch(true) {
	case 1:
		// do stuff
	break;
	default:
		// if all else fails
	break;
}


for ($c = 0; $c < 10; $c++) {
	echo $c;	
}

$c = 0;
while ($c < 10) {
	echo $c;
	$c++;
}

$c = 0;
do {
	echo $c;
	$c++;
} while ($c < 10);

foreach ($weekdays as $day) {
	echo '<p>'. $day .'</p>';
}

foreach ($pillbox as $key => $value) {
	echo "<p>The pill for {$key}dfgdfdf is $value</p>";
}


function bar($options) {
	echo $options['param1'];
}

bar(['param1' => 'something']);

function bar2($options) {
	return $options['param1'];
}

echo '<hr />';

$stuff = 'bleh.';

function foo() {
	// global $stuff; <-- avoid this
	$stuff = 'stuff';
	return $stuff;
}

echo '<p>'.$stuff.'</p>';
echo '<p>'.foo().'</p>';
echo '<p>'.$stuff.'</p>';

// pass by copy/value
function foo1($stuff) {
	$stuff = 'stuff';
	return $stuff;
}

echo '<p>'.$stuff.'</p>';
echo '<p>'.foo1($stuff).'</p>';
echo '<p>'.$stuff.'</p>';

// & makes the parameter pass by reference
function foo2(&$stuff) { 
	$stuff = 'stuff';
	return $stuff;
}

echo '<p>'.$stuff.'</p>';
echo '<p>'.foo2($stuff).'</p>';
echo '<p>'.$stuff.'</p>';



echo '<hr />';

// loop through a source array and do work
// work is provided by a callback function
function iterate($srcArray, &$output, $callback) {
	// set up loop
	foreach($srcArray as $key => $value) {
		$callback($key, $value, $output);
	}
}

$output = '';

iterate($pillbox, $output, function($day, $pill, &$output) {
	//global $output;
	$output .= '<p>The pill for '.$day.' is '.$pill.'.</p>';
});

echo $output;

?>

</body>
</html>