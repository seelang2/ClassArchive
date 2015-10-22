// JavaScript Document

function Ajax() {
	this.req = null; // XHR instance
	this.respHandler = null; // function to pass response data to
	this.respType = null; // text or xml data
	var self = this;
	
	this.request = function(params) {
		
		// named parameters: handler, url, method, type, data
		self.respHandler = params.handler || null;
		self.respType = params.type || null;
		// create instance of XHR object
		self.req = new XMLHttpRequest();
		if (!self.req) return false; // could not create instance of XHR object
		
		// open request object
		self.req.open(params.method, params.url);
		
		// set request header
		if (params.method.toUpperCase() == 'POST') {
			// needed for server to recognize form data being sent in request
			self.req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		}
		
		// set up onreadystatechange handler
		self.req.onreadystatechange = function() {
			if (self.req.readyState == 4) {
				if (self.req.status > 199 && self.req.status < 300) {
					// good response from server
					if (self.respType == 'xml') {
						self.respHandler(self.req.responseXML);
					} else {
						self.respHandler(self.req.responseText);
					} // if respType
				} // if req.status
			} // if readystate
		}; // req.onreadystatechange
		
		// send request
		var data = params.data || null;
		self.req.send(data);
		
	}; // request
	
	this.abort = function() {
		if (!self.req) return false; // no request object to abort
		self.req.onreadystatechange = null;
		self.req.abort(); // abort request in play
		self.req = null;
	}; // abort
	
};
