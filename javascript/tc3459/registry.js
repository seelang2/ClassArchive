var Registry = new function() {
	var values = {};
	
	this.set = function(key, value) {
		if (typeof(values[key]) == 'undefined') {
			values[key] = value;
		} else return false;
	}; // set
	
	this.get = function(key) {
		if (typeof(values[key]) == 'undefined') {
			return null;
		}
		return values[key];
	}; // get
	
	this.delete = function(key) {
		if (typeof(values[key]) == 'undefined') {
			return false;
		}
		values[key] = null;
		delete values[key];
	}; // delete
	
	this.isset = function(key) {
		return typeof(values[key]) == 'undefined' ? false : true;
	}; // isset
}; // Registry

/*
Registry.set('test','This is a value');
alert(Registry.get('test'));
alert('Test value is ' + (Registry.isset('test')? '' : 'NOT') + ' set!');
Registry.delete('test');
alert('Test value is ' + (Registry.isset('test')? '' : 'NOT') + ' set!');
*/
