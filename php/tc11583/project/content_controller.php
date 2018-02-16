<?php

class contentController extends Controller {

  /*
	 View records in table

	 GET parameters:
	 	page 	page number (for pagination)
	 	range 	number of rows per page

   */
  public function view($id = null){
    //get content records and display in table
    //if $id is set we want a specific item

    if (!empty($_GET['page'])) $offset = $_GET['page']; 
    if (!empty($_GET['range'])) $range = $_GET['range']; 

    switch (true){
      case !empty($id):
        //look for item with id = $id
        $query = "SELECT * FROM content WHERE id = $id";

        echo $query;

        $results = $this->db->query($query);
        
        if($results->rowCount()==0){
        	output('<p>No data to display</p>');
        	break;
        }

        // output content
        output(print_r($results->fetch(PDO::FETCH_ASSOC),true),'pre');
        
      break;
      default:
        //display all items
        $query = 'SELECT id, title, type, date_added, status, user_id FROM content';
        
        if (isset($offset) && isset($range)) {
	        // calculate actual offset for LIMIT clause
	        $offset = ($offset - 1) * $range;
	        // append LIMIT clause to query
	        $query .= " LIMIT $offset, $range";
        }

        echo $query; 

        $results = $this->db->query($query);
        
        if($results->rowCount()==0){
         output('<p>No data to display</p>');
          break;
        }
        //loop through results and display in table
        $outputHTML ='<table><tbody>';

        while($row = $results->fetch(PDO::FETCH_ASSOC)) {
        	$outputHTML .= '<tr>';
        	foreach($row as $fieldValue) {
        		$outputHTML .= '<td>' . $fieldValue . '</td>';
        	}
        	$outputHTML .= '</tr>';
        }

        $outputHTML .= '</tbody></table>';
        
        echo $outputHTML;
      break;
        
    } //switch
  }
}