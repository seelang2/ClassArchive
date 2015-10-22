<?php

function pr($data) {
	return '<pre>' . print_r($data, true) . '</pre>';
}


echo '<h2>$_SERVER</h2>'.pr($_SERVER);
echo '<h2>$_GET</h2>'.pr($_GET);
echo '<h2>$_POST</h2>'.pr($_POST);
echo '<h2>$_REQUEST</h2>'.pr($_REQUEST);

