<?php

if (!empty($_GET)) {
	echo json_encode($_GET);
} else if (!empty($_POST)) {
	echo json_encode($_POST);
};


?>