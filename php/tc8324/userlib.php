<?php


function sanitize($dbh, $value) {

	$dbh->quote($value);

}
