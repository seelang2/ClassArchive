/*
	Basic Registry Object
*/
var Registry = new function() {
	var data = {}; // private variable to store data
	this.strictMode = false;
	
	this.setItem = function(name, value) {
		if (Registry.strictMode && typeof(data[name]) != "undefined") return false;
		data[name] = value;
		return true;
	}; // setItem
	
	this.getItem = function(name) {
		return data[name];
	}; // getItem
	
	this.delItem = function(name) {
		if (Registry.strictMode && typeof(data[name]) == "undefined") return false;
		delete data[name];
		return true;
	}; // delItem
	
	this.isSet = function(name) {
		return typeof(data[name]) == "undefined" ? false : true;
	}; // isSet
};

