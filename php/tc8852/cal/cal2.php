<?php

/**
 * Gets the calendar month for a given month and year
 */
function getCalendar($month, $year) {
	// get instance of DateTime (more reusable and flexible than date() )
	// note that xx-xx-xxxx assumes dd-mm-yyyy while xx/xx/xxxx assumes mm/dd/yyyy
	$calDate = new DateTime($month.'/01/'.$year);
	// get the number of days in the month
	$days = $calDate->format('t');
	// the day of week the first falls on happens to be the number of day padding
	$frontPad = $calDate->format('w'); 
	// calculate how much padding is needed after month end
	$rearPad = (ceil(($days + $frontPad) / 7) * 7) - ($days + $frontPad);
	// add it all up
	$totalCells = $days + $frontPad + $rearPad;
	
	$output = '<div class="cal-month">';
	
	$output .= '<div class="cal-title">'.$calDate->format('F').'</div>';
	$labels = array('S','M','T','W','T','F','S');
	foreach($labels as $label) {
		$output .= '<div class="cal-cell">'.$label.'</div>';
	}
	
	for ($c = 1; $c <= $totalCells; $c++) { 
		$output .= '<div class="cal-cell">' .
					( $c - $frontPad > 0 && $c - $frontPad <= $days ? $c - $frontPad : '&nbsp;' ) .
				   '</div>';
	}
	
	$output .= '</div>';
	return $output;
} // getCalendar

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Calendar Demo</title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	
	<style type="text/css">
	/* for full height layouts you need to set the height on HTML as well */
	html, body { height: 100%; }
	
	body {
		font-family: Verdana, Arial, sans-serif;
	}
	
	.cal-month {
		box-sizing: border-box;
		height: 190px; /* just to demonstrate float */
		margin: 1.5em auto;
		border: 1px solid #7a7a7a;
	}
	
	.cal-title {
		text-align: center;
		font-size: 115%;
		font-weight: bold;
		padding: 0.5em 0;
	}
	
	.cal-cell {
		float: left;
		box-sizing: border-box;
		width: 14.28%;
		border: 1px solid #cccccc;
		text-align: center;
	}
	
	/* 
	   clearfix hack.
	   ref: http://nicolasgallagher.com/micro-clearfix-hack/
	*/
	.cal-month:before,
	.cal-month:after {
		content: " "; 
		display: table; 
	}

	.cal-month:after {
		clear: both;
	}
	
	/* breakpoints at 450, 600, and 800px */
	@media screen and (min-width: 450px) {
		.cal-month {
			float: left;
			width: 48%;
			margin: 1.5em 1% 0 1%;
		}
		
		
	}
	
	@media screen and (min-width: 600px) {
		.cal-month {
			width: 31%;
		}
		
		
	}
	
	</style>
</head>
<body>

<div id="wrapper">

<?php
$startMonth = 8;
$endMonth = 12;

for ($s = $startMonth; $s <= $endMonth; $s++) {
	echo getCalendar($s, '2015');
}

?>

</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>

$('<div />')
	.append('<p>Width: '+ $(document.body).outerWidth() +' height: '+ $(document.body).outerHeight() +'</p>')
	.prependTo(document.body);
</script>
</body>
</html>
