<?php
// to simulate latency
//mt_srand ((double) microtime() * 1000000);

/*
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 10);
*/

readfile($_GET['pageid'] . '.html');

?>