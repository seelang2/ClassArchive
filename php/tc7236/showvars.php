<?php
session_start(); // to activate sessions
echo '<h1>$_GET:</h1>' . '<pre>' . print_r($_GET, true) . '</pre>';
echo '<h1>$_POST:</h1>' . '<pre>' . print_r($_POST, true) . '</pre>';
echo '<h1>$_SERVER:</h1>' . '<pre>' . print_r($_SERVER, true) . '</pre>';
echo '<h1>$_SESSION:</h1>' . '<pre>' . print_r($_SESSION, true) . '</pre>';
echo '<h1>$_COOKIE:</h1>' . '<pre>' . print_r($_COOKIE, true) . '</pre>';
echo '<h1>$_ENV:</h1>' . '<pre>' . print_r($_ENV, true) . '</pre>';
echo '<h1>$_REQUEST:</h1>' . '<pre>' . print_r($_REQUEST, true) . '</pre>';
echo '<h1>$_FILES:</h1>' . '<pre>' . print_r($_FILES, true) . '</pre>';



