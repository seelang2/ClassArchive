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

	public function get($fields = '*', $id = null) {
		$query = "SELECT ".$fields." FROM ".$this->table;
		if (!empty($id)) $query .= " WHERE id = ". $this->db->quote($id);
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

	public function get($id = null) {	
		$fields = 'alumni.id, alumni.firstname, alumni.lastname, schools.name AS school';
		$this->table = 'alumni LEFT JOIN schools ON alumni.school_id = schools.id';
		
		return parent::get($fields, $id);
	}

	


} // Alumni

class Schools extends Model {

	function __construct(&$db) {
		parent::__construct($db, 'schools');
	}


} // Schools









