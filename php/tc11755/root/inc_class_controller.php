<?php
/**
 *
 *
 */

class Controller {
  protected $db = null;
  protected $View = null;

  public function __construct(&$db, $controllerName, $controllerMethod){
    $this->db = $db;

    $options = [
    	'controllerName' 		=> $controllerName,
    	'controllerMethod' 	=> $controllerMethod
    ];

    $this->View = new View($this, $options);

  } // __construct

  public function testmethod() {
  	echo 'Just a test method.';
  }

  /*
    Options:
      query       - (string) SQL query to run
      fetchAll    - (bool) If true, use fetchAll instead of fetch
      callback    - (function) Callback function to process rows during
                    fetch
  */
  public function getResults($options) {
    // merge default settings with passed options
    $options = array_merge(['fetchAll' => false], $options);

    // if there's no query we bail
    if (empty($options['query'])) return false;

    // send query to server
    $results = $this->db->query($options['query']);
    // check query
    if (!$results) return false;

    if ($options['fetchAll']) {
      // get entire result set as array
      return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    // if there's no callback function throw an error
    if (empty($options['callback'])) {
      throw new Exception('No callback function passed');
    }

    // set up while loop using fetch and use callback
    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
      // execute the callback and pass the row data
      $options['callback']($row);
    }

  } // getResults





} // Controller

