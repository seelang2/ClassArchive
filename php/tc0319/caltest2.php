<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style>
body{
	font-size: 76%;
	font-family:Geneva, Arial, Helvetica, sans-serif;
}

.clearing { clear: both; height: 1px; overflow: hidden; }

.calendar {
	text-align:center;
}

table.calendar {
	border: 1px solid #cccccc;
}

table.calendar tr td {
	padding: 3px;
	border: 1px solid #cccccc;
}

table.calendar tr td.inactive {
	border: 1px solid #dddddd;
	background: #E1E1E1;
}

table.calendar tr td.noborder {
	border: none;
}

</style>

</head>
<body>

<?php

$me = $_SERVER['PHP_SELF'];
$noborderclass = 'noborder';
$inactiveclass = 'inactive';
if (isset($_GET['m']) && $_GET['m'] != '') $month = $_GET['m']; else $month = date('n');
if (isset($_GET['y']) && $_GET['y'] != '') $year = $_GET['y']; else $year = date('Y');

//if ($month == 12) $nextmonth = 1; else $nextmonth = $month + 1;
$prevmonth = ($month == 1) ? 12 : $month - 1;
$nextmonth = ($month == 12) ? 1 : $month + 1;
$prevyear = ($prevmonth == 12) ? $year - 1 : $year;
$nextyear = ($nextmonth == 1) ? $year + 1 : $year;


echo "<p>Display for $month, $year</p>";

$timestamp = mktime(0, 0, 0, $month, 1, $year);
$offset = date('N', $timestamp) - 1;
if ($offset == 6) $offset = 0; // If sunday don't bother with offset
$totaldays = date('t', $timestamp);

echo "<table class=\"calendar\" cellpadding=\"0\" cellspacing=\"0\">" .
	"<tr><td class=\"$noborderclass\"><a href=\"$me?m=$prevmonth&y=$prevyear\">&laquo;</a></td>" . 
	"<td class=\"$noborderclass\" colspan=\"5\">" . date('F', $timestamp) . " $year</td>" .
	"<td class=\"$noborderclass\"><a href=\"$me?m=$nextmonth&y=$nextyear\">&raquo;</a></td>" . 
	"</tr>";

$c = 0 - $offset;
while ($c <= $totaldays) {
	echo "<tr>";
	for ($w = 0; $w < 7; $w++) {
		echo "<td";
		if ($c < 1 || $c > $totaldays) echo " class=\"$inactiveclass\">&nbsp;"; else echo ">$c";
		echo "</td>";
		$c++;
	}
	echo "</tr>";
}

echo "<tr><td colspan=\"7\"><a href=\"$me?m=" . date('n') . "&y=" . date('Y') . "\">Current Month</a></td></tr>";
echo "</table>";

?>


</body>
</html>

