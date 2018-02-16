<?php

class contentController extends Controller {

  /*
	 View records in table

	 GET parameters:
	 	page 	page number (for pagination)
	 	range 	number of rows per page

   */
  public function view($id = null){
    // pass content enumerations to view
    // not really necessary, but makes view template a little clearer
    $this->View->set('content_type', Config::get('content_type'));
    $this->View->set('content_status', Config::get('content_status'));

    //get content records and display in table
    //if $id is set we want a specific item

    if (!empty($_GET['page'])) $offset = $_GET['page']; 
    if (!empty($_GET['range'])) $range = $_GET['range']; 

    switch (true){
      case !empty($id):
        //look for item with id = $id
        $query = "SELECT * FROM content WHERE id = $id";

        //echo $query;

        $results = $this->db->query($query);

        // send results to view
        $this->View->set('results', $results);
        // now render view
        // this time we specify a different template file to use
        $this->View->render(['template' => 'tpl_content_view-single.php']);
                
      break;
      default:
        //display all items
        //$query = 'SELECT id, title, type, date_added, status, user_id FROM content';
        $query = '
          SELECT 
            content.id,
            content.title,
            content.type,
            content.date_added,
            content.status,
            users.name 
          FROM content 
          LEFT JOIN users on content.user_id = users.id
        ';
        
        if (isset($offset) && isset($range)) {
	        // calculate actual offset for LIMIT clause
	        $offset = ($offset - 1) * $range;
	        // append LIMIT clause to query
	        $query .= " LIMIT $offset, $range";
        }

        //echo $query; 

        $results = $this->db->query($query);

        // send results to view
        $this->View->set('results', $results);
        // now render view
        $this->View->render();
        
      break;
        
    } //switch
  }
}