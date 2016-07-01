<?php
// add CORS policy
header('Access-Control-Allow-Origin: *');

if (!empty($_POST)) {
	echo json_encode($_POST);
}

