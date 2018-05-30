<?php

function dumpArray($srcArray) {
	echo '<pre>'.print_r($srcArray,true).'</pre>';
}

/*
	Options:
		name 					- name of select
		id 						- id of select
		optionValue 	- key used for option value attribute
		optionTitle 	- key used for option title
		option1Title 	- message for first option element
*/
function makeSelect($srcArray, $options) {
	$selectHTML = '<select';
	
	if (!empty($options['id'])) 
		$selectHTML .= ' id="'.$options['id'].'"';
	
	if (!empty($options['name'])) 
		$selectHTML .= ' name="'.$options['name'].'"';

	$selectHTML .= '>';

	if (!empty($options['option1Title'])) 
	$selectHTML .= '<option value="">'.$options['option1Title'].'</option>';

	// loop through and add options to the SELECT
	foreach($srcArray as $index => $row) {
		$selectHTML .= '<option value="'.$row[$options['optionValue']].'">'. $row[$options['optionTitle']] .'</option>';
	
		//$selectHTML .= "<option value='{$row[$options['optionValue']]}'>{$row[$options['optionTitle']]}</option>";
	}

	$selectHTML .= '</select>';
	return $selectHTML;
}


