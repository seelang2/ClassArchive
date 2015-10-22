function doAjaxRequest(params) {
	/* params object: 
		{method: http method get|post, 
		 url: request target url, 
		 data: data payload, 
		 handler: callback function to pass request results to, 
		 responseType: response type text|xml}
	*/
	// create an instance of XHR object
	var ajaxObj = new XMLHttpRequest;
	if (!ajaxObj) return false; // if error then bail out
	
	// call open method
	ajaxObj.open(params.method, params.url);
	// if POST be sure to add content header
	if (params.method == 'post') ajaxObj.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	// set up onreadystate handler
	ajaxObj.onreadystatechange = function() {
		// check readystate and status codes
		if (this.readyState == 4 && (this.status > 199 && this.status < 300)) {
			// look for data
			if (params.responseType == 'text') {
				var response = this.responseText;
			} else {
				var response = this.responseXML;
			}
			// pass data to handler function
			params.handler(response);
		}
	}; // onreadystatechange
	// send the request
	ajaxObj.send(params.data);
	// return XHR object
	return ajaxObj;
} // doAjaxRequest

function abortAjaxRequest(ajaxObj) {
	ajaxObj.onreadystatechange = null; // get rid of event handler
	ajaxObj.abort(); // call XHR abort method
	ajaxObj = null; // delete XHR object
} // abortAjaxRequest








