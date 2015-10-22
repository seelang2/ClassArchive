<?php


class Model {

	protected $db = null;
	protected $table = null;
	
	// the constructor function is called whenever a new instance
	// of the object is created and any parameters are passed to it
	function __construct(&$db, $table) {
		$this->db = $db;
		$this->table = $table;
	}

	public function get($options = array()) {
		if (empty($options['fields'])) $options['fields'] = '*';
		if (empty($options['id'])) $options['id'] = null;
		$query = "SELECT ".$options['fields']." FROM ".$this->table;
		if (!empty($options['id'])) $query .= " WHERE id = ". $this->db->quote($options['id']);
		$results = $this->db->query($query);
		if ($results === false) {
			return false;
		}
		return $results->fetchAll(PDO::FETCH_ASSOC);

	} // get

	public function save($id = null) {

	} // save

	public function delete($id = null) {

	} // delete


} // Model


class Alumni extends Model {

	function __construct(&$db) {
		parent::__construct($db, 'schools');
	}

	public function get($options = array()) {	
		if (empty($options['id'])) $options['id'] = null;
		$options['fields'] = 'alumni.id, alumni.firstname, alumni.lastname, schools.name AS school';
		$this->table = 'alumni LEFT JOIN schools ON alumni.school_id = schools.id';
		
		return parent::get($options);
	}

	


} // Alumni

class Schools extends Model {

	function __construct(&$db) {
		parent::__construct($db, 'schools');
	}


} // Schools









