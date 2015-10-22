<?php
// page retrieval manager
// sets CORS and security/authentication stuff and delivers file to client

// set CORS header to allow all access
header('Access-Control-Allow-Origin: *');
if (empty($_GET['file'])) exit('Error: no target content specified.');

//$fileName = 'spa2-' . $_GET['file'] . '.html';
$fileName = $_GET['file'] . '.html';

if (file_exists($fileName)) echo file_get_contents($fileName);

