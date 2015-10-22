/*
	ajax.js - Ajax implementation example
*/
function Ajax() {
	
	this.req = null;
	
}

Ajax.prototype.init = function() {
	// instantiate XHR object
	try {
		// use standard method first
		this.req = new XMLHttpRequest();
	} catch(e) {
		try {
			// use older method next
			this.req = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			return false;
		}
	}
	return true;
};

Ajax.prototype.do = function(params) {
	var self = this;
	
	params = params || {}; // assign a default object value to params
	self.responseType 		= params.responseType || 'text';
	self.responseHandler	= params.responseHandler || null;
	self.method 			= params.method || 'GET';
	self.url 				= params.url || null;
	self.async 				= params.async || true;
	self.data				= params.data || null;
	
	if (!self.url) {
		throw {	error: 'Missing URL',
				description: 'No url specified for ajax request'};
	}
	
	// create new XHR instance
	if (!self.init()) {
		throw {	error: 'XMLHttpRequest not available',
				description: 'Unable to create XHR instance'};
	}
	
	// set up onreadystatechange handler
	self.req.onreadystatechange = function() {
		if (this.readyState === 4) {
			if (this.status > 199 && this.status < 300) {
				// process server response success
				switch(self.responseType.toLowerCase()) {
					case 'text':
						var response = this.responseText;
					break;
					case 'xml':
						var response = this.responseXML;
					break;
				}
				
				// hand off response back to handler
				if (typeof self.responseHandler == 'function') {
					self.responseHandler(response);
				} else {
					// error - no handler set. Do something!
					throw {	error: 'No XHR handler',
							description: 'No response handler defined.'};
				}
				
			} else {
				// process request response errors here
				
			}
		} // if readyState
	} // onreadystatechange
	
	// open request
	self.req.open(self.method, self.url, self.async);
	
	// set request headers
	if (self.method.toUpperCase() === 'POST') {
		self.req.setRequestHeader(
			'Content-Type',
			'application/x-www-form-urlencoded'
		);
	}
	
	// send request
	self.req.send(self.data);
	
};

