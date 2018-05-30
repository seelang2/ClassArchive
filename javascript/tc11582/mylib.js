
// create registry factory function
function makeRegistry() {

	var data = {};

	return {
		get: function(key) {
			return data[key];
		},

		set: function(key, value) {
			if (typeof data[key] != 'undefined') return false;
			data[key] = value;
			return this; // best practice - return object if return is unused
		},

		delete: function(key) {
			if (typeof data[key] != 'undefined') return false;
			delete data[key];
			return this;
		}
	};

}

