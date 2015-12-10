<?php
function echoCal($month_title, $month_start, $month_days) {

	echo "<div class=\"row column-3\">";
	echo "<div class=\"month_title\"> <strong>" . $month_title . "</strong></div>";
	echo "<div class=\"column column-cal\">S</div><div class=\"column column-cal\">M</div><div class=\"column column-cal\">T</div><div class=\"column column-cal\">W</div><div class=\"column column-cal\">T</div><div class=\"column column-cal\">F</div><div class=\"column column-cal\">S</div>";

	for ($x = $month_start; $x <= $month_days; $x++) { 
		echo "<span class=\"column column-cal\">" .  ($x > 0 ?  $x : "&nbsp;") . "</span>";
	};
	echo "</div>";

};
?>
<!doctype html>
<html>


<head>
  <title>My first styled page</title>
  
  <!-- secret 1 to responsive design -->
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=5" />
  
  <link rel="stylesheet" href="grid-cal.css">

</head>

<body>

<?php

$time=time();
$month=date("n",$time);
$daysInMonth=date("t",$time);
$monthName=date("F",$time);
$year=date("Y",$time);

	echoCal($monthName, "-4", $daysInMonth);
        echoCal("February", "0", "29");
        echoCal("March", "-1","31"); 
        echoCal("April", "-4","30");
	echoCal("May", "1","31"); 
	echoCal("June", "-2","30");
 ?>








