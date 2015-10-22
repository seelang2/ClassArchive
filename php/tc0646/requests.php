<?php
require_once ('config.php');

?>
<?php include ('header.php'); ?>

<?php

$query = "SELECT id, part_name, part_num FROM parts";

$results = mysql_query($query);

$selectfield = '<select name="part_id"><option value="">Please select a part</option>';

while ($partslist = mysql_fetch_array($results)) {
	$selectfield .= '<option ';
	if ($partslist['id'] == $row['part_id']) $selectfield .= 'selected="selected" ';
//	$selectfield .= 'value="' . $partslist['id'] . '">' . $partslist['part_name'] . '(' . $partslist['part_num'] . ')</option>';
	$selectfield .= "value=\"{$partslist['id']}\">{$partslist['part_name']} ({$partslist['part_num']})</option>";
}
$selectfield .= '</select>';
?>


<select name="part_id">
	<option value="1">Part Name1</option>
	<option value="2" selected="selected">Part Name2</option>
</select>

<hr />

<?php echo $selectfield; ?>

<?php include ('footer.php'); ?>