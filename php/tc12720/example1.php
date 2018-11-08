<?php 


?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title><?php echo 'Dynamic title'; ?></title>

	<style type="text/css">
	</style>
</head>
<body>

<?php

echo '<p>This space for rent.</p>';

$name = 'John Doe';

echo '<p>' . $name . '</p>';

// standard numerically-indexed array
$weekdays = ['Sun','Mon','Tue'];

echo '<p>' . $weekdays[1] . '</p>';

// associative array
$pillbox = [
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'yellow'];

echo '<p>' . $pillbox['Mon'] . '</p>';

@define('SITE_NAME','mysite.com');
@define('SITE_NAME','mysite2.com'); // @ suppresses direct output

echo '<p>' . SITE_NAME . '</p>';


if (cond) {

} else if (cond) {

} else {

}

switch(value) {
	case 1:
	break;

	default:
	break;
}

for ($c = 0; $c < 10; $c++) {
	echo '<p>' . $c . '</p>';
}

$c = 0;
while ($c < 10) {
	echo '<p>' . $c . '</p>';
	$c++;
}

$c = 0;
do {
	echo '<p>' . $c . '</p>';
	$c++;
} while ($c < 10);

foreach ($pillbox as $value) {
	echo '<p>' . $value . '</p>';
}

foreach ($pillbox as $key => $value) {
	echo '<p>' . $key .' = '. $value . '</p>';
}


function foo() {
	echo '<p>Foo</p>';
}

foo();

function bar() {
	return 'Bar';
}

echo '<p>' . bar() . '</p>';

function doStuff($a, $b = 10) {
	return $a + $b;
}

echo '<p>' . doStuff(10, 10) . '</p>';
echo '<p>' . doStuff(10) . '</p>';


$thing = function() { return 'blah'; };

echo '<p>'.$thing().'</p>';

function doCallback($callback) {
	return $callback();
}

echo '<p>'.doCallback(function() { return 'blah'; }).'</p>';

// function scope and params

function passCopy($c) {
	$c = 10;
	echo '<p>'.$c.'</p>';
}

$c = 1;
echo '<p>'.$c.'</p>';
passCopy($c);
echo '<p>'.$c.'</p>';

function passReference(&$c) { // & means point to original memory location
	$c = 10;
	echo '<p>'.$c.'</p>';
}

$c = 1;
echo '<p>'.$c.'</p>';
passReference($c);
echo '<p>'.$c.'</p>';




?>



</body>
</html>