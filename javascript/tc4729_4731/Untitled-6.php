<?php
/*

   Basic parameters:
   action - Operation to perform: GET or POST
   id - ID of record to retrieve
   rng - Range: # of records to retrieve
   off - Offset: starting record #
   srtc - Sorting column
   srtd - Sorting direction
*/
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 10);

if (!$dbLink = @mysql_connect('localhost','root','xampp')) exit('Error');
if (!$dbh = @mysql_select_db('contactapi')) exit('Error');

if (!empty($_GET['action'])) $action = strtoupper($_GET['action']);

switch($action) {
   case 'GET': // retrieve one or more records
       $query = "SELECT * FROM contacts";
       if (!empty($_GET['id'])) $query .= " WHERE id = '".$_GET['id']."'";
       else {
           //$query .= empty($_GET['']) ? '' : $_GET[''];
           $query .= empty($_GET['srtc']) ? '' : ' ORDER BY ' . $_GET['srtc'];
           $query .= empty($_GET['srtd']) && !empty($_GET['srtc']) ? ' ASC' : ' '.$_GET['srtd'];
           $query .= empty($_GET['rng']) ? '' : ' LIMIT ' .
           (empty($_GET['off']) ? '' : $_GET['off'] .','. $_GET['rng']);

       }



   break;

   case 'POST':



   break;
} // switch

?>