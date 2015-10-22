(function(Registry) {
	
	// private 
	var data = {};

	Registry.get = function(param) {
		return data[param];
	};

	Registry.set = function(param, val) {
		if (typeof data[param] == "undefined") {
			data[param] = val; // create property
		} else {
			throw new Error('Item already exists');
		}
	};

})(window.Registry = window.Registry || {});

