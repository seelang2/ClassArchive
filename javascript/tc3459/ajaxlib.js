// JavaScript Document

function Ajax() {
	this.req = null;
	this.method = null;
	this.url = null;
	this.resphandler = null;
	this.resptype = 'text';
	this.async = true;
	Self = this;
	
	this.init = function() {
		// create instance of xmlHttpRequest object
		try {
			this.req = new XMLHttpRequest(); // first try the new method
		} catch (e) {
			try {
				this.req = new ActiveXObject('MSXML2.XMLHTTP'); // try newer activex object
			} catch (e) {
				try {
					this.req = new ActiveXObject('Microsoft.XMLHTTP'); // try older activex object
				} catch (e) {
					return false; // no XHR object support
				}
			}
		}
		return this.req;
	}; // init
	
	this.doRequest = function(params) {
		/*
		Parameters: method, url, resphandler, resptype, async, data
		*/
		
		if (!this.init()) {
			alert('Unable to create XMLHTTPRequest object.');
			return;
		}
		
		req = this.req;
		this.method = params.method;
		this.url = params.url;
		this.resphandler = params.resphandler;
		this.resptype = params.resptype;
		this.async = params.async || this.async;
		var data = params.data || null;
		
		req.open(this.method, this.url);
		
		if (this.method.toUpperCase() == 'POST') {
			req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		}
		
		req.onreadystatechange = function() {
			var resp = null;
			if (req.readyState == 4) {
				switch(Self.resptype.toUpperCase()) {
					case 'TEXT':
						resp = req.responseText;
					break;
					
					case 'XML':
						resp = req.responseXML;
					break;
				}
				
				if (req.status > 199 && req.status < 300) {
					if (!Self.resphandler) {
						alert('No handler defined for this request.');
						return;
					}
					Self.resphandler(resp);
				}
				
			} // if readyState
		}; // onreadystatechange
		
		req.send(data);
		
	}; // doRequest
	
	
} // Ajax


