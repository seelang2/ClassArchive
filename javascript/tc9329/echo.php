<?php
/**
 * Echoes back whatever was posted to it
 */
if (!empty($_REQUEST)) {
	echo json_encode($_REQUEST);
}