// JavaScript Document
function Ajax() {
	this.req = null;
	this.responseType = 'text'; // text or xml
	this.async = true;
	this.handler = null;
	
	var self = this;
	
	this.init = function() {
		try {
			this.req = new XMLHttpRequest();
		} catch(e) {
			try {
				this.req = new ActiveXObject('Msxml2.XMLHTTP');
			} catch(e) {
				try {
					this.req = new ActiveXObject('Microsoft.XMLHTTP' );
				} catch(e) {
					
				}
			}
		}
		return true;
	}; // init
	
	this.request = function(params) {
		// Params: method, url, async, data, handler, type
		this.init();
		if (!this.req) {
			alert('Request is not supported'); // doesn't support XHR object
			return false;
		}
		
		
		this.async = params.async || this.async;
		this.responseType = params.type || this.responseType;
		this.handler = params.handler;
		
		this.req.open(params.method, params.url, this.async);
		
		this.req.onreadystatechange = function() {
			if (this.readyState == 4) {
				// request is done
				if (this.status > 199 && this.status < 300) {
					// good data returned from server
					if (self.responseType == 'text') {
						var response = this.responseText;
					} else {
						var response = this.responseXML;
					}
					
					self.handler(response);
					
				} else {
					// error handling goes here
				} // if status
			} // if readyState
		}; // onreadystatechange
		
		if (params.method.toUpperCase() == 'POST') {
			this.req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		}
		
		var data = params.data || null;
		
		this.req.send(data);
		
	}; // request
	
	this.abort = function() {
		this.req.onreadystatechange = null; // remove event handler to prevent it from firing any more
		this.req.abort(); // call XHR abort method
		this.req = null; // delete XHR object
	}; // abort
}

