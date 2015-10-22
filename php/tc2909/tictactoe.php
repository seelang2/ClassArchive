<?php

// define tic tac toe board

$board = array(
			   array('O', ' ', 'X'),
			   array('X', 'O', ' '),
			   array('X', ' ', 'X')
			   );


// display board

/*
// brute force method - not recommended
echo $board[0][0];
echo $board[0][1];
echo $board[0][2];
echo '<br />';
echo $board[1][0];
echo $board[1][1];
echo $board[1][2];
echo '<br />';
echo $board[2][0];
echo $board[2][1];
echo $board[2][2];

*/

foreach ($board as $row) {
	foreach ($row as $column) {
		echo $column;
	} // foreach column
	echo '<br />';
} // foreach row




?>