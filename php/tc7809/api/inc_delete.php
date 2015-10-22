<?php

// debugging device
$data = array();
$data['server'] = $_SERVER;
$data['get'] = $_GET;
$data['post'] = $_POST;

echo json_encode($data);

