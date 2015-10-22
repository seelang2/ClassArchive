<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'Some title here'; ?></title>
</head>
<body>

<?php

echo '<p>This space for rent.</p>' . "\n";
echo "<p>The next line of output</p>\n";

echo 
"	Some test text
		That I have formatted
		(poorly).
";

$message = <<< END
	Now I can
	Format my test
		text in any way
		that I want
	and it's much more reliable
	than using just the quote (')
	character.
END;

echo '<pre>' . $message . '</pre>';

$a = 6;
$a /= 2;
$b = '3';

echo '<p>' . ($a + $b) . '</p>';

$days = array('Sun','Mon','Tue','Wed');
echo '<p>' . $days[3] . '</p>';

$days[] = 'Thu';

$pillbox = array('Mon' => 'orange',
				 'Tue' => 'white',
				 'Wed' => 'purple',
				 'Thu' => 'none',
				 'Fri' => 'green',
				 'Sat' => 'red');

echo '<p>' . $pillbox['Wed'] . '</p>';


if ( $a == 10 ):

else:
	if ($a == 7):
		
	endif;
endif;


switch ($a) {
	case 1:
		// do stuff
	break;
	case 2:
		// do this stuff
	case 3:
		// do more stuff
	break;
	default:
		// if all else fails do this
	break;
} // switch

switch (true) {
	case ($a == 0):
		// do this
	break;
	case ($a > 0 && $a <= 4):
		// do this
	break;
	case ($a > 4 && $a <= 12):
		// do this
	break;
	case ($a > 12 && $a <= 18):
		// or do this
	break;
} // switch

echo '<p>';

for ($c = 0; $c < 10; $c++) {
	echo $c;
}

echo '</p>';
echo '<p>';

$c = 0;
while ($c < 10) {
	echo $c;
	$c++;
}

echo '</p>';
echo '<p>';

$c = 0;
do {
	echo $c;
	$c++;
} while ($c < 10);

echo '</p>';
echo '<p>';

foreach ($pillbox as $key => $value) {
	echo $key . ' = ' . $value . '<br />';
}

echo '</p>';

?>

</body>
</html>