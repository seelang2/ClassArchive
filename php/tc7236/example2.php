<?php

$pillbox = array(
	'Sun' => 'white',
	'Mon' => 'white',
	'Tue' => 'none',
	'Wed' => 'blue',
	'Thu' => 'orange',
	'Fri' => 'blue',
	'Sat' => 'green'
);



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>
	
	<style type="text/css"></style>
</head>
<body>

<div>
<p>Today is <?php echo date('l, F jS, Y'); ?></p>
</div>

<h1>Lorem ipsum dolor sit amet</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec laoreet erat, a sodales est. Phasellus nec volutpat tellus. Integer sed massa id mauris imperdiet bibendum. Sed elementum sit amet est at euismod. Nulla et scelerisque dui. Sed eu dolor lectus. Sed malesuada sollicitudin elit, interdum porttitor arcu tincidunt vitae. Vestibulum ut magna neque. Quisque vestibulum condimentum ligula non bibendum.</p>

<?php 
if (date('D') == 'Wed') {
?>

<h2>Special Wednesday Stuff</h2>
<p>This content only appears on the page on Wednesdays.</p>

<?php
} // if date
?>

<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent euismod eros vehicula bibendum rutrum. Suspendisse malesuada magna in enim ullamcorper, a mattis sapien scelerisque. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla ullamcorper lacinia mi, a egestas sem condimentum vitae. Fusce euismod vulputate diam, eget mattis ipsum tincidunt ut. Etiam tellus nibh, aliquet et adipiscing vel, posuere nec purus. Maecenas at felis mattis, tincidunt tellus ac, euismod metus. Sed sit amet eros facilisis, aliquam magna et, venenatis metus. Cras a justo vestibulum, fringilla ligula lacinia, facilisis libero. Quisque imperdiet mauris at purus semper congue.</p>

<h2>Remember to take the <?php echo $pillbox[date('D')]; ?> pill today!</h2>



</body>
</html>	