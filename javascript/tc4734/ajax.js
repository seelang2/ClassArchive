function Ajax() {
	
	this.req = null;						// XMLHttpRequest object
	this.responseHandler = null;		// callback function to process server response
	this.responseType = 'TEXT';		// determines whether to look in responseText 
												// or responseXML  for data
	var self = this;						// creates a var that references this object
	
	/***
	 * Create instance of XHR object
	 */
	this.init = function() {
		try {
			self.req = new XMLHttpRequest();
		} catch (e) {
			return false; // trap any errors created if instantiation fails
		}
		return true;
	}; // this.init
	
	/***
	 * Preparing and sending XHR request
	 * Parameters (name-value pairs in params object):
	 *		url, method, responseHandler, responseType, [data]
	 */
	this.send = function(params) {
		// create instance of XHR object
		if (!self.init()) {
			alert('Unable to create XHR Object');
			return false;
		}
		
		// retrieve parameters and save in Ajax instance
		self.responseHandler = params.responseHandler;
		self.responseType = params.responseType;
		
		// XHR.open 
		self.req.open(params.method, params.url);
		
		// send any extra request headers necessary
		if (params.method.toUpperCase() == 'POST') {
			self.req.setRequestHeader('Content-Type', 
												  'application/x-www-form-urlencoded');
		}
		
		// set up onReadyStateChange event handler
		self.req.onreadystatechange = function() {
			if (self.req.readyState == 4) {
				if (self.req.status > 199 && self.req.status < 300) {
					// response ok, hand off data to responseHandler
					switch(self.responseType.toUpperCase()) {
						default:
						case 'TEXT':
							var response = self.req.responseText;
						break;
						
						case 'XML':
							var response = self.req.responseXML;
						break;
						
						case 'REQ':
							var response = self.req;
						break;
					} // switch
					
					self.responseHandler(response);
				} // if req.status
			} // if readyState
		}; // onreadystatechange
		
		// send request
		var data = params.data || null; 
		self.req.send(data);
	}; // this.send
	
	/***
	 * Aborts current request 
	 */
	this.abort = function() {
		self.req.onreadystatechange = null; // reset onreadystatechange handler
		
		self.req.abort(); // abort request
		
		self.req = null; // delete request object
	}; // this.abort
	
} // Ajax

