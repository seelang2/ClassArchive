<?php
// load array from data file
$classes = unserialize(file_get_contents('classes.dat'));

$graph_height = 250; // desired height of thermometers in pixels
$graph_width = 250; // desired width of thermometers in pixels

$num_classes = count($classes);
// find max values
$mtd = 0; $mcd = 0; $mta = 0; $mca = 0;
foreach($classes as $class => $data) {
	if ($data['currentamount'] > $mca) { $mca = $data['currentamount']; }
	if ($data['targetamount'] > $mta) { $mta = $data['targetamount']; }
	if ($data['targetdonors'] > $mtd) { $mtd = $data['targetdonors']; }
	if ($data['currentdonors'] > $mcd) { $mcd = $data['currentdonors']; }
}

// calulate and apply scale
$scale = $graph_height / $mta; // formula is s = h/b

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
#container {
	width: 300px;
	margin: 0 auto;
	border: 1px solid #000;
}

#graphbox {
	height: <?php echo $graph_height; ?>px;
	width: <?php echo $graph_width; ?>px;
	overflow: hidden;
	margin: 2em auto;
}

.vbar {
	float: left;
	width: <?php echo ($graph_width / $num_classes) - 20; ?>px;
	margin: 0 10px;
	background: #f00;
	height: <?php echo $graph_height; ?>px;
	/* border: 1px solid #900; */
	text-align: center;
}

div.vbar span {
/*
	position: relative;
	margin-top: -1.5em;
	display: block;
	background: #fff;
*/
	font-size: 80%;
}

.clear { clear: both; height: 1px; overflow: hidden; }

</style>

</head>
<body>
<p>Scale: <?php echo $scale; ?></p>
<div id="container">
	<div id="graphbox">
	<?php
		foreach($classes as $class => $data) {
			// calculate mta top margin
			$mta_top = ($mta - $data['targetamount']);
			echo '<div class="vbar" style="background:#0F0;margin-top:'.($mta_top * $scale).'px">'.
				 '<span>'.$data['targetamount'].'</span>' . "\n";
			
			// calculate top margin
			$mca_top = ($mta - $data['currentamount'] - $mta_top);
			echo '<div class="vbar" style="margin-top:'.($mca_top * $scale) .'px">'.
				 '<span>'.$data['currentamount'].'</span>' .
				 '</div>' . "\n";
		
			// close outside div
			echo '</div>' . "\n";
		}
	?>
	</div>
	<div class="clear"></div>
</div>

</body>
</html>