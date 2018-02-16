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
  	output('Just a test method.');
  }

} // Controller

