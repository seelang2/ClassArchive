<?php
include "class_ez_sql.php";

$tbl = "";
if (isset($_GET['tbl']) && $_GET['tbl'] != '') $tbl = $_GET['tbl'];
if (isset($_GET['make']) && $_GET['make'] != '') $make = $_GET['make'];
if (isset($_GET['model']) && $_GET['model'] != '') $model = $_GET['model'];
if (isset($_GET['text']) && $_GET['text'] != '') $text = $_GET['text'];
//if (isset($_GET['xxx']) && $_GET['xxx'] != '') $variable = $_GET['xxx'];

switch (strtoupper($tbl))
{
	case 'MAKE':
		$query = "SELECT id, mname FROM tblmake";
		$results = $db->get_results($query);

		echo "<form name=\"selectmakefrm\" id=\"selectmakefrm\" onChange=\"javascript: app.updatemodel(); return false;\" method=\"post\" action=\"#\">Please select a product make: <select name=\"selectmake\" id=\"selectmake\">";
		foreach ($results as $row) {
			echo "<option value=\"$row->id\">$row->mname</option>";
		}
		echo "</select></form>";
		
	break;
	case 'MODEL':
		$query = "SELECT id, make_id, title FROM tblmodel WHERE make_id = '$make'";
		$results = $db->get_results($query);

		echo "<form name=\"selectmodelfrm\" id=\"selectmodelfrm\" onChange=\"javascript: app.updateitems(); return false;\" method=\"post\" action=\"#\">Please select a model: <select name=\"selectmodel\" id=\"selectmodel\">";
		foreach ($results as $row) {
			echo "<option value=\"$row->id\">$row->title</option>";
		}
		echo "</select></form>";
		
	break;
	case 'ITEM':
		$query = "SELECT id, model_id, attr1, attr2, attr3, attr4 FROM itemlist WHERE model_id = '$model'";
		$results = $db->get_results($query);

		echo "<table border=\"1\" cellpadding=\"3\" cellspacing=\"0\">";
		foreach ($results as $row) {
			echo "<tr><td>$row->attr1</td><td>$row->attr2</td><td>$row->attr3</td><td>$row->attr4</td></tr>";
		}
		echo "</table>";
		
	break;
	case 'TEXT':
		$query = "SELECT id, title, content FROM textsection WHERE id = '$text'";
		$results = $db->get_row($query);
		echo "<h3>$results->title</h3>$results->content";
		
	break;
	default:
		echo "Error: Invalid table selection";
	break;
}
?>