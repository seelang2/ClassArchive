<?php
/**
 *
 *
 */

/*
	Sometimes we need to send state data meant only to be used for the next
	request. Cookies could be used, but they are limited in the amount of 
	information they can store, and are client rather than server based.

	This Flash class simply allows us to set and get data stored in the
	$_SESSION['Flash'] element.
*/
class Flash {
	private static $data = null;
	/*
		move data from session to Flash class. Only needs to be called once.
	*/
	static function init() {
		if (!empty($_SESSION['Flash'])) {
			Flash::$data = $_SESSION['Flash']; // extract session contents
			unset($_SESSION['Flash']); // clear session var
		}
	} // init
	/*
		set flash message by setting the session var
	*/
	static function set($value) {
		$_SESSION['Flash'] = $value;
	} // set

	/*
		Returns the flash data from the previous request. 
		Because set() sets the session var directly, this can be used
		even after set() has set a new flash item.
	*/
	static function get() {
		return Flash::$data;
	} // get
} // Flash
// initialize the Flash value once the class is defined
Flash::init();



