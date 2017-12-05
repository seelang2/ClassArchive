<?php
/*
	inc_functions.php - Include functions library
*/

function makePostButton($params) {

	return '<form class="postbutton" action="'.$params['URI'].'" method="post">'.
	'<input type="submit" value="'.$params['label'].'" />'.
	'</form>';

}

