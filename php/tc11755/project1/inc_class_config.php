<?php
/**
 *
 *
 */

// static class to hold global configuration data
class Config {
	private static $data = [];

	static function set($key, $value) {
		Config::$data[$key] = $value;
	}

	static function get($key) {
		return Config::$data[$key];
	}
} // Config
