(function(Registry) {
	
// factory function that returns an object linked

Registry.makeRegistry = function() {

	var data = {};

	return {
		get: function(param) {
			return data[param];
		},
		set: function(param, val) {
			data[param] = val;
		},
		del: function(param) {
			delete data[param];
		}
	}

}

})(window.Registry = window.Registry || {});



