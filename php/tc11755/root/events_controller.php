<?php

class Events extends Controller {

	public function create() {
		$this->View->render(['template'=>'tpl_generic.php']);
	} // create()

	public function view($id = null) {
		$this->View->render(['template'=>'tpl_generic.php']);
	} // view()

}