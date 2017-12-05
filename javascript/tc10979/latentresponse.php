<?php

$tag = empty($_GET['tag']) ? $_SERVER['REQUEST_TIME'] : $_GET['tag'];

// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 3);

echo 'Request '. $tag .' Done.';