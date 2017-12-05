<?php

$class = '2000';
$target_donors = 650;
$current_donors = 285;
$target_amount = 12500;
$current_amount = 10200;

$thermometer_height = 317; // desired height of thermometers in pixels
$thermometer_width = 50; // desired width of thermometers in pixels

// calculate percentages
$donor_percent = ( $current_donors / $target_donors ) * 100;
$amount_percent = ( $current_amount / $target_amount ) * 100;

$donor_topmargin = 100 - $donor_percent;
$amount_topmargin = 100 - $amount_percent;

// calulate and apply scale
$scale = $thermometer_height / 100; // base is 100px high
$donor_topmargin = $donor_topmargin * $scale;
$amount_topmargin = $amount_topmargin * $scale;

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

.therm-outer, .therm-inner {
	margin: 0 auto;
	padding: 0;
	height: <?php echo $thermometer_height; ?>px;
	overflow: hidden;
	width: <?php echo $thermometer_width; ?>px;
	border: 1px solid #000;
	background: #fff;
	text-align: center;
}

.therm-inner {
	border: none;
	background: #f00;
	margin-top: 0px;
	font-size: 85%;
	overflow: visible;
}

div.therm-inner span {
	position: relative;
	margin-top: -1.5em;
	display: block;
	background: #fff; /* pulling item out of div extends div background color so we cover it */
}

.half {
	margin: 0;
	padding: 0;
	float: left;
	width: 50%;
}

.clear { clear: both; height: 1px; overflow: hidden; }

</style>

</head>
<body>

<div id="container">
	<div class="half">
		<div class="therm-outer">
			<div class="therm-inner" style="margin-top:<?php echo $donor_topmargin; ?>px">
				<span><?php echo $current_donors; ?></span>
			</div>
		</div>
	</div>
	<div class="half">
		<div class="therm-outer">
			<div class="therm-inner" style="margin-top:<?php echo $amount_topmargin; ?>px">
				<span><?php echo $current_amount; ?></span>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

</body>
</html>