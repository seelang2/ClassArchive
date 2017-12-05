// create and object class for our Ajax object
function Ajax() {
	this.req = null;			// XHR object storage
	this.respHandler = null;	// Callback function to process response
	this.respType = 'text';		// determines whether data will be in responseText or responseXML
	
	var self = this; 
	
	this.init = function() {
		if (!this.req) {
			try {
				this.req = new XMLHttpRequest(); // instantiate object using standard object
			} catch(e) {
				try {
					this.req = new ActiveXObject('MSXML2.XMLHTTP'); // try newer activex library
				} catch(e) {
					try {
						this.req = new ActiveXObject('Microsoft.XMLHTTP'); // try older activex library
					} catch(e) {
						return false; // no XHR support, no soup for you
					}
				}
			}
		}
		return this.req;
	}; // init
	
	this.send = function(params) {
		// Parameters: method, url, callback, data, respType
		this.respHandler = params.callback;
		this.respType = params.respType || this.respType ;
		
		// create XHR object instance
		if (!this.init()) {
			alert('Could not create XMLHttpRequest object');
			return; // nothing more we can do here, bail
		}
		
		this.req.open(params.method, params.url);
		
		if (params.method.toUpperCase() == 'POST') {
			this.req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		}
		
		this.req.onreadystatechange = function() {
			if (this.readyState == 4) {
				if (this.status > 199 && this.status < 300) {
					switch(self.respType.toUpperCase()) {
						default:
						case 'TEXT':
							var response = this.responseText;
						break;
						
						case 'XML':
							var response = this.responseXML;
						break;
					} // switch
					
					if (!self.respHandler) {
						alert('No callback method specified for Ajax request.');
						return;
					}
					self.respHandler(response);
				} // if ststus
			} // if readyState
		}; // onreadystatechange
		
		var data = params.data || null;
		this.req.send(data);
	}; // send
	
} // Ajax

